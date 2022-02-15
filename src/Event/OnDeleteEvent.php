<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 28.01.22
 * Time: 19:48
 */

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class OnDeleteEvent extends Event
{
    public const NAME = 'onDelete';

    private $deletedEntity;

    /**
     * OnDeleteEvent constructor.
     * @param $deletedEntity
     */
    public function __construct($deletedEntity)
    {
        $this->deletedEntity = $deletedEntity;
    }


    /**
     * @return object
     */
    public function getDeletedEntity()
    {
       return $this->deletedEntity;
    }
}