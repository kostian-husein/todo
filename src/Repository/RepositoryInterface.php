<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 10.01.22
 * Time: 14:04
 */

namespace App\Repository;

use Symfony\Component\HttpFoundation\Request;

interface RepositoryInterface
{
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager();

    /**
     * @param null $id
     * @return null|object
     */
    public function getEntityObject($id = null);

    /**
     * @param Request $request
     * @return array
     */
    public function getList(Request $request): array;

    /**
     * @return array
     */
    public function getAllEntries(): array ;

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function copy($id): void;

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function archive($id): void;

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @return object|null
     */
    public function delete($id): object ;

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function activate($id): void;

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function restore($id): void;

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     *
     * @return object|null The object.
     * @psalm-return T|null
     */
    public function find($id);

    /**
     * Finds all objects in the repository.
     *
     * @return array<int, object> The objects.
     * @psalm-return T[]
     */
    public function findAll();

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     *
     * @param array<string, mixed> $criteria
     * @param string[]|null        $orderBy
     * @param int|null             $limit
     * @param int|null             $offset
     * @psalm-param array<string, 'asc'|'desc'|'ASC'|'DESC'> $orderBy
     *
     * @return object[] The objects.
     * @psalm-return T[]
     *
     * @throws \UnexpectedValueException
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null);

    /**
     * Finds a single object by a set of criteria.
     *
     * @param array<string, mixed> $criteria The criteria.
     *
     * @return object|null The object.
     * @psalm-return T|null
     */
    public function findOneBy(array $criteria);

    /**
     * @param object $obj
     * @return mixed
     */
    public function save (object $obj);
}
