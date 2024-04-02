<?php

namespace App\Containers\AppSection\Tenantusers\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Tenantusers\Data\Repositories\TenantusersRepository;
use App\Containers\AppSection\Tenantusers\Models\Emailtemplate;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use Config;
use Illuminate\Support\Facades\Hash;

class ResetTenantusersPasswordTask extends ParentTask
{
    use HashIdTrait;
    protected TenantusersRepository $repository;

    public function __construct(TenantusersRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($InputData)
    {
        try {

            $returnData = array();
            $getData = TenantUsers::where('email', $InputData->getEmail())->first();

            if ($getData !== null) {
                $uniquePassword = "mw654321";
                $getData->password = Hash::make($uniquePassword);
                $getData->user_has_key = $uniquePassword;
                $getData->save();
                if ($getData->user_has_key == $uniquePassword) {
                    // Mail Sent to User

                    $email_template = Emailtemplate::where('task', 'reset_password')->first();
                    $theme_setting = Themesettings::where('id', 1)->first();
                    $tenantuserData = Tenantusers::where('id', $getData->id)->first();

                    $replaceText_subject = array(
                        '{app_name}'          => $theme_setting->name,
                    );
                    $subject  = strtr($email_template->subject, $replaceText_subject);

                    $replaceText = array(
                        '{user_name}'    => $tenantuserData->first_name . " " . $tenantuserData->last_name,
                        '{app_name}'     => $theme_setting->name,
                        '{email}'     => $tenantuserData->email,
                        '{password}'     => $tenantuserData->user_has_key,
                    );
                    $templateString       = strtr($email_template->message, $replaceText);
                    $datatenantuser['message']      = $templateString;
                    $datatenantuser['email']        = $tenantuserData->email;
                    $datatenantuser['name']         = $tenantuserData->first_name . " " . $tenantuserData->last_name;
                    $datatenantuser['sitename']     = $theme_setting->name;
                    $datatenantuser['tenantemail']     = $theme_setting->email;
                    $datatenantuser['tenantname']     = $theme_setting->name;
                    $datatenantuser['mobile']       = $theme_setting->mobile;
                    $datatenantuser['sitelogo'] =   ($theme_setting->logo) ? $theme_setting->image_api_url . $theme_setting->logo : "";


                    $config = array(
                        'driver'     => trim($theme_setting->mailer),
                        'host'       => trim($theme_setting->smtphost),
                        'port'       => trim($theme_setting->port),
                        'from'       => array('address' => $theme_setting->smtpemail, 'name' => $theme_setting->name),
                        'encryption' => $theme_setting->ssl_tls_type,
                        'username'   => trim($theme_setting->smtpemail),
                        'password'   => trim($theme_setting->smtppassword),
                        'sendmail'   => '/usr/sbin/sendmail -bs',
                    );
                    config::set('mail', $config);

                    Mail::send('appSection@tenantusers::forgotpassword', ['data' => $datatenantuser], function ($m) use ($datatenantuser, $subject) {
                        $m->to($datatenantuser['email'], $datatenantuser['name'])->subject($subject);
                        if (isset($datatenantuser['attacheFile'])) $m->attach($datatenantuser['attacheFile']);
                    });
                }

                $returnData['message'] = "Password reset successfully!!";
                $returnData['object'] = "tenantusers";
            } else {
                $returnData['message'] = "User Not found.";
                $returnData['object'] = "tenantusers";
                $returnData['data'] = [];
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to update password. Please try again later.',
                'object' => 'tenantusers',
                'data' => [],
            ];
        }
    }
}
