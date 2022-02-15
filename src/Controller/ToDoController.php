<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 22.12.21
 * Time: 17:13
 */

namespace App\Controller;

use App\Model\ToDoModel;
use App\Service\XlsxService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


/**
 * Class TodoController
 * @package App\Controller
 * @Route("/todo", name="todo")
 * @property ToDoModel $model
 */
class ToDoController extends AbstractController
{
    /**
     * @var ToDoModel
     */
    private $model;

    /**
     * @var XlsxService
     */
    private $service;

    /**
     * ToDoController constructor.
     * @param ToDoModel $model
     * @param XlsxService $service
     */
    public function __construct(ToDoModel $model, XlsxService $service)
    {
        $this->service = $service;
        $this->model = $model;
    }

    /**
     * @Route("/clone/{id}", name="clone")
     * @param $id
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function copy($id): Response
    {
        $this->model->copy($id);
        return $this->redirectToRoute('list', ['entityName' => 'todo']);
    }

    /**
     * @Route("/download", name="download")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function downloadTodo()
    {
        $data = $this->model->getAllEntries();
        $save = $this->service->downloadTodo($data);

        if (file_exists($save)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($save));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($save));
            // читаем файл и отправляем его пользователю
            readfile($save);
            return $this->redirectToRoute('list', ['entityName' => 'todo']);

        }

    }


    /**
     * @Route("/upload", name="upload")
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function uploadTodo()
    {
        $this->model->uploadTodo();
        return $this->redirectToRoute('list', ['entityName' => 'todo']);
    }


}
