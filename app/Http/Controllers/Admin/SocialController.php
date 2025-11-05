<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialChannel;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function index()
    {
        $platforms = ['facebook','instagram','linkedin','x','youtube'];
        $channels = SocialChannel::all()->keyBy('platform');
        return view('admin.social.index', compact('platforms','channels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'channels' => 'required|array',
            'channels.*.enabled' => 'nullable|boolean',
            'channels.*.app_id' => 'nullable|string',
            'channels.*.app_secret' => 'nullable|string',
            'channels.*.access_token' => 'nullable|string',
            'channels.*.page_id' => 'nullable|string',
            'channels.*.page_name' => 'nullable|string',
            'channels.*.webhook_url' => 'nullable|url',
            'channels.*.message_template' => 'nullable|string',
        ]);

        foreach ($data['channels'] as $platform => $config) {
            SocialChannel::updateOrCreate(
                ['platform' => $platform],
                [
                    'enabled' => isset($config['enabled']) ? (bool)$config['enabled'] : false,
                    'app_id' => $config['app_id'] ?? null,
                    'app_secret' => $config['app_secret'] ?? null,
                    'access_token' => $config['access_token'] ?? null,
                    'page_id' => $config['page_id'] ?? null,
                    'page_name' => $config['page_name'] ?? null,
                    'webhook_url' => $config['webhook_url'] ?? null,
                    'message_template' => $config['message_template'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.social.index')->with('success','Social channels updated.');
    }
}


