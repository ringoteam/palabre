<?php

namespace Palabre\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserManager;

/**
 * Classe UserController
 *
 */
class UserController extends Controller
{
    public function listAction()
    {

        $userManager = $this->container->get('fos_user.user_manager');

        $users = array();
        $users = $userManager->findUsers();
        

        return $this->render(
            'PalabreUserBundle:User:list.html.twig',
            array('users'=>$users)
        );
    }
    public function editAction($id)
    {

        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->findUserBy(array('id' => $id));
        

        return $this->render(
            'PalabreUserBundle:User:edit.html.twig',
            array('user'=>$user)
        );
    }
    
    
}