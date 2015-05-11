<?php

namespace Yeka\SwaggerBundle\Controller;

use Swagger\Swagger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\JsonResponse;

class SwaggerController extends Controller
{
    public function indexAction()
    {
        return $this->render('YekaSwaggerBundle::index.html.twig');
    }

    public function resourcesAction($resourceName = null)
    {
        $swagger = $this->getSwagger();
        if ($resourceName) {
            try {
                $resources = $swagger->getResource($resourceName);
            } catch (\Exception $e) {
                $resources = $swagger->getResource('/'.$resourceName);
            }
        } else {
            $resources = $swagger->getResourceList();
        }
        return new JsonResponse($resources);
    }

    public function getSwagger()
    {
        /** @var FileLocator $locator */
        $locator = $this->get('file_locator');
        $swaggerBundles = $this->container->getParameter('swagger.bundles');
        $bundles = $this->container->getParameter('kernel.bundles');

        $dirs = [];
        foreach ($swaggerBundles as $bundle) {
            if (isset($bundles[$bundle])) {
                $dirs[] = $locator->locate('@'.$bundle.'/Controller');
            }
        }
        return new Swagger($dirs);
    }
}