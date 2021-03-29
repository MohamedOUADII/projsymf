<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/list", name="articles")
     */
    public function index()
    {
        //dump($request);
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $arts = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $arts,
        ]);
    }
    /**
     * @Route("/article/new", name="add_article")
     */
    public function create(EntityManagerInterface $manager ,Request $request)
    {/**/
        if($request->request->count()>0){
        $article = new Article();

        $article->setName($request->request->get('name'))
                ->setBody($request->request->get('body'));
        $manager->persist($article);
        $manager->flush();

        return $this->redirectToRoute('articles');
    }
        return $this->render('article/create.html.twig');
    }


    /**
     * @Route("/article/{id}", name="show_article")
     */
    public function show(Article $article)
    {

        return $this->render('article/show.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article,

        ]);
    }

    /**
     * @Route("/article/edit/{id}", name="edit_article")
     */
    public function edit(EntityManagerInterface $manager,Request $request,Article $article)
    {
        //dump($request);

        if($request->request->count()>0){
            $article->setName($request->request->get('name'))
                    ->setBody($request->request->get('body'));
            $manager->merge($article);
            $manager->flush();
            return $this->redirectToRoute('articles');
        }else{
            //dump($request);
            return $this->render('article/edit.html.twig',[
                'article' => $article,
            ]);
        }/*////*/

    }

    /**
     * @Route("/article/delete/{id}", name="delete_article")
     */
    public function delete(EntityManagerInterface $manager,Request $request,Article $article)
    {
        //dump($request);

        //if($request->request->count()>0){
            $manager->remove($article);
            $manager->flush();
            return $this->redirectToRoute('articles');
        /*}else{
        //dump($request);
        return $this->render('article/delete.html.twig',[
            'article' => $article,
        ]);
    }////*/

    }


}
