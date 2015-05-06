<?php

namespace Yeka\SwaggerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Response;

class SwaggerController extends Controller
{
    public function indexAction()
    {
        return $this->render('YekaSwaggerBundle::index.html.twig');
    }

    public function resourcesAction()
    {
        return new Response($this->getSwagger());
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
        return \Swagger\scan($dirs, []);
    }
}