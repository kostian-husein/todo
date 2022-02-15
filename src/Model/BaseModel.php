<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 10.01.22
 * Time: 14:01
 */

namespace App\Model;

use App\Event\Subscriber\OnDeleteSubscriber;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RepositoryInterface;


abstract class BaseModel implements ModelInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * BaseModel constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return null|object|Todo
     */
    public function getEntityObject($id): object
    {
        return $this->repository->find($id);
    }

    /**
     * @param Request $request
     * @return object
     */
    public function dateFilter(Request $request): object
    {
        return $this->repository->dateFilter($request);
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function activate(int $id): void
    {
        $this->repository->activate($id);
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function archive(int $id): void
    {
        $this->repository->archive($id);
    }

    /**
     * @param Request $request
     * @return array
     */
    abstract public function create(Request $request): array;

    /**
     * @param int $id
     * @return object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id): object
    {
        $res = $this->repository->delete($id);
        return $res;
    }

    /**
     * @param Request $request
     * @param int $id
     */
    abstract public function edit(Request $request, int $id): void;

    /**
     * @param Request $request
     * @return array
     */
    public function getList(Request $request): array
    {
        return $this->repository->getList($request);
    }

    /**
     * @return array
     */
    public function getAllEntries():array
    {
        return $this->repository->getAllEntries();
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function restore(int $id): void
    {
        $this->repository->restore($id);
    }
}
