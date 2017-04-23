<?php

namespace CodersLabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use CodersLabBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/form")
     * @Template()
     */
    public function formAction(){
        $newPost = new Post();

        $form = $this->createFormBuilder($newPost)
            ->setAction($this->generateUrl('readFormData'))
            ->setMethod('POST')
            ->add('title',null,
                array(
                    'label'=>'post title',
                    'attr'=>array(
                        'class'=>'myFormElement',
                        'placeholder'=>'give post title'
                    )
                ))
            ->add('text')
            ->add('save', 'submit')
            ->getForm();

        return ['myForm'=>$form->createView()];
    }
    /**
     * @Route("/supportForm",name="readFormData")
     * @Template()
     */
    public function supportFormAction(){
        return [];
    }

    /**
     * @Route("/showAll")
     */
    public function showAllAction()
    {
        $repo = $this->getDoctrine()->getRepository("CodersLabBundle:Post");

        $posts = $repo->findAll();

        return $this->render(
            'CodersLabBundle:Default:showAll.html.twig',
            array('posts'=>$posts)
        );
    }
    /**
     * @Route("/show/{id}",name="showPost")
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository("CodersLabBundle:Post");

        $post = $repo->find($id);
        // $post = $repo->findOneByTitle('My first post');

        return $this->render(
            'CodersLabBundle:Default:show.html.twig',
            array(
                'post'=>$post
            )
        );
    }
    /**
     * @Route("/setTitle/{id}/{new_title}")
     */
    public function setTitleAction($id,$new_title)
    {
        $repo = $this->getDoctrine()->getRepository("CodersLabBundle:Post");

        $post = $repo->find($id);

        $post->setTitle($new_title);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->render(
            'CodersLabBundle:Default:show.html.twig',
            array('post'=>$post)
        );
    }
    /**
     * @Route("/create")
     */
    public function createAction()
    {
        $post = new Post();
        $post->setTitle("My 3 post");
        $post->setText("My 3 post text");

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->render(
            'CodersLabBundle:Default:create.html.twig',
            array('post'=>$post)
        );
    }
    /**
     * @Route("/showUserPosts/{id}")
     */
    public function showUserPostsAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:User');
        $user = $repo->find($id);
        return $this->render(
            'CodersLabBundle:Default:showUserPosts.html.twig',
            array('user'=>$user)
        );
    }
    /**
     * @Route("/setAuthorForPost/{id_post}/{id_user}")
     */
    public function setAuthorForPostAction($id_post,$id_user)
    {
        $repo_user = $this->getDoctrine()->getRepository('CodersLabBundle:User');
        $repo_post = $this->getDoctrine()->getRepository('CodersLabBundle:Post');

        $post = $repo_post->find($id_post);
        $user = $repo_user->find($id_user);

        $post->setAuthor($user);
        $user->addPost($post);

        $this->getDoctrine()->getManager()->flush();

        return $this->render(
            'CodersLabBundle:Default:setAuthorForPost.html.twig',
            array('user'=>$user)
        );
    }
}
