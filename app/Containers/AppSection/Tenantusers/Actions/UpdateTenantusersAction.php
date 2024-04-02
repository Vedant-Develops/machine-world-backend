<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Tenantusers\Tasks\UpdateTenantusersTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\UpdateTenantusersRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;
use carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UpdateTenantusersAction extends ParentAction
{
  use HashIdTrait;
  public function run(UpdateTenantusersRequest $request, $InputData)
  {
    $getTenant = Auth::user();
    $tenantid = $getTenant['id'];
    $userImage = '';
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

    $country_id = $this->decode($InputData->getCountry());
    $state_id = $this->decode($InputData->getState());
    $city_id = $this->decode($InputData->getCity());

    if ($userImage == "") {
      $data = $request->sanitizeInput([
        'first_name' => $InputData->getFirstName(),
        'middle_name' => $InputData->getMiddleName(),
        'last_name' => $InputData->getLastName(),
        'dob' => Carbon\Carbon::parse($InputData->getDOBFormat())->format('Y-m-d'),
        'gender' => $InputData->getGender(),
        'mobile' => $InputData->getMobile(),
        'address' => $InputData->getAddress(),
        // 'country' => $InputData->getCountry(),
        // 'state' => $InputData->getState(),
        // 'city' => $InputData->getCity(),
        'zipcode' => $InputData->getZipcode(),
      ]);
      $data['country_id'] = $country_id;
      $data['state_id'] = $state_id;
      $data['city_id'] = $city_id;
    } else {
      $data = $request->sanitizeInput([
        'first_name' => $InputData->getFirstName(),
        'middle_name' => $InputData->getMiddleName(),
        'last_name' => $InputData->getLastName(),
        'profile_image' => $userImage,
        'dob' => Carbon\Carbon::parse($InputData->getDOBFormat())->format('Y-m-d'),
        'gender' => $InputData->getGender(),
        'mobile' => $InputData->getMobile(),
        'address' => $InputData->getAddress(),
        // 'country' => $InputData->getCountry(),
        // 'state' => $InputData->getState(),
        // 'city' => $InputData->getCity(),
        'zipcode' => $InputData->getZipcode(),
        'created_by' =>  $tenantid,
        'updated_by' =>  $tenantid,
      ]);
      $data['country_id'] = $country_id;
      $data['state_id'] = $state_id;
      $data['city_id'] = $city_id;
    }
    $data = array_filter($data);

    return app(UpdateTenantusersTask::class)->run($data, $request->id);
  }
}
