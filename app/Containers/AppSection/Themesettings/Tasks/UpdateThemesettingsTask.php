<?php

namespace App\Containers\AppSection\Themesettings\Tasks;

use App\Containers\AppSection\Themesettings\Data\Repositories\ThemesettingsRepository;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Apiato\Core\Traits\HashIdTrait;

class UpdateThemesettingsTask extends ParentTask
{
    use HashIdTrait;
    protected ThemesettingsRepository $repository;
    public function __construct(ThemesettingsRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run(array $save_data_image, $id, $InputData)
    {
        try {
            $data = [
                "description" => $InputData->getDescription(),
                "mobile" => $InputData->getMobile(),
                "email" => $InputData->getEmail(),
                "address" => $InputData->getAddress(),
                "mailer" => $InputData->getMailer(),
                "mailpath" => $InputData->getMailpath(),
                "smtphost" => $InputData->getSmtphost(),
                "smtpemail" => $InputData->getSmtpemail(),
                "smtppassword" => $InputData->getSmtppassword(),
                "port" => $InputData->getPort(),
                "ssl_tls_type" => $InputData->getSsltlstype(),
                "google_play_store_link" => $InputData->getGoogleplaystorelink(),
                "ios_play_store_link" => $InputData->getIosplaystorelink(),
                "recaptcha_key" => $InputData->getRecaptchakey(),
                "recaptcha_secret" => $InputData->getRecaptchasecret(),
                "facebook_link" => $InputData->getFaceBookLink(),
                "instagram_link" => $InputData->getInstagramLink(),
                "youtube_link" => $InputData->getYoutubeLink(),
            ];
            $data = array_filter($data);
            $update = Themesettings::where('id', $id)->update($data);
            $getData = Themesettings::where('id', $id)->first();

            if ($getData != "" && $getData != null) {
                $getData->name = $InputData->getName();
                if ($save_data_image['logo'] != "") {
                    $getData->logo = $save_data_image['logo'];
                }
                if ($save_data_image['fevicon'] != "") {
                    $getData->favicon = $save_data_image['fevicon'];
                }
                $getData->save();

                $returnData['message'] = "Data Updated";
                $returnData['data'] =  $this->repository->find($id);
                return $returnData;
            } else {
                $returnData = [
                    'message' => "No Data Found",
                    'object' => "sjp_theme_settings",
                    'data' => [],
                ];
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to update resource. Please try again later.',
                'object' => 'sjp_theme_settings',
                'data' => [],
            ];
        }
    }
}
