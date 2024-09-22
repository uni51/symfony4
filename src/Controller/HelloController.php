<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index(Request $request)
    {
        $name = $request->get('name');
        $pass = $request->get('pass');
        $result = '<html><body><ol>';
        $result .= '<h1>Parameter</h1>';
        $result .= '<p>name: ' . $name . '</p>';
        $result .= '<p>pass: ' . $pass . '</p>';
        $result .= '</body></html>';
        return new Response($result);
    }

    /**
     * @Route("/jsonmethod", name="jsonmethod")
     */
    public function jsonmethod(Request $request)
    {
        $data = array(
            'name'=>array('first'=>'Taro','second'=>'Yamada'),
            'age'=>36,
            'mail'=>'taro@yamada.kun'
        );
        return new JsonResponse($data);
    }

    /**
     * @Route("/other/{domain}", name="other")
     */
    public function other(Request $request, $domain='')
    {
        if ($domain == ''){
            return $this->redirect('/hello');
        } else {
            return new RedirectResponse("http://{$domain}.com");
        }
    }

    /**
     * @Route("/hello/params/{name}/{pass}", name="params")
     */
    public function params($name=('noname'), $pass=('no password')) // ()の中はデフォルト値
    {
        $result = '<html><body><ol>';
        $result .= '<h1>Parameter</h1>';
        $result .= '<p>name: ' . $name . '</p>';
        $result .= '<p>pass: ' . $pass . '</p>';
        $result .= '</body></html>';
        return new Response($result);
    }

//    /**
//     * @Route("/hello", name="app_hello")
//     */
//    public function index(): Response
//    {
//        return $this->render('hello/index.html.twig', [
//            'controller_name' => 'HelloController',
//        ]);
//    }

//    /**
//     * @Route("/hello", name="hello")
//     */
//    public function index()
//    {
//        $result = '<html><body>';
//        $result .= '<h1>Subscribed Services</h1>';
//        $result .= '<ol>';
//        $arr = $this->getSubscribedServices();
//        foreach ($arr as $key => $value) {
//            $result .= '<li>' . $key . '</li>';
//        }
//        $result.= '</ol>';
//        $result .= '</body></html>';
//        return new Response($result);
//    }

}
