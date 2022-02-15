<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 19.01.22
 * Time: 16:50
 */

namespace App\Controller\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\BaseController;
use App\Model\ModelInterface;

/**
 * Class BaseControllerFactory
 * @package App\Controller\Factory
 */
class BaseControllerFactory
{
    /**
     * @param ContainerInterface $container
     * @return BaseController
     */
    public function create (ContainerInterface $container)
    {
        $requestUrl = Request::createFromGlobals()->getPathInfo();
        $routeParams = $container->get('router')->match($requestUrl);
        $entity = $routeParams['entityName'] ?? null;
        $modelsList = scandir('/home/sf/htdocs/src/Model');
        foreach ($modelsList as $model)
        {
           if(mb_strtolower($model) == $entity.'model.php')
           {
               $modelExplode = explode('.', $model);
               $modelName = $modelExplode[0];
           }
        }
        $pathModel = 'App\Model\\'.$modelName;

        if (class_exists($pathModel)) {
            /** @var ModelInterface $newModel */
            $newModel = $container->get($pathModel);
        }

        return new BaseController($newModel);
    }

}
