<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 7.01.22
 * Time: 20:14
 */

namespace App\Repository;
use App\Event\OnDeleteEvent;
use App\Event\Subscriber\OnDeleteSubscriber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * Class BaseRepository
 * @package App\Repository
 */
abstract class BaseRepository extends ServiceEntityRepository implements RepositoryInterface
{

    /**
     * @var
     */
    private $dispatcher;

    /**
     * BaseRepository constructor.
     * @param $registry
     * @param $entityClass
     * @param $eventDispatcher
     */
    public function __construct($registry, $entityClass, EventDispatcherInterface $eventDispatcher)
    {
        $this->dispatcher = $eventDispatcher;
        parent::__construct($registry, $entityClass);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return parent::getEntityManager();
    }

    /**
     * @param object $obj
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(object $obj)
    {
        $this->_em->persist($obj);
        $this->_em->flush();
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return parent::getEntityName();
    }

    /**
     * @param null $id
     * @return null|object
     */
    public function getEntityObject($id = null)
    {
        if (null !== $id) {
            return $this->_em->getRepository($this->_entityName)->find($id);
        } else {
            return new $this->_entityName();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getList(Request $request): array
    {
        $isActive = $request->query->get('isActive', 1);
        $isDeleted = $request->query->get('isDeleted', 0);
        $qb1 = $this->_em->createQueryBuilder();
        $qb1->select('u.id','u.isActive','u.isDeleted')
            ->from($this->_entityName, 'u')
            ->where('u.isActive = :isActive')
            ->andWhere('u.isDeleted = :isDeleted')
            ->setParameters(['isActive' => $isActive, 'isDeleted' => $isDeleted])
            ->expr()->count('');
        $sortDays = $request->query->get('sortDays');

        if ($sortDays) {
            $date = new \DateTime("- $sortDays day");
            $qb1
                ->andWhere('u.createdAt >= :sortDays')
                ->setParameter('sortDays', $date->format('Y-m-d'));
        }

        $res =  $qb1->getQuery()->getResult();
        $countEntry = count($res);


        $numPage = $request->query->get('numPage', 1);
        $rowCount = 10;
        $sumPage = ceil($countEntry/$rowCount);
        $firstResult = $numPage * $rowCount - $rowCount;
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
            ->from($this->_entityName, 't')
            ->where('t.isActive = :isActive')
            ->andWhere('t.isDeleted = :isDeleted')
            ->setParameters(['isActive' => $isActive, 'isDeleted' => $isDeleted])
            ->setFirstResult($firstResult)
            ->setMaxResults($rowCount)
            ->orderBy('t.createdAt', 'DESC');

        $sortDays = $request->query->get('sortDays');
        if ($sortDays) {
            $date = new \DateTime("- $sortDays day");
            $qb
                ->andWhere('t.createdAt >= :sortDays')
                ->setParameter('sortDays', $date->format('Y-m-d'));
        }

        $returnResult = ['queryResult' =>$qb->getQuery()->getResult(), 'sumPage' => $sumPage, 'sortDay' => $sortDays];

        return $returnResult;
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function copy($id): void
    {
        $remind = $this->getEntityObject($id);
        if (null === $remind) {
            throw new \RuntimeException(__METHOD__ . 'Item not found');
        }

        $clone = clone $remind;

        $this->_em->persist($clone);
        $this->_em->flush();
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function archive($id): void
    {
        $remind = $this->getEntityObject($id);
        if (null === $remind) {
            throw new \RuntimeException(__METHOD__ . ' Item not found');
        }

        $remind->setIsActive('0');
        $this->_em->persist($remind);
        $this->_em->flush();
    }

    /**
     * @param $id
     * @return object
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id): object
    {
        $remind = $this->getEntityObject($id);
        if (null === $remind) {
            throw new \RuntimeException(__METHOD__ . ' Item not found');
        }

        $remind->setIsDeleted('1');
        $this->_em->persist($remind);
        $this->_em->flush();


        $subscriber = new OnDeleteSubscriber($this->_em);
        $this->dispatcher->addSubscriber($subscriber);
        $subscriber = $this->dispatcher->dispatch(new OnDeleteEvent($remind), OnDeleteEvent::NAME);
        return $subscriber;

    }

    /**
     * @return mixed
     */
    public function deleteAll()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->update($this->_entityName, 't')
            ->set('t.isActive', '0')
            ->set('t.isDeleted', '1');
        if($qb->getQuery()->getResult()){
            $result = 0;
        }else{
            $result= 1;
        };
        return $result;
    }

    /**
     * @return array
     */
    public function getAllEntries(): array
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('t')
            ->from($this->_entityName, 't');
        $res = $qb->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $res;

    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function activate($id): void
    {
        $remind = $this->getEntityObject($id);

        if(null === $remind) {
            throw new \RuntimeException(__METHOD__ . 'Item not found');
        }

        $remind->setIsActive('1');
        $this->_em->persist($remind);
        $this->_em->flush();
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function restore($id): void
    {
        $remind = $this->getEntityObject($id);

        if(null === $remind) {
            throw new \RuntimeException(__METHOD__ . 'Item not found');
        }

        $remind->setIsDeleted('0');
        $this->_em->persist($remind);
        $this->_em->flush();
    }


}
