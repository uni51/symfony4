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

class DbController extends AbstractController
{
    /**
     * @Route("/db/create", name="db.create")
     */
    public function create(Request $request)
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($request->getMethod() == 'POST'){
            $person = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();
            return $this->redirect('/db/index');
        } else {
            return $this->render('db/create.html.twig', [
                'title' => 'Hello',
                'message' => 'Create Entity',
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/db/delete/{id}", name="db.delete")
     */
    public function delete(Request $request, Person $person)
    {
        $form = $this->createFormBuilder($person)
            ->add('name', TextType::class)
            ->add('mail', TextType::class)
            ->add('age', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Click'))
            ->getForm();


        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $person = $form->getData();
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($person);
            $manager->flush();

            return $this->redirect('/db/index');
        } else {
            return $this->render('db/create.html.twig', [
                'title' => 'Hello',
                'message' => 'Delete Entity id=' . $person->getId(),
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/db/update/{id}", name="db.update")
     */
    public function update(Request $request, Person $person)
    {
        $form = $this->createFormBuilder($person)
            ->add('name', TextType::class)
            ->add('mail', TextType::class)
            ->add('age', IntegerType::class)
            ->add('save', SubmitType::class, array('label' => 'Click'))
            ->getForm();


        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);
            $person = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirect('/db/index');
        } else {
            return $this->render('db/create.html.twig', [
                'title' => 'Hello',
                'message' => 'Update Entity id=' . $person->getId(),
                'form' => $form->createView(),
            ]);
        }
    }

//    /**
//     * @Route("/db/create", name="db.create")
//     */
//    public function create(Request $request)
//    {
//        // 新しいPersonオブジェクトを作成
//        $person = new Person();
//        // FormBuilderを使用してフォームを作成
//        $form = $this->createFormBuilder($person)
//                ->add('name', TextType::class)
//                ->add('mail', TextType::class)
//                ->add('age', IntegerType::class)
//                ->add('save', SubmitType::class, array('label' => 'Click'))
//                ->getForm();
//
//
//        if ($request->getMethod() == 'POST'){
//            $form->handleRequest($request); // リクエストデータでフォームを充填
//
//            // フォームのデータを取得
//            $person = $form->getData();
//            // Doctrineのマネージャーを取得
//            $manager = $this->getDoctrine()->getManager();
//
//            // 新しいPersonをデータベースに保存
//            $manager->persist($person);
//            $manager->flush(); // 変更をデータベースに書き込み
//
//            // 保存後、'/db/index' にリダイレクト
//            return $this->redirect('/db/index');
//        } else {
//            // GETリクエストの場合はフォームを表示
//            return $this->render('db/create.html.twig', [
//                'title' => 'Hello',
//                'message' => 'Create Entity',
//                'form' => $form->createView(),
//            ]);
//        }
//    }

    /**
     * @Route("/db/find/{id}", name="db.find.id")
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

//class FindForm
//{
//    private $find;
//
//
//    public function getFind()
//    {
//        return $this->find;
//    }
//    public function setFind($find)
//    {
//        $this->find = $find;
//    }
//}
