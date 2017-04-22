<?php

namespace CodersLabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CodersLabBundle\Entity\Post;

class BookController extends Controller
{

  // dodanie postu do bazy danych



  /**
   * @Route("/")
   */

  public function indexAction()
  {
      $post = new Post();

      $post ->setTitle('sfdsdfdsdf');
      $post ->setText("some text");


      $em = $this->getDoctrine()->getManager();
      $em ->persist($post);
      $em->flush($post);

      return $this->render('CodersLabBundle:Default:index.html.twig', array('post'=>$post));
  }
  /**
   * @Route("/showAll")
   */

  public function showAllAction(){
    $repo = $this->getDoctrine()->getRepository("CodersLabBundle:Post");
    $posts = $repo->findAll();

    return $this->render(
      'CodersLabBundle:views1:showAll.html.twig', array('posts'=>$posts)
    );
  }

//   Część C – Praca na modelu
// Zadanie C1 – tworzenie książki
// Stwórz akcję /newBook, która ma wyświetlać formularz do tworzenia nowej książki. Formularz – póki co – napisz w normalnym HTML. Formularz ma kierować do akcji /createBook.


/**
 * @Route("/newBook")
 */


 public function newBookAction()
 {
   return $this->render(
     'CodersLabBundle:views1:newBook.html.twig', array('posts'=>$posts)
   );

 }
























}
