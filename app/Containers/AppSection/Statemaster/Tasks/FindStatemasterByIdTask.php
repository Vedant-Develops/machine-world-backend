<?php

namespace App\Containers\AppSection\Statemaster\Tasks;

use App\Containers\AppSection\Statemaster\Data\Repositories\StatemasterRepository;
use App\Containers\AppSection\Statemaster\Models\Statemaster;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindStatemasterByIdTask extends ParentTask
{
    public function __construct(
        protected StatemasterRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Statemaster
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
