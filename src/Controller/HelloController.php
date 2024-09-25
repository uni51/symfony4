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

class HelloController extends AbstractController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index()
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

//    /**
//     * @Route("/hello", name="hello")
//     */
//    public function index(Request $request)
//    {
//        $name = $request->get('name');
//        $pass = $request->get('pass');
//        $result = '<html><body><ol>';
//        $result .= '<h1>Parameter</h1>';
//        $result .= '<p>name: ' . $name . '</p>';
//        $result .= '<p>pass: ' . $pass . '</p>';
//        $result .= '</body></html>';
//        return new Response($result);
//    }

    /**
     * @Route("/loginfo", name="loginfo")
     */
    public function loginfo(Request $request, LoggerInterface $logger)
    {
        $data = array(
            'name'=>array('first'=>'Taro','second'=>'Yamada'),
            'age'=>36,
            'mail'=>'taro@yamada.kun'
        );
        $logger->info(serialize($data));
        return new JsonResponse($data);
    }

    /**
     * @Route("/http_ok", name="http_ok")
     */
    public function httpok(Request $request)
    {
        $content = <<< EOM
        <html><head><title>Hello</title></head>
        <body><h1>Hello!</h1>
        <p>this is Symfony sample page.</p>
        </body></html>
EOM;
        $response = new Response(
            $content,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
        );
        return $response;
    }

    /**
     * @Route("/notfound", name="notfound")
     */
    public function notfound(Request $request)
    {
        $content = <<< EOM
        <html><head><title>ERROR</title></head>
        <body><h1>ERROR! 404</h1>
        </body></html>
EOM;
        $response = new Response(
            $content,
            Response::HTTP_NOT_FOUND,
            array('content-type' => 'text/html')
        );
        return $response;
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(Request $request)
    {
        $content = <<< EOM
        <html><head><title>ERROR</title></head>
        <body><h1>ERROR! 500</h1>
        </body></html>
EOM;
        $response = new Response(
            $content,
            Response::HTTP_INTERNAL_SERVER_ERROR,
            array('content-type' => 'text/html')
        );
        return $response;
    }

    /**
     * @Route("/jsonmethod", name="jsonmethod")
     */
    public function jsonmethod(Request $request)
    {
        $data = array(
            'name' => array('first' => 'Taro', 'second' => 'Yamada'),
            'age' => 36,
            'mail' => 'taro@yamada.kun'
        );
        return new JsonResponse($data);
    }

    /**
     * @Route("/xml", name="xml")
     */
    public function xmldisplay(Request $request)
    {
        $encoders = array(new XmlEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);


        $data = array(
            'name' => array('first' => 'Hanako', 'second' => 'Tanaka'),
            'age' => 29,
            'mail' => 'hanako@flower.san'
        );

        $response = new Response();
        $response->headers->set('Content-Type', 'xml');
        $result = $serializer->serialize($data, 'xml');
        $response->setContent($result);
        return $response;
    }

//    /**
//     * @Route("/other/{domain}", name="other")
//     */
//    public function other(Request $request, $domain = '')
//    {
//        if ($domain == '') {
//            return $this->redirect('/hello');
//        } else {
//            return new RedirectResponse("http://{$domain}.com");
//        }
//    }

    /**
     * @Route("/hello/params/{name}/{pass}", name="params")
     */
    public function params($name = ('noname'), $pass = ('no password')) // ()の中はデフォルト値
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
