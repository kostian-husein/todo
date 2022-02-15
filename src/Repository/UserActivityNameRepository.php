<?php

namespace App\Repository;

use App\Entity\UserActivityName;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * Class UserActivityNameRepository
 * @package App\Repository
 */
class UserActivityNameRepository extends BaseRepository
{
    /**
     * UserActivityNameRepository constructor.
     * @param ManagerRegistry $registry
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ManagerRegistry $registry, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($registry, UserActivityName::class, $eventDispatcher);
    }

    /**
     * @param $activity
     * @return null|object
     */
    public function getActivityName($activity)
    {
        return $this->_em->getRepository($this->_entityName)->findOneBy(['activityName' => $activity]);
    }
}
