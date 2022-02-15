<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 28.01.22
 * Time: 16:33
 */

namespace App\Event\Subscriber;

use App\Entity\Todo;
use App\Event\OnDeleteEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class OnDeleteSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param OnDeleteEvent $event
     * @return object
     */
    public function onDeleteAction(OnDeleteEvent $event): object
    {

        return $event->getDeletedEntity();
        //do something
    }


    /**
     * @return array
     */
    static public function getSubscribedEvents()
    {

        return [
            'onDelete' => 'onDeleteAction'
        ];
    }

}