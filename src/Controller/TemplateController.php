<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TemplateController extends AbstractController
{
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
