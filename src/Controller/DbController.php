<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Person;

class DbController extends AbstractController
{
    /**
     * @Route("/db/index", name="db.index")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository(Person::class);
        $data = $repository->findall();

        return $this->render('db/index.html.twig', [
            'title' => 'Hello',
            'data' => $data,
        ]);
    }
}
