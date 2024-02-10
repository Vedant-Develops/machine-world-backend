<?php

namespace App\Containers\AppSection\Countrymaster\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jp_tenantusers")
 */
class Countrymaster
{
    protected $country_id;
    protected $flag;
    protected $state_id;
    protected $country;
    protected $is_active;

    protected $search_val;
    protected $field_db;
    protected $per_page;

    public function __construct($request = null)
    {
        $this->flag =  isset($request['flag']) ? $request['flag'] : null;
        $this->country_id =  isset($request['country_id']) ? $request['country_id'] : null;
        $this->state_id =  isset($request['state_id']) ? $request['state_id'] : null;
        $this->country =  isset($request['country']) ? $request['country'] : null;
        $this->is_active =  isset($request['is_active']) ? $request['is_active'] : null;

        $this->search_val =  isset($request['search_val']) ? $request['search_val'] : null;
        $this->field_db =  isset($request['field_db']) ? $request['field_db'] : null;
        $this->per_page = isset($request['per_page']) ? $request['per_page'] : null;
    }


    public function getFlag()
    {
        return $this->flag;
    }

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function getStateId()
    {
        return $this->state_id;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getIsActive()
    {
        return $this->is_active;
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
