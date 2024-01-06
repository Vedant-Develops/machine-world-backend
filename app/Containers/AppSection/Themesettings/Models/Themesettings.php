<?php

namespace App\Containers\AppSection\Themesettings\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Themesettings extends ParentModel
{
    protected $table = 'mw_themesettings';
    protected $fillable = [
        'id',
        'name',
        'logo',
        'favicon',
        'description',
        'mobile',
        'email',
        'address',
        'mailer',
        'mailpath',
        'smtphost',
        'smtpemail',
        'smtppassword',
        'port',
        'ssl_tls_type',
        'google_play_store_link',
        'ios_play_store_link',
        'recaptcha_key',
        'recaptcha_secret',
        'facebook_link',
        'instagram_link',
        'youtube_link',
        'image_api_url',
        'sms_otp_api_key'
    ];

    protected $hidden = [];

    protected $casts = [];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Themesettings';
}
