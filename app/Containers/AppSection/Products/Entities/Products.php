<?php

namespace App\Containers\AppSection\Products\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jp_tenantusers")
 */
class Products
{
    protected $type;
    protected $name;
    protected $product_type_id;
    protected $height;
    protected $width;
    protected $length;
    protected $weight;
    protected $power;
    protected $product_video;
    protected $product_image;
    protected $product_specification;
    protected $motor_type;
    protected $diagram_type;
    protected $diagram_value;
    protected $price;
    protected $is_active;
    protected $search_val;
    protected $field_db;
    protected $per_page;
    public function __construct($request)
    {
        $this->type = isset($request['type']) ? $request['type'] : null;
        $this->name = isset($request['name']) ? $request['name'] : null;
        $this->product_type_id = isset($request['product_type_id']) ? $request['product_type_id'] : null;
        $this->height = isset($request['height']) ? $request['height'] : null;
        $this->width = isset($request['width']) ? $request['width'] : null;
        $this->length = isset($request['length']) ? $request['length'] : null;
        $this->weight = isset($request['weight']) ? $request['weight'] : null;
        $this->power = isset($request['power']) ? $request['power'] : null;
        $this->product_video = isset($request['product_video']) ? $request['product_video'] : null;
        $this->product_image = isset($request['product_image']) ? $request['product_image'] : null;
        $this->product_specification = isset($request['product_specification']) ? $request['product_specification'] : null;
        $this->motor_type = isset($request['motor_type']) ? $request['motor_type'] : null;
        $this->diagram_type = isset($request['diagram_type']) ? $request['diagram_type'] : null;
        $this->diagram_value = isset($request['diagram_value']) ? $request['diagram_value'] : null;
        $this->price = isset($request['price']) ? $request['price'] : null;
        $this->is_active = isset($request['is_active']) ? $request['is_active'] : null;
        $this->search_val =  isset($request['search_val']) ? $request['search_val'] : null;
        $this->field_db =  isset($request['field_db']) ? $request['field_db'] : null;
        $this->per_page = isset($request['per_page']) ? $request['per_page'] : null;
    }

    public function getType()
    {
        return $this->type;
    }
    public function getPower()
    {
        return $this->power;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getProductType()
    {
        return $this->product_type_id;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getProductVideo()
    {
        return $this->product_video;
    }

    public function getProductImage()
    {
        return $this->product_image;
    }

    public function getProductSpecification()
    {
        return $this->product_specification;
    }

    public function getMotorType()
    {
        return $this->motor_type;
    }

    public function getDiagramType()
    {
        return $this->diagram_type;
    }

    public function getDiagramValue()
    {
        return $this->diagram_value;
    }

    public function getPrice()
    {
        return $this->price;
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
