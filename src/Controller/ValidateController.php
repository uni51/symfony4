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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ValidateController extends AbstractController
{
    /**
     * @Route("/validate/create", name="validate.create")
     */
    public function create(Request $request, ValidatorInterface $validator)
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class,
                array(
                    'required' => true,
                    'constraints' => [
                        new Assert\Length(array(
                            'min' => 3, 'max' => 10,
                            'minMessage' => '３文字以上必要です。',
                            'maxMessage' => '10文字以内にして下さい。'))
                    ]
                )
            )
            ->add('save', SubmitType::class, array('label' => 'Click'))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $msg = 'Hello, ' . $form->get('name')->getData() . '!';
            } else {
                $msg = 'ERROR!';
            }
        } else {
            $msg = 'Send Form';
        }

        return $this->render('validate/create.html.twig', [
            'title' => 'Hello',
            'message' => $msg,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/validate/create", name="validate.create")
//     */
//    public function create(Request $request, ValidatorInterface $validator)
//    {
//        $person = new Person();
//        $form = $this->createForm(PersonType::class, $person);
//        $form->handleRequest($request);
//
//        if ($request->getMethod() == 'POST'){
//            $person = $form->getData();
//
//            $errors = $validator->validate($person);
//
//            if (count($errors) == 0) {
//                $manager = $this->getDoctrine()->getManager();
//                $manager->persist($person);
//                $manager->flush();
//
//                return $this->redirect('/hello');
//            } else {
//                return $this->render('validate/create.html.twig', [
//                    'title' => 'Hello',
//                    'message' => 'ERROR!',
//                    'form' => $form->createView(),
//                ]);
//            }
//
//        } else {
//            return $this->render('validate/create.html.twig', [
//                'title' => 'Hello',
//                'message' => 'Create Entity',
//                'form' => $form->createView(),
//            ]);
//        }
//    }
}
