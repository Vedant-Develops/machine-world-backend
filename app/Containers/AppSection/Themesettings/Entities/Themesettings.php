<?php

namespace App\Containers\AppSection\Themesettings\Entities;

use Doctrine\ORM\Mapping as ORM;

class Themesettings
{
    protected $name;
    protected $address;
    protected $logo;
    protected $logoencode;
    protected $favicon;
    protected $faviconencode;
    protected $description;
    protected $mobile;
    protected $email;
    protected $mailer;
    protected $mailpath;
    protected $smtphost;
    protected $smtpemail;
    protected $smtppassword;
    protected $port;
    protected $ssl_tls_type;
    protected $google_play_store_link;
    protected $ios_play_store_link;
    protected $recaptcha_key;
    protected $recaptcha_secret;

    protected $facebook_link;
    protected $instagram_link;
    protected $youtube_link;
    protected $image_api_url;

    protected $keyword;
    protected $search_val;
    protected $field_db;
    protected $per_page;

    public function __construct($request = null)
    {
        $this->image_api_url             = isset($request['image_api_url']) ? $request['image_api_url'] : null;
        $this->name             = isset($request['name']) ? $request['name'] : null;
        $this->address             = isset($request['address']) ? $request['address'] : null;
        $this->logo             = isset($request['logo']) ? $request['logo'] : null;
        $this->logoencode             = isset($request['logoencode']) ? $request['logoencode'] : null;
        $this->favicon             = isset($request['favicon']) ? $request['favicon'] : null;
        $this->faviconencode             = isset($request['faviconencode']) ? $request['faviconencode'] : null;
        $this->description             = isset($request['description']) ? $request['description'] : null;
        $this->mobile             = isset($request['mobile']) ? $request['mobile'] : null;
        $this->email             = isset($request['email']) ? $request['email'] : null;
        $this->mailer             = isset($request['mailer']) ? $request['mailer'] : null;
        $this->mailpath             = isset($request['mailpath']) ? $request['mailpath'] : null;
        $this->smtphost             = isset($request['smtphost']) ? $request['smtphost'] : null;
        $this->smtpemail             = isset($request['smtpemail']) ? $request['smtpemail'] : null;
        $this->smtppassword             = isset($request['smtppassword']) ? $request['smtppassword'] : null;
        $this->port             = isset($request['port']) ? $request['port'] : null;
        $this->ssl_tls_type             = isset($request['ssl_tls_type']) ? $request['ssl_tls_type'] : null;
        $this->google_play_store_link             = isset($request['google_play_store_link']) ? $request['google_play_store_link'] : null;
        $this->ios_play_store_link             = isset($request['ios_play_store_link']) ? $request['ios_play_store_link'] : null;
        $this->recaptcha_key             = isset($request['recaptcha_key']) ? $request['recaptcha_key'] : null;
        $this->recaptcha_secret             = isset($request['recaptcha_secret']) ? $request['recaptcha_secret'] : null;

        $this->facebook_link             = isset($request['facebook_link']) ? $request['facebook_link'] : null;
        $this->instagram_link             = isset($request['instagram_link']) ? $request['instagram_link'] : null;
        $this->youtube_link             = isset($request['youtube_link']) ? $request['youtube_link'] : null;

        $this->keyword           = isset($request['keyword']) ? $request['keyword'] : null;
        $this->search_val        = isset($request['search_val']) ? $request['search_val'] : null;
        $this->field_db          = isset($request['field_db']) ? $request['field_db'] : null;
        $this->per_page          = isset($request['per_page']) ? $request['per_page'] : null;
    }


    public function getImageApiUrl()
    {
        return $this->image_api_url;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getLogo()
    {
        return $this->logo;
    }
    public function getLogoencode()
    {
        return $this->logoencode;
    }
    public function getFavicon()
    {
        return $this->favicon;
    }
    public function getFaviconencode()
    {
        return $this->faviconencode;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMailer()
    {
        return $this->mailer;
    }
    public function getMailpath()
    {
        return $this->mailpath;
    }
    public function getSmtphost()
    {
        return $this->smtphost;
    }
    public function getSmtpemail()
    {
        return $this->smtpemail;
    }
    public function getSmtppassword()
    {
        return $this->smtppassword;
    }
    public function getPort()
    {
        return $this->port;
    }
    public function getSsltlstype()
    {
        return $this->ssl_tls_type;
    }
    public function getGoogleplaystorelink()
    {
        return $this->google_play_store_link;
    }
    public function getIosplaystorelink()
    {
        return $this->ios_play_store_link;
    }
    public function getRecaptchakey()
    {
        return $this->recaptcha_key;
    }
    public function getRecaptchasecret()
    {
        return $this->recaptcha_secret;
    }

    public function getFaceBookLink()
    {
        return $this->facebook_link;
    }

    public function getInstagramLink()
    {
        return $this->instagram_link;
    }

    public function getYoutubeLink()
    {
        return $this->youtube_link;
    }


    public function getPerPage()
    {
        return $this->per_page;
    }
    public function getFieldDB()
    {
        return $this->field_db;
    }
    public function getSearchVal()
    {
        return $this->search_val;
    }
    public function getKeyword()
    {
        return $this->keyword;
    }
}