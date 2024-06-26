<?php

namespace App\Containers\AppSection\Authentication\Traits;

use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
// use App\Containers\AppSection\User\Models\User;

trait AuthenticationTrait
{
    /**
     * Allows Passport to authenticate users with custom fields.
     */
    public function findForPassport($identifier): ?Tenantusers
    {
        $allowedLoginAttributes = config('appSection-authentication.login.attributes', ['email' => []]);

        $builder = $this;
        foreach (array_keys($allowedLoginAttributes) as $field) {
            $builder = $builder->orWhere($field, $identifier);
        }

        return $builder->first();
    }
}
