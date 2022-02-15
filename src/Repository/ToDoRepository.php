<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Service\XlsxService;
use DateTimeInterface;

/**
 * Class ToDoRepository
 * @package App\Repository
 */
class ToDoRepository extends BaseRepository
{
    /**
     * @var
     */
    private $xlsxService;

    /**
     * ToDoRepository constructor.
     * @param ManagerRegistry $registry
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ManagerRegistry $registry, EventDispatcherInterface $eventDispatcher, XlsxService $xlsxService)
    {
        $this->xlsxService = $xlsxService;
        parent::__construct($registry, Todo::class, $eventDispatcher);
    }

    /**
     * @return array
     */
    public function getZebumbaResult(): array
    {
        return [];
    }

    public function getContainsALetter(): array
    {
        $date = new \DateTime("- 1 month");

        $qb =$this->_em->createQueryBuilder();

        $qb->select('t')
            ->from($this->_entityName, 't')
            ->where('t.createdAt >= :needDate')
            ->setParameter('needDate', $date->format('Y-m-d'));


        return $qb->getQuery()->getArrayResult();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function uploadTodo()
    {
        $date = new \DateTime;

        $data = $this->xlsxService->uploadTodo();
        /** @var Todo $remind */
        $remind = $this->getEntityObject();

        for ($i = 1; $i < count($data); $i++){
            $remind->setIsActive(intval($data[$i][1]));
            $remind->setNameReminder($data[$i][2]);
            $remind->setTextReminder($data[$i][3]);
            $remind->setCreatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', $data[$i][4]));
            $remind->setDateEnd(\DateTime::createFromFormat('Y-m-d H:i:s', $data[$i][5]));
            $remind->setIsDeleted(intval($data[$i][6]));
        }
        $this->save($remind);
    }
}
