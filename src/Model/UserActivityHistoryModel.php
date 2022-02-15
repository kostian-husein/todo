<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 23.01.22
 * Time: 19:48
 */

namespace App\Model;

use App\Repository\UserActivityHistoryRepository;
use App\Repository\UsersRepository;
use App\Entity\UserActivityHistory;

/**
 * Class UserActivityHistoryModel
 * @package App\Model
 */
class UserActivityHistoryModel
{
    /**
     * @var UserActivityHistoryRepository
     */
    protected $repository;

    /**
     * UserActivityHistoryModel constructor.
     * @param UserActivityHistoryRepository $repository
     */
    public function __construct(UserActivityHistoryRepository $repository)
    {
        $this->repository = $repository;
    }


}