<?php
namespace App\Controller;


use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Person;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MasterDbController extends AbstractController
{
    /**
     * @Route("/masterdb/find", name="masterdb.find")
     */
    public function find(Request $request)
    {
        $formobj = new FindForm();
        $form = $this->createFormBuilder($formobj)
            ->add('find', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Click'))
            ->getForm();

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $findstr = $form->getData()->getFind();

            $repository = $this->getDoctrine()
                ->getRepository(Person::class);

            // $result = $repository->findBy(['name' => $findstr]);
            // $result = $repository->findByAge($findstr);
            $result = $repository->findByName($findstr);
        } else {
            $result = null;
        }

        return $this->render('masterdb/find.html.twig', [
            'title' => 'Hello',
            'form' => $form->createView(),
            'data' => $result,
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
