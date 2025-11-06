<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaAccount;
use App\Models\SocialMediaPost;
use App\Models\Project;
use App\Models\Blog;

class SocialMediaController extends Controller
{
    public function index()
    {
        $accounts = SocialMediaAccount::where('user_id', auth()->id())->get();
        $posts = SocialMediaPost::with(['project', 'blog'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(20);

        $recentProjects = \App\Models\Project::latest()->limit(10)->get();
        $recentBlogs = \App\Models\Blog::latest()->limit(10)->get();

        return view('admin.social.index', compact('accounts', 'posts', 'recentProjects', 'recentBlogs'));
    }

    public function connectAccount($platform)
    {
        $authUrl = $this->getAuthUrl($platform);
        return redirect($authUrl);
    }

    public function handleCallback(Request $request, $platform)
    {
        $accessToken = $this->exchangeCodeForToken($platform, $request->code);

        SocialMediaAccount::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'platform' => $platform,
            ],
            [
                'access_token' => $accessToken['access_token'] ?? null,
                'refresh_token' => $accessToken['refresh_token'] ?? null,
                'expires_at' => now()->addSeconds($accessToken['expires_in'] ?? 3600),
                'is_active' => true,
            ]
        );

        return redirect()->route('admin.social.index')
            ->with('success', ucfirst($platform) . ' account connected successfully!');
    }

    public function disconnectAccount(SocialMediaAccount $account)
    {
        $account->update(['is_active' => false]);
        return back()->with('success', 'Account disconnected successfully!');
    }

