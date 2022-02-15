<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 25.01.22
 * Time: 18:44
 */

namespace App\Event\Subscriber;

use App\Entity\Todo;
use App\Entity\UserActivityHistory;
use App\Entity\UserActivityName;
use App\Entity\Users;
use App\Repository\UserActivityHistoryRepository;
use App\Repository\UserActivityNameRepository;
use App\Repository\UsersRepository;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class EntityActionSubscriber
 * @package App\Event\Subscriber
 */
class EntityActionSubscriber implements EventSubscriberInterface
{
    protected $activityHistoryRepository;
    protected $activityNameRepository;
    protected $tokenStorage;


    public function __construct(
        UserActivityHistoryRepository $activityHistoryRepository,
        UserActivityNameRepository $activityNameRepository,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->activityHistoryRepository = $activityHistoryRepository;
        $this->activityNameRepository = $activityNameRepository;
        $this->tokenStorage = $tokenStorage;
    }
    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate,
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logActivity($args);
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->logActivity($args);
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->logActivity($args);
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function logActivity(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $entityNameParts = explode('\\', get_class($entity));

        $request = Request::createFromGlobals();
        $pathParts = explode('/', $request->getPathInfo());

        /** @var Users $user */
//        $user = $this->tokenStorage->getToken()->getUser();

//        if (null === $user) {
//            return;
//        }
//
//        if ($entity instanceof Todo) {
//            /** @var UserActivityHistory $userActivity */
//            $userActivity = $this->activityHistoryRepository->getEntityObject();
//            /** @var UserActivityName $userActivityName */
//            $userActivityName = $this->activityNameRepository->getActivityName($pathParts[2]);
//            $userActivity->setEntityName(end($entityNameParts));
//            $userActivity->setActivity($userActivityName);
//            $userActivity->setUser($user);
//            $this->activityHistoryRepository->save($userActivity);
//        }
    }
}