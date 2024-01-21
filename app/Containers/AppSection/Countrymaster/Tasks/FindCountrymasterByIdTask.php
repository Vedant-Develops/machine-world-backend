<?php

namespace App\Containers\AppSection\Countrymaster\Tasks;

use App\Containers\AppSection\Countrymaster\Data\Repositories\CountrymasterRepository;
use App\Containers\AppSection\Countrymaster\Models\Countrymaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindCountrymasterByIdTask extends ParentTask
{
    public function __construct(
        protected CountrymasterRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Countrymaster
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
