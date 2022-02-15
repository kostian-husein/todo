<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserActivityName
 *
 * @ORM\Table(name="userActivityName")
 * @ORM\Entity(repositoryClass="App\Repository\UserActivityNameRepository")
 */
class UserActivityName
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
     * @var string
     *
     * @ORM\Column(name="activity_name", type="string", length=250, nullable=false)
     */
    private $activityName;

    /**
     * @var Collection|UserActivityHistory[]
     * @ORM\OneToMany(targetEntity="UserActivityHistory", mappedBy="activity")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $actives;

    /**
     * UserActivityName constructor.
     */
    public function __construct()
    {
        $this->actives = new ArrayCollection();
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getActivityName(): ?string
    {
        return $this->activityName;
    }

    /**
     * @param string $activityName
     * @return userActivityName
     */
    public function setActivityName(string $activityName): self
    {
        $this->activityName = $activityName;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getActivity(): Collection
    {
        return $this->actives;
    }

    /**
     * @param UserActivityHistory $activityHistory
     * @return UserActivityName
     */
    public function addActivity(UserActivityHistory $activityHistory): self
    {
        if (!$this->actives->contains($activityHistory)) {
            $activityHistory->setActivity($this);
            $this->actives->add($activityHistory);
        }

        return $this;
    }

    /**
     * @param UserActivityHistory $activityHistory
     * @return UserActivityName
     */
    public function removeActivity(UserActivityHistory $activityHistory): self
    {
        if ($this->actives->contains($activityHistory)) {
            $this->actives->removeElement($activityHistory);

            if ($activityHistory->getActivity() === $this) {
                $activityHistory->setActivity(null);
            }
        }

        return $this;
    }

}
