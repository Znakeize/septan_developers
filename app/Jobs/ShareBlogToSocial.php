<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Models\SocialChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ShareBlogToSocial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Blog $blog) {}

    public function handle(): void
    {
        $channels = SocialChannel::where('enabled', true)->get();
        foreach ($channels as $channel) {
            $message = $this->buildMessage($channel->message_template);
            Log::info('[SocialShare][Blog] '.$channel->platform, [
                'blog_id' => $this->blog->id,
                'title' => $this->blog->title,
                'message' => $message,
                'url' => route('blogs.show', $this->blog->slug),
            ]);
        }
    }

    private function buildMessage(?string $template): string
    {
        $url = route('blogs.show', $this->blog->slug);
        $map = [
            '{title}' => $this->blog->title,
            '{url}' => $url,
            '{location}' => '',
            '{year}' => optional($this->blog->published_date)->format('Y') ?? '',
            '{type}' => $this->blog->category,
        ];
        $default = "New article: {$this->blog->title}. Read now: {$url}";
        return $template ? strtr($template, $map) : $default;
    }
}


