<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 23.12.21
 * Time: 15:04
 */

namespace App\Model;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * Class UsersModel
 * @package App\Model
 */
class UsersModel extends BaseModel implements ModelInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    /**
     * UsersModel constructor.
     * @param UsersRepository $repository
     * @param ValidatorInterface $validator
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UsersRepository $repository, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher)
    {
        $this->validator = $validator;
        $this->passwordHasher = $passwordHasher;
        parent::__construct($repository);

    }

    /**
     * @param Request $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Request $request): array
    {
        /** @var Users $user */
        $user = $this->repository->getEntityObject();

        $roles[] = $request->get('roles');

        $password = $request->get('password');

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);
        $user->setLogin($request->request->get('login'));
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setEmail($request->request->get('email'));
        $user->setPhone($request->request->get('phone'));
        $user->setRoles($roles);
        $validator = new EmailValidator();
        if ($validator->isValid($request->request->get('email'), new RFCValidation())) {
            $user->setEmail($request->request->get('email'));
        }

        $validateErr = $this->validateUser($user);
        if (!$validateErr) {
            $this->repository->save($user);
        } else {
            $validateErr['fields'] = $user;
        }
        return $validateErr;
    }


    /**
     * @param $user
     * @return array
     */
    public function validateUser($user): array
    {

        $errors = $this->validator->validate($user);
        $dataErrs = array();

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                if (array_key_exists($error->getPropertyPath(), $dataErrs)) {
                    $dataErrs[$error->getPropertyPath()] .= '/' . $error->getMessage();
                } else {
                    $dataErrs[$error->getPropertyPath()] = $error->getMessage();
                }

            }
        }
        return $dataErrs;
    }


    /**
     * @param Request $request
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function edit(Request $request, $id): void
    {
        $user = $this->getEntityObject($id);

        if (null === $user) {
            throw new \RuntimeException(__METHOD__ . ' Item not found');
        }

        $user->setlogin($request->request->get('login'));
        $user->setPassword($request->request->get('password'));
        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setEmail($request->request->get('email'));
        $user->setPhone($request->request->get('phone'));
        $this->repository->save($user);
    }


}
