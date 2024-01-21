<?php

namespace App\Containers\AppSection\InquiryQuotation\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="jp_tenantusers")
 */
class InquiryQuotation
{
    protected $inquiry_type;
    protected $inquiry_code;
    protected $client_name;
    protected $email;
    protected $village;
    protected $mobile;
    protected $address;
    protected $country;
    protected $state;
    protected $city;
    protected $is_active;
    protected $keyword;
    protected $remarks;
    protected $company_name;
    protected $followup_date;
    protected $delivery_time_period;

    protected $client_inquiry_id;
    protected $quotation_code;
    protected $product_name;
    protected $products;
    protected $create_products;
    protected $update_products;
    protected $qty;
    protected $base_price;
    protected $extra_price;
    protected $discount_price;
    protected $created_by;
    protected $updated_by;

    protected $search_val;
    protected $field_db;
    protected $per_page;

    public function __construct($request = null)
    {
        $this->village = isset($request['village']) ? $request['village'] : null;
        $this->inquiry_type = isset($request['inquiry_type']) ? $request['inquiry_type'] : null;
        $this->inquiry_code = isset($request['inquiry_code']) ? $request['inquiry_code'] : null;
        $this->client_name = isset($request['client_name']) ? $request['client_name'] : null;
        $this->email = isset($request['email']) ? $request['email'] : null;
        $this->mobile = isset($request['mobile']) ? $request['mobile'] : null;
        $this->address = isset($request['address']) ? $request['address'] : null;
        $this->country = isset($request['country']) ? $request['country'] : null;
        $this->state = isset($request['state']) ? $request['state'] : null;
        $this->city = isset($request['city']) ? $request['city'] : null;
        $this->is_active = isset($request['is_active']) ? $request['is_active'] : null;
        $this->keyword = isset($request['keyword']) ? $request['keyword'] : null;
        $this->remarks = isset($request['remarks']) ? $request['remarks'] : null;
        $this->company_name = isset($request['company_name']) ? $request['company_name'] : null;
        $this->followup_date = isset($request['followup_date']) ? $request['followup_date'] : null;
        $this->delivery_time_period = isset($request['delivery_time_period']) ? $request['delivery_time_period'] : null;

        $this->client_inquiry_id = isset($request['client_inquiry_id']) ? $request['client_inquiry_id'] : null;
        $this->quotation_code = isset($request['quotation_code']) ? $request['quotation_code'] : null;
        $this->product_name = isset($request['product_name']) ? $request['product_name'] : null;
        $this->products = isset($request['products']) ? $request['products'] : null;
        $this->create_products = isset($request['create_products']) ? $request['create_products'] : null;
        $this->update_products = isset($request['update_products']) ? $request['update_products'] : null;
        $this->qty = isset($request['qty']) ? $request['qty'] : null;
        $this->base_price = isset($request['base_price']) ? $request['base_price'] : null;
        $this->extra_price = isset($request['extra_price']) ? $request['extra_price'] : null;
        $this->discount_price = isset($request['discount_price']) ? $request['discount_price'] : null;
        $this->created_by = isset($request['created_by']) ? $request['created_by'] : null;
        $this->updated_by = isset($request['updated_by']) ? $request['updated_by'] : null;


        $this->keyword =  isset($request['keyword']) ? $request['keyword'] : null;
        $this->search_val =  isset($request['search_val']) ? $request['search_val'] : null;
        $this->field_db =  isset($request['field_db']) ? $request['field_db'] : null;
        $this->per_page = isset($request['per_page']) ? $request['per_page'] : null;
    }

    public function getInquiryType()
    {
        return $this->inquiry_type;
    }
    public function getVillage()
    {
        return $this->village;
    }

    public function getInquiryCode()
    {
        return $this->inquiry_code;
    }

    public function getClientName()
    {
        return $this->client_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getIsActive()
    {
        return $this->is_active;
    }

    public function getKeyword()
    {
        return $this->keyword;
    }

    public function getRemarks()
    {
        return $this->remarks;
    }

    public function getCompanyName()
    {
        return $this->company_name;
    }

    public function getFollowupDate()
    {
        return $this->followup_date;
    }

    public function getDeliveryTimePeriod()
    {
        return $this->delivery_time_period;
    }

    public function getClientInquiryId()
    {
        return $this->client_inquiry_id;
    }

    public function getQuotationCode()
    {
        return $this->quotation_code;
    }

    public function getProductName()
    {
        return $this->product_name;
    }
    public function getProducts()
    {
        return $this->products;
    }

    public function getCreateProducts()
    {
        return $this->create_products;
    }

    public function getUpdateProducts()
    {
        return $this->update_products;
    }


    public function getQty()
    {
        return $this->qty;
    }

    public function getBasePrice()
    {
        return $this->base_price;
    }

    public function getExtraPrice()
    {
        return $this->extra_price;
    }

    public function getDiscountPrice()
    {
        return $this->discount_price;
    }

    public function getCreatedBy()
    {
        return $this->created_by;
    }

    public function getUpdatedBy()
    {
        return $this->updated_by;
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
