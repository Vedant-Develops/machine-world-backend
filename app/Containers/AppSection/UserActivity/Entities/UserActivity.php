<?php

namespace App\Containers\AppSection\UserActivity\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jp_tenantusers")
 */
class UserActivity
{
    protected $user_id;
    protected $role_id;
    protected $event_name;
    protected $module;
    protected $created_by;
    protected $date_from;
    protected $date_to;


    protected $search_val;
    protected $field_db;
    protected $per_page;
    public function __construct($request)
    {
        $this->user_id = isset($request['user_id']) ? $request['user_id'] : null;
        $this->date_from = isset($request['date_from']) ? $request['date_from'] : null;
        $this->date_to = isset($request['date_to']) ? $request['date_to'] : null;
        $this->role_id = isset($request['role_id']) ? $request['role_id'] : null;
        $this->event_name = isset($request['event_name']) ? $request['event_name'] : null;
        $this->module = isset($request['module']) ? $request['module'] : null;
        $this->created_by = isset($request['created_by']) ? $request['created_by'] : null;

        $this->search_val =  isset($request['search_val']) ? $request['search_val'] : null;
        $this->field_db =  isset($request['field_db']) ? $request['field_db'] : null;
        $this->per_page = isset($request['per_page']) ? $request['per_page'] : null;
    }

    public function getDateFrom()
    {
        return $this->date_from;
    }
    public function getDateTo()
    {
        return $this->date_to;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getRoleId()
    {
        return $this->role_id;
    }


    public function getEventName()
    {
        return $this->event_name;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getCreatedBy()
    {
        return $this->created_by;
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
