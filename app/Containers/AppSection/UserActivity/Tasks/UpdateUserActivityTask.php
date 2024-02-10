<?php

namespace App\Containers\AppSection\UserActivity\Tasks;

use App\Containers\AppSection\UserActivity\Data\Repositories\UserActivityRepository;
use App\Containers\AppSection\UserActivity\Models\UserActivity;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateUserActivityTask extends ParentTask
{
    public function __construct(
        protected UserActivityRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): UserActivity
    {
        try {
            return $this->repository->update($data, $id);
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
