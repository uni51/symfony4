<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Person;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DbController extends AbstractController
{
    /**
     * @Route("/db/find/{id}", name="find")
     */
    public function findById(Request $request, Person $person)
    {
        return $this->render('db/auto_fetch_find.html.twig', [
            'title' => 'Hello',
            'data' => $person,
        ]);
    }

    /**
     * @Route("/db/find", name="db.find")
     */
    public function find(Request $request)
    {
        $formobj = new FindForm();
        $form = $this->createFormBuilder($formobj)
            ->add('find', TextType::class, array('label' => 'Find By ID'))
            ->add('save', SubmitType::class, array('label' => 'Click'))
            ->getForm();

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $findstr = $form->getData()->getFind();
            $repository = $this->getDoctrine()
                ->getRepository(Person::class);

            $result = $repository->find($findstr);
        } else {
            $result = null;
        }

        return $this->render('db/find.html.twig', [
            'title' => 'Hello',
            'form' => $form->createView(),
            'data' => $result,
        ]);
    }

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

class FindForm
{
    private $find;


    public function getFind()
    {
        return $this->find;
    }
    public function setFind($find)
    {
        $this->find = $find;
    }
}
