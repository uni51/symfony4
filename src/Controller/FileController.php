<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    /**
     * @Route("/file/show_controllers", name="file/show_controllers")
     */
    public function showControllers(): Response
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__);


        return $this->render('file/show_controllers.html.twig', [
            'title' => 'Hello',
            'message' => __DIR__,
            'finder' => $finder,
        ]);
    }

    /**
     * @Route("/file/show_directories", name="file/show_directories")
     */
    public function showDirectories(): Response
    {
        $finder = new Finder();
        // $finder->directories()->in('../src/');
        // $finder->files()->in(['../src/Controller', '../src/Entity/', '../src/Repository/']);
        // $finder->files()->depth('<=1')->in('../templates/');
        $finder->files()->depth('<=2')->name('*.yaml')->in('../../');

        return $this->render('file/show_directories.html.twig', [
            'title' => 'Hello',
            'message' => 'get file/folder',
            'finder' => $finder,
        ]);
    }
}
