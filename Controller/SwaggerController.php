<?php

namespace Yeka\SwaggerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SwaggerController extends Controller
{
    public function indexAction()
    {
        return $this->render('YekaSwaggerBundle::index.html.twig');
    }
}