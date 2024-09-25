<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TemplateController extends AbstractController
{
    /**
     * @Route("/template/macro", name="template.macro")
     */
    public function macro(Request $request)
    {
        return $this->render('template/call_macro.html.twig', [
            'title' => 'Hello',
        ]);
    }

    /**
     * @Route("/template/for2", name="template.for2")
     */
    public function for2(Request $request)
    {
        $data = [
            array('name'=>'Taro','age'=>37,'mail'=>'taro@yamada'),
            array('name'=>'Hanako','age'=>29,'mail'=>'hanako@flowe'),
            array('name'=>'Sachiko','age'=>43,'mail'=>'sachico@happy'),
            array('name'=>'Jiro','age'=>18,'mail'=>'jiro@change'),
        ];

        return $this->render('template/temp_for2.html.twig', [
            'title' => 'Hello',
            'data' => $data,
        ]);
    }

    /**
     * @Route("/template/for", name="template.for")
     */
    public function for(Request $request)
    {
        return $this->render('template/temp_for.html.twig', [
            'title' => 'Hello',
            'message' => 'これはサンプルのテンプレート画面です。',
        ]);
    }

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
