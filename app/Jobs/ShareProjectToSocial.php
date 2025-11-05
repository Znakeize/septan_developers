<?php

namespace App\Jobs;

use App\Models\Project;
use App\Models\SocialChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ShareProjectToSocial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Project $project) {}

    public function handle(): void
    {
        $channels = SocialChannel::where('enabled', true)->get();
        foreach ($channels as $channel) {
            $message = $this->buildMessage($channel->message_template);
            // Placeholder: integrate with API using $channel credentials
            Log::info('[SocialShare][Project] '.$channel->platform, [
                'project_id' => $this->project->id,
                'title' => $this->project->title,
                'message' => $message,
                'url' => route('projects.show', $this->project->slug),
            ]);
        }
    }

    private function buildMessage(?string $template): string
    {
        $url = route('projects.show', $this->project->slug);
        $map = [
            '{title}' => $this->project->title,
            '{url}' => $url,
            '{location}' => $this->project->location,
            '{year}' => $this->project->year,
            '{type}' => $this->project->type,
        ];
        $default = "New project: {$this->project->title} in {$this->project->location}. See more: {$url}";
        return $template ? strtr($template, $map) : $default;
    }
}


