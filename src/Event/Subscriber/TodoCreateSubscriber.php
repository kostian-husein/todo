<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 28.01.22
 * Time: 16:33
 */

namespace App\Event\Subscriber;

use App\Event\CustomEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class TodoCreateSubscriber implements EventSubscriberInterface
{
    /**
     * @param CustomEvent $event
     */
    public function methodToCall(CustomEvent $event)
    {
        //file_put_contents(__DIR__ . '/TodoCreateSubscriber.txt', 'TodoCreateSubscriber');
    }


    static public function getSubscribedEvents()
    {
        return [
            'nameOfEvent' => 'methodToCall'
        ];
    }
}