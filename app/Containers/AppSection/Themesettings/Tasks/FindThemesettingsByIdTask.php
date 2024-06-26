<?php

namespace App\Containers\AppSection\Themesettings\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Themesettings\Data\Repositories\ThemesettingsRepository;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Apiato\Core\Traits\HashIdTrait;

class FindThemesettingsByIdTask extends ParentTask
{
    use HashIdTrait;
    protected ThemesettingsRepository $repository;
    public function __construct(ThemesettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            $returnData = array();
            $image_api_url = Themesettings::select('image_api_url')->where('id', 1)->first();
            $getData = Themesettings::where('id', $id)->first();
            if ($getData != "" && $getData != null) {
                $returnData['message'] = "Data Found";
                $returnData['data']['objects'] = 'sjp_theme_settings';
                $returnData['data']['id'] = $this->encode($getData->id);
                $returnData['data']['name'] = $getData->name;
                $returnData['data']['logo'] = ($getData->logo) ? $image_api_url->image_api_url . $getData->logo : "";
                $returnData['data']['favicon'] = ($getData->favicon) ? $image_api_url->image_api_url . $getData->favicon : "";
                $returnData['data']['description'] = $getData->description;
                $returnData['data']['mobile'] = $getData->mobile;
                $returnData['data']['email'] = $getData->email;
                $returnData['data']['address'] = $getData->address;
                $returnData['data']['mailer'] = $getData->mailer;
                $returnData['data']['mailpath'] = $getData->mailpath;
                $returnData['data']['smtphost'] = $getData->smtphost;
                $returnData['data']['smtpemail'] = $getData->smtpemail;
                $returnData['data']['smtppassword'] = $getData->smtppassword;
                $returnData['data']['port'] = $getData->port;
                $returnData['data']['ssl_tls_type'] = $getData->ssl_tls_type;
                $returnData['data']['google_play_store_link'] = $getData->google_play_store_link;
                $returnData['data']['ios_play_store_link'] = $getData->ios_play_store_link;
                $returnData['data']['recaptcha_key'] = $getData->recaptcha_key;
                $returnData['data']['recaptcha_secret'] = $getData->recaptcha_secret;
                $returnData['data']['facebook_link'] = $getData->facebook_link;
                $returnData['data']['instagram_link'] = $getData->instagram_link;
                $returnData['data']['youtube_link'] = $getData->youtube_link;
                $returnData['data']['image_api_url'] = $getData->image_api_url;
                $returnData['data']['cgst'] = $getData->cgst;
                $returnData['data']['sgst'] = $getData->sgst;
                $returnData['data']['igst'] = $getData->igst;

                $returnData['data']['bank_acc_no'] = $getData->bank_acc_no;
                $returnData['data']['bank_name'] = $getData->bank_name;
                $returnData['data']['ifsc_no'] = $getData->ifsc_no;
                $returnData['data']['gst_no'] = $getData->gst_no;
                $returnData['data']['office_address'] = $getData->office_address;
                $returnData['data']['factory_address'] = $getData->factory_address;

                $returnData['data']['created_at'] = $getData->created_at;
                $returnData['data']['updated_at'] = $getData->updated_at;
                $returnData['data']['deleted_at'] = $getData->deleted_at;
            } else {
                $returnData = [
                    'message' => "No Data Found",
                    'object' => "sjp_theme_settings",
                    'data' => [],
                ];
            }
            $returnData['message'] = "Data Found";
            $returnData['data']['objects'] = "sjp_theme_settings";
            // $returnData['data'] =  $this->repository->find($id);
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to find the resource. Please try again later.',
                'object' => 'sjp_theme_settings',
                'data' => [],
            ];
        }
    }
}
