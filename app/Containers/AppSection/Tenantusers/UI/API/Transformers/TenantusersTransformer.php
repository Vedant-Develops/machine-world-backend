<?php

namespace App\Containers\AppSection\Tenantusers\UI\API\Transformers;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;
use carbon;

class TenantusersTransformer extends ParentTransformer
{
    use HashIdTrait;

    protected array $availableIncludes = [];
    protected array $defaultIncludes = [
        'role',
    ];

    public function transform(Tenantusers $tenantusers): array
    {
        $response = [
            'object' => $tenantusers->getResourceKey(),
            'id' => $this->encode($tenantusers->id),
            'role_id'  => $this->encode($tenantusers->role_id),
            'first_name'  => $tenantusers->first_name,
            'middle_name'  => $tenantusers->middle_name,
            'last_name'  => $tenantusers->last_name,
            'profile_image'  => $tenantusers->profile_image,
            'dob'  => Carbon\Carbon::parse($tenantusers->dob)->format('d-m-Y'),
            'gender'  => $tenantusers->gender,
            'email'  => $tenantusers->email,
            'mobile'  => $tenantusers->mobile,
            'address'  => $tenantusers->address,
            'country_id'  => $this->encode($tenantusers->country_id),
            'state_id'  => $this->encode($tenantusers->state_id),
            'city_id'  =>  $this->encode($tenantusers->city_id),
            'zipcode'  => $tenantusers->zipcode,
            'is_active'  => $tenantusers->is_active,
            'created_at' => $tenantusers->created_at,
            'updated_at' => $tenantusers->updated_at,
            'readable_created_at' => $tenantusers->created_at->diffForHumans(),
            'readable_updated_at' => $tenantusers->updated_at->diffForHumans(),
        ];

        return $response;
    }
    public function includeRole(Tenantusers $tenantusers)
    {
        //echo $tenantusers->role_id;die;
        //return $this->collection($tenantusers->role_id, new RoleTransformer(),'Role');
        //$redata[] = $tenantusers->role_id;
        return $this->collection($tenantusers->role, new RoleTransformer());
    }

    // return $this->ifAdmin([
    //     'real_id' => $tenantusers->id,
    //     'created_at' => $tenantusers->created_at,
    //     'updated_at' => $tenantusers->updated_at,
    //     'readable_created_at' => $tenantusers->created_at->diffForHumans(),
    //     'readable_updated_at' => $tenantusers->updated_at->diffForHumans(),
    //     // 'deleted_at' => $tenantusers->deleted_at,
    // ], $response);
}
