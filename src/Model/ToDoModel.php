<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 23.12.21
 * Time: 15:04
 */

namespace App\Model;

use App\Entity\Todo;
use App\Entity\Users;
use App\Event\CustomEvent;
use App\Repository\ToDoRepository;
use App\Repository\UserActivityHistoryRepository;
use App\Repository\UserActivityNameRepository;
use App\Repository\UsersRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ToDoModel
 * @package App\Model
 * @property ToDoRepository $repository
 */
class ToDoModel extends BaseModel implements ModelInterface
{

    /**
     * @var UsersRepository
     */
    private $userRepository;

    /**
     *
     */
    private $activityHistoryRepository;

    /**
     * @var UserActivityNameRepository
     */
    private $activityNameRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * ToDoModel constructor.
     * @param ToDoRepository $repository
     * @param UsersRepository $usersRepository
     * @param UserActivityHistoryRepository $activityHistoryRepository
     * @param UserActivityNameRepository $activityNameRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        ToDoRepository $repository,
        UsersRepository $usersRepository,
        UserActivityHistoryRepository $activityHistoryRepository,
        UserActivityNameRepository $activityNameRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        parent::__construct($repository);
        $this->userRepository = $usersRepository;
        $this->activityHistoryRepository = $activityHistoryRepository;
        $this->activityNameRepository = $activityNameRepository;
        $this->dispatcher = $eventDispatcher;

    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Request $request): array
    {
        /** @var Users $user */
        $user = $this->userRepository->getEntityObject((int) $request->request->get('userId'));
        /** @var Todo $remind */
        $remind = $this->repository->getEntityObject();
        $remind->setNameReminder($request->request->get('nameReminder'));
        $remind->setTextReminder($request->request->get('textReminder'));
        $remind->setUser($user);
        $this->repository->save($remind);


        $this->dispatcher->dispatch(new CustomEvent($remind), CustomEvent::NAME);

        $response = [];
        return $response;
    }

    /**
     * @param Request $request
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function edit(Request $request, $id): void
    {
        $this->repository->getZebumbaResult();
        $remind = $this->getEntityObject($id);

        if (null === $remind) {
            throw new \RuntimeException(__METHOD__ . ' Item not found');
        }

        $remind->setNameReminder($request->request->get('nameReminder'));
        $remind->setTextReminder($request->request->get('textReminder'));
        $this->repository->save($remind);
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function copy($id):void
    {
        $remind = $this->getEntityObject($id);
        $copyRemind = clone $remind;
        $this->repository->save($copyRemind);
    }

    public function testRepo(): void
    {
        $this->repository->getContainsALetter();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function uploadTodo()
    {
        $this->repository->uploadTodo();
    }
}
