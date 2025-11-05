<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform', 'enabled', 'app_id', 'app_secret', 'access_token', 'page_id', 'page_name', 'webhook_url', 'message_template'
    ];
}


