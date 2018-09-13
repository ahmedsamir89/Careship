<?php

namespace App\Controller\Template;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }
}