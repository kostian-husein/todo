<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 28.01.22
 * Time: 16:33
 */

namespace App\Event\Subscriber;

use App\Event\CustomEvent;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class Todo2CreateSubscriber implements EventSubscriberInterface
{
    /**
     * @param CustomEvent $event
     */
    public function methodToCall(CustomEvent $event)
    {
        //file_put_contents(__DIR__ . '/Todo2CreateSubscriber.txt', 'Todo2CreateSubscriber');
    }


    static public function getSubscribedEvents()
    {
        return [
            'nameOfEvent' => 'methodToCall'
        ];
    }
}