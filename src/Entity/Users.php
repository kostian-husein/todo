<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Users
 *
 * @ORM\Table(name="usersTodo")
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Users implements PasswordAuthenticatedUserInterface, UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=25, nullable=false)
     *
     * @Assert\NotBlank(message = "Поле логин не заполнено")
     *
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Логин быть как минимум 2 символов"
     * )
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=256, nullable=false)
     *
     * @Assert\NotBlank(message = "Поле пароль не заполнено");
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     *
     * @Assert\NotBlank(message = "Поле имя не заполнено")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     *
     * @Assert\NotBlank(message = "Поле фамилия не заполнено")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80, nullable=false)
     *
     * @Assert\NotBlank(message = "Поле email не заполнено")
     *
     * @Assert\Email(mode = "strict", message = "не верный формат email")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=false)
     *
     * @Assert\NotBlank(message = "Поле телефон не заполнено")
     *
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false, options={"default"="1"})
     */
    private $isActive = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted = '0';

    /**
     * @ORM\Column(type="json")
     */
    private $roles;

    /**
     * @var Collection|Todo[]
     * @ORM\OneToMany(targetEntity="Todo", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $todos;

    /**
     * @var Collection|UserActivityHistory[]
     * @ORM\OneToMany(targetEntity="UserActivityHistory", mappedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $activityUser;

    public function __construct()
    {
        $this->todos = new ArrayCollection();
        $this->activityUser = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = $this->createdAt ?? new \DateTime("now");
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        if(!$roles){
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    /**
     * @return Collection
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    /**
     * @param Todo $todo
     * @return Users
     */
    public function addTodo(Todo $todo): self
    {
        if (!$this->todos->contains($todo)) {
            $todo->setUser($this);
            $this->todos->add($todo);
        }

        return $this;
    }

    /**
     * @param Todo $todo
     * @return Users
     */
    public function removeTodo(Todo $todo): self
    {
        if ($this->todos->contains($todo)) {
            $this->todos->removeElement($todo);

            if ($todo->getUser() === $this) {
                $todo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getActivityUser() :Collection
    {
        return $this->activityUser;
    }

    /**
     * @param UserActivityHistory $activityHistory
     * @return Users
     */
    public function addActivityUser(UserActivityHistory $activityHistory): self
    {
        if (!$this->activityUser->contains($activityHistory)) {
            $activityHistory->setUser($this);
            $this->activityUser->add($activityHistory);
        }

        return $this;
    }

    /**
     * @param UserActivityHistory $activityHistory
     * @return Users
     */
    public function removeActivityUser(UserActivityHistory $activityHistory): self
    {
        if ($this->activityUser->contains($activityHistory)) {
            $this->activityUser->removeElement($activityHistory);

            if ($activityHistory->getUser() === $this) {
                $activityHistory->setUser(null);
            }
        }

        return $this;
    }
}
