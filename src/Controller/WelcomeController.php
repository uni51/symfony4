<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/form", name="welcome.form")
     */
    public function form(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $inputName = $request->request->get('name');
            $msg = 'こんにちは、' . $inputName . 'さん！';
        } else {
            $msg = 'お名前は？';
        }

        return $this->render('welcome/form.html.twig', [
            'title' => 'Hello',
            'message' =>  $msg,
        ]);
    }

//    /**
//     * @Route("/post_recieve", name="welcome.post_recieve")
//     */
//    public function postrecieve(Request $request)
//    {
//        $inputName = $request->request->get('name');
//        $msg = 'こんにちは、' . $inputName . 'さん！';
//
//        return $this->render('welcome/form.html.twig', [
//            'title' => 'Hello',
//            'message' => $msg,
//        ]);
//    }


    /**
     * @Route("/hello/{msg}", name="welcome")
     */
    public function index($msg='Hello!')
    {
        return $this->render('welcome/index.html.twig', [
            'controller' => 'WelcomeController',
            'action' => 'index',
            'prev_action' => '(none)',
            'message' => $msg,
        ]);
    }

    /**
     * @Route("/other/{action}/{msg}", name="welcome.other")
     */
    public function other($action, $msg)
    {
        return $this->render('welcome/index.html.twig', [
            'controller' => 'WelcomeController',
            'action' => 'other',
            'prev_action' => $action,
            'message' => $msg,
        ]);
    }
}
