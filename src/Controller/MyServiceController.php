<?php

namespace App\Controller;

use App\Service\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyServiceController extends AbstractController
{
    /**
     * @Route("/myservice/{id}", name="myservice")
     */
    public function index(Request $request, MyService $service, int $id = 1)
    {
        $person = $service->getPerson($id);
        $msg = $person == null ? 'no person.' : $person;
        return $this->render('my_service/index.html.twig', [
            'title' => 'Hello',
            'message' => $msg,
        ]);
    }

//    /**
//     * @Route("/myservice", name="myservice")
//     */
//    public function index(Request $request, MyService $service): Response
//    {
//        return $this->render('my_service/index.html.twig', [
//            'title' => 'Hello',
//            'message' => $service->getMessage(),
//        ]);
//    }
}
