<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserActivityHistory
 *
 * @ORM\Table(name="userActivityHistory")
 * @ORM\Entity(repositoryClass="App\Repository\UserActivityHistoryRepository")
 */
class UserActivityHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Users|null
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="activityUser")
     * @ORM\JoinColumn(name="user", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @var UserActivityName|null
     *
     * @ORM\ManyToOne(targetEntity="UserActivityName", inversedBy="actives")
     * @ORM\JoinColumn(name="activity", referencedColumnName="id")
     */
    private $activity;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_name", type="string", length=250, nullable=false)
     */
    private $entityName;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return UserActivityName|null
     */
    public function getActivity(): ?UserActivityName
    {
        return $this->activity;
    }

    /**
     * @param UserActivityName|null $activityName
     * @return UserActivityHistory
     */
    public function setActivity(?UserActivityName $activityName): self
    {
        $this->activity = $activityName;

        return $this;
    }

    /**
     * @return Users|null
     */
    public function getUser(): ?Users
    {
        return $this->user;
    }

    /**
     * @param Users|null $user
     * @return userActivityHistory
     */
    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEntityName(): ?string
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     * @return UserActivityHistory
     */
    public function setEntityName(string $entityName): self
    {
        $this->entityName = $entityName;

        return $this;
    }

}
