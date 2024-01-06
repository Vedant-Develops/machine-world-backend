<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Tenantusers\Tasks\CreateTenantusersTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\CreateTenantusersRequest;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use carbon;
use Illuminate\Support\Facades\Hash;

class CreateTenantusersAction extends ParentAction
{
  use HashIdTrait;
  public function run(CreateTenantusersRequest $request, $InputData)
  {
    $getTenant = Auth::user();
    $returnData = array();
    $role_id = $this->decode($InputData->getRoleIDEncode());
    $tenantid = $getTenant['id'];

    if ($role_id != 1) {



      $image_api_url = Themesettings::where('id', 1)->first();
      // User Image
      if ($InputData->getProfileImageEncode() != null) {
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($InputData->getProfileImageEncode());
        if (!file_exists(public_path('profileimages/'))) {
          mkdir(public_path('profileimages/'), 0755, true);
        }
        $image_type = "png";
        $folderPath = 'api/public/profileimages/';
        $file = $tenantid . '_' . uniqid() . '.' . $image_type;
        $saveimage = $image->toPng()->save(public_path('profileimages/' . $file));
        $userImage  =  $folderPath . $file;
      } else {
        $userImage = '';
      }


      $uniquePassword = "mw123456";

      $check_email = Tenantusers::select('email')->where('email', $InputData->getEmail())->count();

      if ($check_email == 0) {
        $data = $request->sanitizeInput([
          'role_id' => $role_id,
          'first_name' => $InputData->getFirstName(),
          'middle_name' => $InputData->getMiddleName(),
          'last_name' => $InputData->getLastName(),
          'profile_image' => $userImage,
          'dob' => Carbon\Carbon::parse($InputData->getDOBFormat())->format('Y-m-d'),
          'gender' => $InputData->getGender(),
          'email' => $InputData->getEmail(),
          'password' => Hash::make($uniquePassword),
          'user_has_key' => $uniquePassword,
          'mobile' => $InputData->getMobile(),
          'address' => $InputData->getAddress(),
          'country' => $InputData->getCountry(),
          'state' => $InputData->getState(),
          'city' => $InputData->getCity(),
          'zipcode' => $InputData->getZipcode(),
          'is_active' => $InputData->getIsActive(),
          'created_by' =>  $tenantid,
          'updated_by' =>  $tenantid,
        ]);
      } else {
        $returnData['messsage'] = "Email Already Exists in System";
        return $returnData;
      }
    } else {
      $returnData['messsage'] = "Your are not authorised to make a admin";
      return $returnData;
    }


    return app(CreateTenantusersTask::class)->run($data);
  }
}
