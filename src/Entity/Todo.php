<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Todo
 *
 * @ORM\Table(name="todo", indexes={@ORM\Index(name="is_delted", columns={"is_deleted"})})
 * @ORM\Entity(repositoryClass="App\Repository\ToDoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Todo
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
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="todos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="name_reminder", type="string", length=50, nullable=false)
     */
    private $nameReminder;

    /**
     * @var string
     *
     * @ORM\Column(name="text_reminder", type="string", length=255, nullable=false)
     */
    private $textReminder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     *
     */
    private $dateEnd;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted = '0';


    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = $this->createdAt ?? new \DateTime("now");
        $this->dateEnd = $this->dateEnd ?? new \DateTime("now");
    }



    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return Todo
     */
    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getNameReminder(): ?string
    {
        return $this->nameReminder;
    }

    /**
     * @param string $nameReminder
     * @return Todo
     */
    public function setNameReminder(string $nameReminder): self
    {
        $this->nameReminder = $nameReminder;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTextReminder(): ?string
    {
        return $this->textReminder;
    }

    /**
     * @param string $textReminder
     * @return Todo
     */
    public function setTextReminder(string $textReminder): self
    {
        $this->textReminder = $textReminder;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Todo
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    /**
     * @param \DateTimeInterface $dateEnd
     * @return Todo
     */
    public function setDateEnd(\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     * @return Todo
     */
    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

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
     * @return Todo
     */
    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }


}
