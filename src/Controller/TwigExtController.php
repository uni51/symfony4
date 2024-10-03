<?php

namespace App\Controller;


use App\Service\MyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TwigExtController extends AbstractController
{
    /**
     * @Route("/twigext", name="twigext.main")
     */
    public function main(Request $request, MyService $service, int $id = 1)
    {
        return $this->render('twigext/main.html.twig', [
            'title' => 'Hello',
            'number' => 1234500,
        ]);
    }

}
