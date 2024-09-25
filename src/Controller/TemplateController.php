<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TemplateController extends AbstractController
{
    /**
     * @Route("/template/if", name="template.if")
     */
    public function if(Request $request)
    {
        return $this->render('template/temp_if.html.twig', [
            'title' => 'Hello',
            'message' => 'これはサンプルのテンプレート画面です。',
        ]);
    }

    /**
     * @Route("/template/with", name="template.with")
     */
    public function with(Request $request)
    {
        return $this->render('template/temp_with.html.twig', [
            'title' => 'Hello',
            'message' => 'これはサンプルのテンプレート画面です。',
        ]);
    }

    /**
     * @Route("/template/set", name="template.set")
     */
    public function set(Request $request)
    {
        return $this->render('template/temp_set.html.twig', [
            'title' => 'Hello',
            'message' => 'これはサンプルのテンプレート画面です。',
        ]);
    }

    /**
     * @Route("/template", name="template")
     */
    public function index(Request $request)
    {
        return $this->render('template/index.html.twig', [
            'title' => 'Hello',
            'message' => 'これはサンプルのテンプレート画面です。',
        ]);
    }
}
