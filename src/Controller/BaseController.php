<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 30.12.21
 * Time: 18:06
 */

namespace App\Controller;

use App\Entity\Users;
use App\Model\ModelInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BaseController
 * @package App\Controller
 */
class BaseController extends AbstractController
{
    /**
     * @var ModelInterface
     */
    public $model;

    /**
     * @var string
     */
    protected $listTemplate;

    protected const LIST_TEMPLATE = '';
    protected const CREATE_TEMPLATE = '';
    protected const EDIT_TEMPLATE = '';
    protected const REDIRECT_ROUTE = '';
    protected const ERRORS_TEMPLATE = '';

    /**
     * AbstractController constructor.
     * @param ModelInterface $model
     */
    public function __construct(ModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @Route("/exp/{entityName}", name="exp")
     * @param Request $request
     * @return Response
     *
     */
    public function exp(Request $request, string $entityName): Response
    {
        $isActive = $request->query->get('isActive', 1);
        $isDeleted = $request->query->get('isDeleted', 0);

        if (!$isActive && !$isDeleted) {
            $listType = 'archive';
        } elseif ($isDeleted) {
            $listType = 'deleted';
        } else {
            $listType = 'active';
        }

        return $this->render("{$entityName}/list.html.twig", ['items' => $this->model->getList($request), 'listType' => $listType]);
    }

    /**
     * @Route("{entityName}/list/", name="list")
     * @param Request $request
     * @param string $entityName
     * @return Response
     */
    public function list(Request $request, string $entityName): Response
    {
        $isActive = $request->query->get('isActive', 1);
        $isDeleted = $request->query->get('isDeleted', 0);

        if (!$isActive && !$isDeleted) {
            $listType = 'archive';
        } elseif ($isDeleted) {
            $listType = 'deleted';
        } else {
            $listType = 'active';
        }
        $result = $this->model->getList($request);

        return $this->render("{$entityName}/list.html.twig", ['items' => $result['queryResult'],
                                                                    'listType' => $listType,
                                                                    'sumPage' => $result['sumPage'],
                                                                    'sortDay' => $result['sortDay']
        ]);
    }

    /**
     * @Route("{entityName}/date-filter/", name="date_filter")
     * @param Request $request
     * @param string $entityName
     * @return Response
     */
    public function dateFilter(Request $request, string $entityName)
    {
        $isActive = $request->query->get('isActive', 1);
        $isDeleted = $request->query->get('isDeleted', 0);

        if (!$isActive && !$isDeleted) {
            $listType = 'archive';
        } elseif ($isDeleted) {
            $listType = 'deleted';
        } else {
            $listType = 'active';
        }
        return $this->render("{$entityName}/list.html.twig", ['items' => $this->model->dateFilter($request), 'listType' => $listType]);
    }

    /**
     * @Route("/{entityName}/create", name="create")
     * @param Request $request
     * @param string $entityName
     * @return Response
     */
    public function create(Request $request, string $entityName): Response
    {
        if ($request->isMethod('POST')) {
            $create = $this->model->create($request);
            if($create){
                return $this->render("{$entityName}/errors.html.twig", [
                    'errors' => $create
                ]);
            }
            return $this->redirectToRoute('list', ['entityName' => $entityName]);
        } else {
            return $this->render("{$entityName}/create.html.twig");
        }
    }

    /**
     * @Route("/{entityName}/edit/{id}", name="edit")
     * @param Request $request
     * @param string $entityName
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, int $id, string $entityName): Response
    {

        if ($request->isMethod('POST')) {
            $this->model->edit($request, $id);
            return $this->redirectToRoute('list', ['entityName' => $entityName]);
        } else {
            return $this->render("{$entityName}/edit.html.twig", ['item' => $this->model->getEntityObject($id)]);
        }
    }

    /**
     * @Route ("{entityName}/archive/{id}", name="archive")
     * @param int $id
     * @param string $entityName
     * @return Response
     */
    public function archive(int $id, string $entityName): Response
    {
        $this->model->archive($id);
        return $this->redirectToRoute('list', ['entityName' => $entityName]);
    }

    /**
     * @Route("{entityName}/delete/{id}", name="delete")
     * @param int $id
     * @param string $entityName
     * @return Response
     */
    public function delete(int $id, string $entityName): Response
    {
        $res = $this->model->delete($id);
        //var_dump($res);exit;
        return $this->redirectToRoute('list', ['entityName' => $entityName]);
    }

    /**
     * @Route("{entityName}/activate/{id}", name="activate")
     * @param int $id
     * @param string $entityName
     * @return Response
     */
    public function activate(int $id, string $entityName): Response
    {
        $this->model->activate($id);
        return $this->redirectToRoute('list', ['entityName' => $entityName]);
    }

    /**
     * @Route("{entityName}/restore/{id}", name="restore")
     * @param int $id
     * @param string $entityName
     * @return Response
     */
    public function restore(int $id, string $entityName): Response
    {
        $this->model->restore($id);
        return $this->redirectToRoute('list', ['entityName' => $entityName]);
    }


}