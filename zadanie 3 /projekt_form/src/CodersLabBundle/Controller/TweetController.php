<?php

namespace CodersLabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use CodersLabBundle\Entity\Tweet;

class TweetController extends Controller
{
  private function getTweetForm($tweet){
    $form=$this->createFormBuilder($tweet)
      ->setAction($this->generateUrl)
      ->setMethod('POST')

      ->add('title')
      ->add('text')
      ->add('save','submit',array('label'=>'Create Tweet'))
      ->getForm();
      return $form;


  }
  /**
   * @Route("/tweetCreate")
   */
  public function createAction(Request $req){

    return $this->render('CodersLabBundle:Tweet:create.html.twig',array());
  }
  /**
   * @Route("/tweetNew")
   */
  public function newAction(){
    $tweet = new Tweet();
    $form = $this->getTweetForm($tweet);

    return $this->render('CodersLabBundle:Tweet:new.html.twig',array('form'=>$form->createView()));
  }



}
