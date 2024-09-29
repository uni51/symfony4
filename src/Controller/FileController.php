<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class FileController extends AbstractController
{
    /**
     * @Route("/file/write_file_accessed_time", name="file/write_file_accessed_time")
     */
    public function displayFileAccessedTime(Request $request)
    {
        $fileSystem = new Filesystem();
        $temp = __DIR__ . '/temp';

        try {
            if (!$fileSystem->exists($temp)) {
                $fileSystem->mkdir($temp);
            }

            $fileSystem->appendToFile($temp . '/temp.txt', "WRITE TEXT!!!   ");
            $fileSystem->appendToFile($temp . '/temp.txt', date("Y-m-d H:i:s"));
            $fileSystem->appendToFile($temp . '/temp.txt', "\n");

        } catch (IOExceptionInterface $e) {
            echo "ERROR! ". $e->getPath();
        }

        return $this->render('file/write_file_accessed_time.html.twig', [
            'title' => 'Hello',
            'message' => 'get file/folder',
        ]);
    }

    /**
     * @Route("/file/display_logs", name="file/display_logs")
     */
    public function displayLogs(Request $request)
    {
        $finder = new Finder();
        $finder->files()->path('var/log')->name('dev.log')->in('../');
        $file = null;
        foreach($finder as $item) {
            $file = $item;
            break;
        }

        return $this->render('file/display_logs.html.twig', [
            'title' => 'Hello',
            'message' => 'get file/folder',
            'file' => $file,
        ]);
    }

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
        // $finder->files()->depth('<=2')->name('*.yaml')->in('../../');
        // $finder->files()->depth('<=0')->notName('*.lock')->in('../');
        // $finder->files()->depth('<=1')->contains('* @')->in('../src/');
        // $finder->files()->depth('<=1')->path('src')->path('templates')->in('../');
        // $finder->files()->depth('<=2')->size('>20480')->in('../'); // ファイルサイズが20KB以上のファイルを検索
        $finder->files()->path('templates')->date('> 2024-09-28')->in('../');

        return $this->render('file/show_directories.html.twig', [
            'title' => 'Hello',
            'message' => 'get file/folder',
            'finder' => $finder,
        ]);
    }
}
