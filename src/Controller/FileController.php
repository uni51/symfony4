<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    /**
     * @Route("/file/show_controller", name="file/show_controller")
     */
    public function showController(): Response
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__);


        return $this->render('file/show_controller.html.twig', [
            'title' => 'Hello',
            'message' => __DIR__,
            'finder' => $finder,
        ]);
    }
}
