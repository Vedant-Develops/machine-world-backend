<?php

namespace App\Containers\AppSection\Countrymaster\Tasks;

use App\Containers\AppSection\Countrymaster\Data\Repositories\CountrymasterRepository;
use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeleteCountrymasterTask extends ParentTask
{
    protected CountrymasterRepository $repository;
    public function __construct(CountrymasterRepository $repository)
    {
        $this->repository = $repository;
    }


    public function run($id)
    {
        try {
            $getData = Countrymaster::where('id', $id)->first();
            if (!empty($getData)) {
                $delete = $this->repository->delete($id);
                $returnData['message'] = "Data Deleted Successfully";
                $returnData['object'] = "mw_countrymaster";
            } else {
                $returnData['message'] = "Data not Found";
                $returnData['object'] = "mw_countrymaster";
            }
            return $returnData;
        } catch (Exception $e) {
            return [
                'message' => 'Error: Failed to delete the resource. Please try again later.',
                'object' => 'mw_countrymaster',
                'data' => [],
            ];
        }
    }
}
