<?php
namespace CodersLabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use CodersLabBundle\Entity\User;
use CodersLabBundle\Entity\UserGroup;

class UserGroupController extends Controller
{
    /**
     * @Route("/group")
     * @Template()
     */
    public function groupIndexAction(){
        return
            [
                'groups'=>$this
                    ->getDoctrine()
                        ->getRepository('CodersLabBundle:UserGroup')
                            ->findAll()
            ];
    }
    /**
     * @Route("/user")
     * @Template()
     */
    public function userIndexAction(){
        return
            [
                'users'=>$this
                    ->getDoctrine()
                        ->getRepository('CodersLabBundle:User')
                            ->findAll()
            ];
    }
    /**
     * @Route("/group/{id}",name="showGroup")
     * @Template()
     */
    public function groupAction($id){
        return
            [
                'group'=>$this
                    ->getDoctrine()
                        ->getRepository('CodersLabBundle:UserGroup')
                            ->find($id)
            ];
    }
    /**
     * @Route("/user/{id}",name="showUser")
     * @Template()
     */
    public function userAction($id){
        return
            [
                'user'=>$this
                    ->getDoctrine()
                        ->getRepository('CodersLabBundle:User')
                            ->find($id)
            ];
    }
    /**
     * @Route("/addUserToGroup/{user_id}/{group_id}",name="putUserToGroup")
     */
    public function addUserToGroupAction($user_id,$group_id){
        $user = $this->getDoctrine()->getRepository('CodersLabBundle:User')->find($user_id);

        $group = $this->getDoctrine()->getRepository('CodersLabBundle:UserGroup')->find($group_id);

        $user->addGroup($group);
        $group->addUser($user);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl(
                "registerUser",
                [
                    'id'=>$user->getId()
                ]
            )
        );
    }
    /**
     * @Route("/removeUserFromGroup/{user_id}/{group_id}",name="removeUserFromGroup")
     */
    public function removeUserFromGroupAction($user_id,$group_id){
        $user = $this->getDoctrine()->getRepository('CodersLabBundle:User')->find($user_id);

        $group = $this->getDoctrine()->getRepository('CodersLabBundle:UserGroup')->find($group_id);

        $user->removeGroup($group);
        $group->removeUser($user);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirect(
            $this->generateUrl(
                "registerUser",
                [
                    'id'=>$user->getId()
                ]
            )
        );
    }

    /**
     * @Route("/user/{id}/register",name="registerUser")
     * @Template()
     */
    public function userToGroupAction($id){
        return
            [
                'groups' => $this
                    ->getDoctrine()
                        ->getRepository('CodersLabBundle:UserGroup')
                            ->findAll(),
                'user'=>$this
                    ->getDoctrine()
                        ->getRepository('CodersLabBundle:User')
                            ->find($id)
            ];
    }
    /**
     * @Route("/post")
     * @Template()
     */
    public function postIndexAction(){
        return ['posts'=>$this->getDoctrine()->getRepository("CodersLabBundle:Post")->findAll()];
    }
    /**
     * @Route("/post/{id}",name="showPost")
     * @Template()
     */
    public function postAction($id){
        return ['post'=>$this->getDoctrine()->getRepository("CodersLabBundle:Post")->find($id)];
    }

}
