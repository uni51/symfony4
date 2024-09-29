<?php

namespace App\Controller;

use App\Form\FlashType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class FlashController extends AbstractController
{
    /**
     * @Route("/flash/index", name="flash/index")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(FlashType::class, null);
        $form->handleRequest($request);


        if ($request->getMethod() == 'POST') {
            $this->addFlash('info.mail', 'mail:' . $form->getData()['mail']);
            $msg = 'Hello, ' . $form->getData()['name'] . '!!';
        } else {
            $msg = 'Send Form';
        }

        return $this->render('flash/index.html.twig', [
            'title' => 'Hello',
            'message' => $msg,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/flash/object", name="flash/object")
     */
    public function flashObject(Request $request)
    {
        $formobj = new FlashForm();
        $form = $this->createForm(FlashType::class, $formobj);
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST') {
            $formobj = $form->getData();
            $this->addFlash('info.mail', $formobj);
            $msg = 'Hello, ' . $formobj->getName() . '!!';
        } else {
            $msg = 'Send Form';
        }

        return $this->render('flash/index.html.twig', [
            'title' => 'Hello',
            'message' => $msg,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/flash/flashbag", name="flash/flashbag")
     */
    public function flashBag(Request $request, SessionInterface $session)
    {
        $formobj = new FlashForm();
        $form = $this->createForm(FlashType::class, $formobj);
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST'){
            $formobj = $form->getData();
            $session->getFlashBag()->add('info.mail', $formobj);
            $msg = 'Hello, ' . $formobj->getName() . '!!';
        } else {
            $msg = 'Send Form';
        }

        return $this->render('flash/flashbag.html.twig', [
            'title' => 'Hello',
            'message' => $msg,
            'bag' => $session->getFlashBag(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/flash/clear", name="falsh/clear")
     */
    public function clear(Request $request, SessionInterface $session)
    {
        $session->getFlashBag()->clear();
        return $this->redirect('/flash/flashbag');
    }

}

class FlashForm
{
    private $name;
    private $mail;


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }


    public function __toString()
    {
        return '*** ' . $this->name . ' [' . $this->mail . '] ***';
    }
}
