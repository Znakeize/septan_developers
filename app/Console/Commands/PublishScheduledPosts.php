<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SocialMediaPost;
use App\Models\SocialMediaAccount;
use Carbon\Carbon;

class PublishScheduledPosts extends Command
{
    protected $signature = 'social:publish-scheduled';
    protected $description = 'Publish scheduled social media posts';

    public function handle()
    {
        $pendingPosts = SocialMediaPost::where('status', 'pending')
            ->where('scheduled_at', '<=', Carbon::now())
            ->get();

        if ($pendingPosts->isEmpty()) {
            $this->info('No scheduled posts to publish.');
            return 0;
        }

        $this->info("Found {$pendingPosts->count()} posts to publish...");

        foreach ($pendingPosts as $post) {
            try {
                $account = SocialMediaAccount::where('user_id', $post->user_id)
                    ->where('platform', $post->platform)
                    ->where('is_active', true)
                    ->first();

                if (!$account) {
                    $post->update([
                        'status' => 'failed',
                        'error_message' => 'Account not connected or inactive'
                    ]);
                    $this->error("Failed: Account not found for post #{$post->id}");
                    continue;
                }

                if (method_exists($account, 'isExpired') && $account->isExpired()) {
                    $post->update([
                        'status' => 'failed',
                        'error_message' => 'Access token expired. Please reconnect account.'
                    ]);
                    $this->error("Failed: Token expired for post #{$post->id}");
                    continue;
                }

                $contentModel = $post->project ?: $post->blog;
                if (!$contentModel) {
                    $post->update([
                        'status' => 'failed',
                        'error_message' => 'Content not found'
                    ]);
                    continue;
                }

                // Minimal support: only Facebook
                if ($account->platform !== 'facebook') {
                    throw new \Exception('Platform not supported');
                }

                $response = $this->publishToFacebook($account, $post->content, $contentModel);

                $post->update([
                    'status' => 'published',
                    'published_at' => Carbon::now(),
                    'platform_post_id' => $response['id'] ?? null,
                ]);

                $this->info("✓ Published post #{$post->id} to {$post->platform}");

            } catch (\Exception $e) {
                $post->update([
                    'status' => 'failed',
                    'error_message' => $e->getMessage()
                ]);
                $this->error("✗ Failed to publish post #{$post->id}: {$e->getMessage()}");
            }
        }

        $this->info('Scheduled posts processing complete!');
        return 0;
    }

    private function publishToFacebook($account, $content, $model)
    {
        $client = new \GuzzleHttp\Client();

        $imageUrl = $model instanceof \App\Models\Project
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
}


