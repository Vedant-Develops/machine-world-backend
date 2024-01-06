<?php

namespace App\Containers\AppSection\Tenantusers\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Tenantusers\Tasks\UpdateTenantusersPasswordTask;
use App\Containers\AppSection\Tenantusers\UI\API\Requests\UpdateTenantusersRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateTenantusersPasswordAction extends ParentAction
{
  use HashIdTrait;
  public function run(UpdateTenantusersRequest $request, $InputData)
  {

    $getTenant = Auth::user();
    $tenantid = $getTenant['id'];
    $get_current_pass = Tenantusers::where('id', $tenantid)->first();
    $current_password = $InputData->getOldPassword();
    $newpassword = $InputData->getNewPassword();
    $newrepassword = $InputData->getNewRePassword();
    if ($current_password == $get_current_pass->user_has_key) {
      if ($newpassword == $newrepassword) {
        $data = $request->sanitizeInput([
          'password' => Hash::make($newpassword),
          'user_has_key' => $newpassword,
        ]);
        $returnData = app(UpdateTenantusersPasswordTask::class)->run($data, $tenantid);
      } else {
        $returnData['message'] = "New passwords are not matching";
      }
    } else {
      $returnData['message'] = "Current Passwords are not matching";
    }


    return $returnData;
  }
}
