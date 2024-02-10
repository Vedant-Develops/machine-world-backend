<?php

namespace App\Containers\AppSection\UserActivity\Tasks;

use App\Containers\AppSection\UserActivity\Data\Repositories\UserActivityRepository;
use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindUserActivityByIdTask extends ParentTask
{
    public function __construct(
        protected UserActivityRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): UserActivity
    {
        try {
            return $this->repository->find($id);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
