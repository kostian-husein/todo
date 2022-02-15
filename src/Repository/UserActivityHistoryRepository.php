<?php

namespace App\Repository;

use App\Entity\UserActivityHistory;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
/**
 * Class UserActivityHistoryRepository
 * @package App\Repository
 */
class UserActivityHistoryRepository extends BaseRepository
{
    /**
     * UserActivityHistoryRepository constructor.
     * @param ManagerRegistry $registry
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ManagerRegistry $registry, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($registry, UserActivityHistory::class, $eventDispatcher);
    }

    /**
     * @param $user
     * @param $activityName
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addActivityHistory($user, $activityName)
    {
        $history = $this->getEntityObject();
        $history->setUser($user);
        $history->setActivity($activityName);
        $history->setEntityName(1);
        $this->save($history);
    }

    public function getHistory(){

    }
}