    public function previewPost(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:project,blog',
            'id' => 'required|integer',
            'platform' => 'required|string',
            'custom_message' => 'nullable|string',
        ]);

        $content = $validated['type'] === 'project'
            ? Project::findOrFail($validated['id'])
            : Blog::findOrFail($validated['id']);

        $preview = $this->generatePreview($content, $validated['platform'], $validated['type'], $validated['custom_message'] ?? null);

        return response()->json($preview);
    }

    public function schedulePost(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:project,blog',
            'id' => 'required|integer',
            'platforms' => 'required|array',
            'schedule_at' => 'nullable|date|after:now',
            'custom_message' => 'nullable|string|max:5000',
        ]);

        $content = $validated['type'] === 'project'
            ? Project::findOrFail($validated['id'])
            : Blog::findOrFail($validated['id']);

        foreach ($validated['platforms'] as $platform) {
            SocialMediaPost::create([
                'user_id' => auth()->id(),
                'project_id' => $validated['type'] === 'project' ? $validated['id'] : null,
                'blog_id' => $validated['type'] === 'blog' ? $validated['id'] : null,
                'platform' => $platform,
                'content' => $this->generatePostContent($content, $platform, $validated['type'], $validated['custom_message'] ?? null),
                'status' => 'pending',
                'scheduled_at' => $validated['schedule_at'] ?? now(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function publishNow(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:project,blog',
            'id' => 'required|integer',
            'platforms' => 'required|array',
            'custom_message' => 'nullable|string|max:5000',
        ]);

        $content = $validated['type'] === 'project'
            ? Project::findOrFail($validated['id'])
            : Blog::findOrFail($validated['id']);

        $results = [];
        foreach ($validated['platforms'] as $platform) {
            try {
                $account = SocialMediaAccount::where('user_id', auth()->id())
                    ->where('platform', $platform)
                    ->where('is_active', true)
                    ->firstOrFail();

                $postContent = $this->generatePostContent($content, $platform, $validated['type'], $validated['custom_message'] ?? null);
                $response = $this->publishToplatform($account, $postContent, $content);

                SocialMediaPost::create([
                    'user_id' => auth()->id(),
                    'project_id' => $validated['type'] === 'project' ? $validated['id'] : null,
                    'blog_id' => $validated['type'] === 'blog' ? $validated['id'] : null,
                    'platform' => $platform,
                    'content' => $postContent,
                    'status' => 'published',
                    'published_at' => now(),
                    'platform_post_id' => $response['id'] ?? null,
                ]);

                $results[$platform] = 'success';
            } catch (\Exception $e) {
                $results[$platform] = 'failed: ' . $e->getMessage();
            }
        }

        return response()->json(['success' => true, 'results' => $results]);
    }

    private function generatePostContent($content, $platform, $type, $customMessage = null)
    {
        if ($customMessage) {
            return $customMessage;
        }

        $url = $type === 'project'
            ? route('projects.show', $content->slug)
            : route('blogs.show', $content->slug);

        $hashtags = $this->generateHashtags($content, $platform);

        switch ($platform) {
            case 'facebook':
            case 'linkedin':
                return "{$content->title}\n\n{$content->excerpt}\n\n🔗 {$url}\n\n{$hashtags}";
            case 'twitter':
            case 'x':
                $hashLen = strlen($hashtags) > 0 ? strlen($hashtags) + 1 : 0;
                $maxLength = 280 - strlen($url) - $hashLen - 10;
                $text = strlen($content->title) > $maxLength
                    ? substr($content->title, 0, $maxLength) . '...'
                    : $content->title;
                return "{$text}\n\n🔗 {$url}" . ($hashtags ? "\n\n{$hashtags}" : '');
            case 'instagram':
                return "{$content->title}\n\n{$content->excerpt}\n\n{$hashtags}\n\nLink in bio!";
            default:
                return "{$content->title}\n\n{$url}";
        }
    }

    private function generateHashtags($content, $platform)
    {
        $tags = [];
        if (isset($content->tags)) {
            $tags = is_array($content->tags) ? $content->tags : (is_string($content->tags) ? json_decode($content->tags, true) : []);
        }
        $defaultTags = ['architecture', 'design', 'construction', 'SeptanDevelopers'];
        $allTags = array_merge($tags ?: [], $defaultTags);
        $limit = $platform === 'instagram' ? 30 : 10;
        $selectedTags = array_slice(array_unique($allTags), 0, $limit);
        return implode(' ', array_map(fn($tag) => '#' . str_replace(' ', '', $tag), $selectedTags));
    }

    private function generatePreview($content, $platform, $type, $customMessage = null)
    {
        $postContent = $this->generatePostContent($content, $platform, $type, $customMessage);
        $imageUrl = $type === 'project'
            ? ($content->main_image ? asset('storage/' . $content->main_image) : null)
            : ($content->featured_image ? asset('storage/' . $content->featured_image) : null);

        return [
            'platform' => $platform,
            'content' => $postContent,
            'image' => $imageUrl,
            'title' => $content->title,
            'characterCount' => strlen($postContent),
            'limits' => $this->getPlatformLimits($platform),
        ];
    }

    private function getPlatformLimits($platform)
    {
        return [
            'facebook' => ['text' => 63206, 'images' => 10],
            'twitter' => ['text' => 280, 'images' => 4],
            'x' => ['text' => 280, 'images' => 4],
            'instagram' => ['text' => 2200, 'images' => 10],
            'linkedin' => ['text' => 3000, 'images' => 9],
        ][$platform] ?? ['text' => 5000, 'images' => 5];
    }

    private function publishToplatform($account, $content, $model)
    {
        switch ($account->platform) {
            case 'facebook':
                return $this->publishToFacebook($account, $content, $model);
            default:
                throw new \Exception('Platform not supported');
        }
    }

    private function publishToFacebook($account, $content, $model)
    {
        $client = new \GuzzleHttp\Client();

        $imageUrl = $model instanceof Project
            ? ($model->main_image ? asset('storage/' . $model->main_image) : null)
            : ($model->featured_image ? asset('storage/' . $model->featured_image) : null);

        if ($imageUrl) {
            $response = $client->post("https://graph.facebook.com/v18.0/me/photos", [
                'form_params' => [
                    'message' => $content,
                    'url' => $imageUrl,
                    'access_token' => $account->access_token,
                ]
            ]);
        } else {
            $response = $client->post("https://graph.facebook.com/v18.0/me/feed", [
                'form_params' => [
                    'message' => $content,
                    'access_token' => $account->access_token,
                ]
            ]);
        }

        return json_decode($response->getBody(), true);
    }

    private function getAuthUrl($platform)
    {
        $redirectUri = route('admin.social.callback', $platform);
        switch ($platform) {
            case 'facebook':
                return "https://www.facebook.com/v18.0/dialog/oauth?" . http_build_query([
                    'client_id' => config('services.facebook.client_id'),
                    'redirect_uri' => $redirectUri,
                    'scope' => 'pages_manage_posts,pages_read_engagement',
                ]);
            default:
                throw new \Exception('Platform not supported');
        }
    }

    private function exchangeCodeForToken($platform, $code)
    {
        // Placeholder – implement per platform
        return [];
    }
}


