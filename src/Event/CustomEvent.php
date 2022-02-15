<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 28.01.22
 * Time: 18:14
 */

namespace App\Event;

use App\Entity\Todo;
use Symfony\Contracts\EventDispatcher\Event;

class CustomEvent extends Event
{
    public const NAME = 'nameOfEvent';

    /**
     * @var Todo
     */
    private $createdEntity;

    /**
     * CustomEvent constructor.
     * @param Todo $createdEntity
     */
    public function __construct(Todo $createdEntity)
    {
        $this->createdEntity = $createdEntity;
    }

    /**
     * @return Todo
     */
    public function getCreatedEntity(): Todo
    {
        return $this->createdEntity;
    }
}