<?php

namespace App\Containers\AppSection\Countrymaster\Tasks;

use Apiato\Core\Traits\HashIdTrait;
use App\Containers\AppSection\Countrymaster\Data\Repositories\CountrymasterRepository;
use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindCountrymasterByIdTask extends ParentTask
{
    use HashIdTrait;
    protected CountrymasterRepository $repository;
    public function __construct(CountrymasterRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $getData = Countrymaster::where('id', $id)->first();
            $returnData = array();
            if (!empty($getData)) {
                $returnData['message'] = "Data Found";
                $returnData['object'] = "mw_countrymaster";
                $returnData['data']['id'] = $this->encode($getData->id);
                $returnData['data']['country'] = $getData->country;
                $returnData['data']['is_active'] = $getData->is_active;
                $returnData['data']['created_at'] = $getData->created_at;
                $returnData['data']['updated_at'] = $getData->updated_at;
            } else {
                $returnData['message'] = "Data Not Found";
                $returnData['object'] = "mw_countrymaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to Find the resource. Please try again later.',
                'object' => 'mw_countrymaster',
                'data' => [],
            ];
        }
    }
}
