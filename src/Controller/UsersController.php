<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 22.12.21
 * Time: 17:13
 */

namespace App\Controller;

use App\Model\UsersModel;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\BaseController;

/**
 * Class UsersController
 * @package App\Controller
 * @Route("/users", name="users")
 * @property UsersModel $model
 */
class UsersController extends BaseController
{
    protected const LIST_TEMPLATE = 'users/list.html.twig';
    protected const CREATE_TEMPLATE = 'users/create.html.twig';
    protected const EDIT_TEMPLATE = 'users/edit.html.twig';
    protected const REDIRECT_ROUTE = 'users_list';
    protected const ERRORS_TEMPLATE = 'users/errors.html.twig';

    /**
     * UsersController constructor.
     * @param UsersModel $model
     */
    public function __construct(UsersModel $model)
    {
        parent::__construct($model);
    }
}
