<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * Class UsersRepository
 * @package App\Repository
 */
class UsersRepository extends BaseRepository
{
    /**
     * UsersRepository constructor.
     * @param ManagerRegistry $registry
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ManagerRegistry $registry, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($registry, Users::class, $eventDispatcher);
    }
}
