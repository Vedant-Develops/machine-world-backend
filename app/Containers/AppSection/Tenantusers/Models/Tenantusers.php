<?php

namespace App\Containers\AppSection\Tenantusers\Models;

use App\Containers\AppSection\Authentication\Notifications\VerifyEmail;
use App\Containers\AppSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;
use App\Ship\Contracts\MustVerifyEmail;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Validation\Rules\Password;


// use App\Ship\Parents\Models\Model as ParentModel;

class Tenantusers extends  ParentUserModel implements MustVerifyEmail
{

  use AuthorizationTrait;
  use AuthenticationTrait;

  protected $table = 'mw_tenantusers';
  protected $fillable = [
    'id',
    'role_id',
    'first_name',
    'middle_name',
    'last_name',
    'profile_image',
    'dob',
    'gender',
    'email',
    'password',
    'user_has_key',
    'mobile',
    'address',
    'country',
    'state',
    'city',
    'zipcode',
    'is_active',
    'created_by',
    'updated_by',
  ];

  protected $hidden = [];

  protected $casts = [];
  protected $dates = [
    'created_at',
    'updated_at',
  ];

  public function role()
  {
    return $this->hasMany(Role::class, 'id', 'role_id');
  }


  public function sendEmailVerificationNotificationWithVerificationUrl(string $verificationUrl): void
  {
    $this->notify(new VerifyEmail($verificationUrl));
  }

  /**
   * A resource key to be used in the serialized responses.
   */
  protected string $resourceKey = 'Tenantusers';
}
