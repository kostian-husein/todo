<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 28.01.22
 * Time: 18:06
 */

namespace App\Event\Listener;

use App\Event\CustomEvent;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ToDoCreateListener
 * @package App\Event\Listener
 */
class ToDoCreateListener
{
    public function onToDoCreate(CustomEvent $event)
    {
//        dump($event);exit;
    }
}