<?php

namespace App\Containers\AppSection\Tenantusers\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jp_tenantusers")
 */
class Tenantusers
{
    protected $user_id;
    protected $role_id;
    protected $role_id_encode;
    protected $first_name;
    protected $middle_name;
    protected $last_name;
    protected $profile_image_encode;
    protected $profile_image;
    protected $dob;
    protected $dobformat;
    protected $gender;
    protected $email;
    protected $mobile;
    protected $otp;
    protected $address;
    protected $country_id;
    protected $state_id;
    protected $city_id;
    protected $zipcode;
    protected $is_active;
    protected $oldpassword;
    protected $password;
    protected $newpassword;
    protected $newrepassword;
    protected $keyword;
    protected $notes;
    protected $user_encode_id;
    protected $useremail;
    protected $search_val;
    protected $field_db;
    protected $per_page;

    public function __construct($request = null)
    {
     
        $this->profile_image_encode             = isset($request['profile_image_encode']) ? $request['profile_image_encode'] : null;
        $this->user_id             = isset($request['user_id']) ? $request['user_id'] : null;
     
        $this->role_id             = isset($request['role_id']) ? $request['role_id'] : null;
        $this->role_id_encode             = isset($request['role_id_encode']) ? $request['role_id_encode'] : null;
        $this->first_name          = isset($request['first_name']) ? $request['first_name'] : null;
        $this->middle_name          = isset($request['middle_name']) ? $request['middle_name'] : null;
        $this->last_name          = isset($request['last_name']) ? $request['last_name'] : null;
        $this->dob          = isset($request['dob']) ? $request['dob'] : null;
        $this->dobformat          = isset($request['dobformat']) ? $request['dobformat'] : null;
        $this->gender          = isset($request['gender']) ? $request['gender'] : null;
        $this->email          = isset($request['email']) ? $request['email'] : null;
        $this->mobile          = isset($request['mobile']) ? $request['mobile'] : null;
        $this->otp          = isset($request['otp']) ? $request['otp'] : null;
        $this->address          = isset($request['address']) ? $request['address'] : null;
        $this->country_id          = isset($request['country_id']) ? $request['country_id'] : null;
        $this->state_id          = isset($request['state_id']) ? $request['state_id'] : null;
        $this->city_id          = isset($request['city_id']) ? $request['city_id'] : null;
        $this->zipcode          = isset($request['zipcode']) ? $request['zipcode'] : null;
        $this->is_active          = isset($request['is_active']) ? $request['is_active'] : null;
        $this->password          = isset($request['password']) ? $request['password'] : null;
        $this->oldpassword          = isset($request['oldpassword']) ? $request['oldpassword'] : null;
        $this->newpassword          = isset($request['newpassword']) ? $request['newpassword'] : null;
        $this->newrepassword          = isset($request['newrepassword']) ? $request['newrepassword'] : null;

        $this->notes          = isset($request['notes']) ? $request['notes'] : null;
        $this->user_encode_id          = isset($request['user_encode_id']) ? $request['user_encode_id'] : null;
     
        $this->keyword =  isset($request['keyword']) ? $request['keyword'] : null;
        $this->search_val =  isset($request['search_val']) ? $request['search_val'] : null;
        $this->field_db =  isset($request['field_db']) ? $request['field_db'] : null;
        $this->per_page = isset($request['per_page']) ? $request['per_page'] : null;
    }

    public function getUserEncodeID()
    {
        return $this->user_encode_id;
    }
    public function getNotes()
    {
        return $this->notes;
    }

    public function getUserID()
    {
        return $this->user_id;
    }
    public function getNewRePassword()
    {
        return $this->newrepassword;
    }
    public function getNewPassword()
    {
        return $this->newpassword;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getOldPassword()
    {
        return $this->oldpassword;
    }
    public function getRoleID()
    {
        return $this->role_id;
    }
    public function getRoleIDEncode()
    {
        return $this->role_id_encode;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getMiddleName()
    {
        return $this->middle_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }
    public function getProfileImage()
    {
        return $this->profile_image;
    }
    public function getProfileImageEncode()
    {
        return $this->profile_image_encode;
    }

    public function getDOB()
    {
        return $this->dob;
    }
    public function getDOBFormat()
    {
        return $this->dobformat;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
    public function getOTP()
    {
        return $this->otp;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getCountry()
    {
        return $this->country_id;
    }
    public function getState()
    {
        return $this->state_id;
    }
    public function getCity()
    {
        return $this->city_id;
    }
    public function getZipcode()
    {
        return $this->zipcode;
    }
    public function getIsActive()
    {
        return $this->is_active;
    }
    public function getKeyword()
    {
        return $this->keyword;
    }

    public function getSearchVal()
    {
        return $this->search_val;
    }

    public function getFieldDB()
    {
        return $this->field_db;
    }

    public function getPerPage()
    {
        return $this->per_page;
    }
}
