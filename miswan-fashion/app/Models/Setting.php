<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_title',
        'logo',
        'favicon',
        'phone',
        'email',
        'address',
        'currency_symbol',
        'shipping_inside_city',
        'shipping_outside_city',
        'facebook_url',
        'youtube_url',
        'instagram_url',
        'announcement_text',
    ];
}
