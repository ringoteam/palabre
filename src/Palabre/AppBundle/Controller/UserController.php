<?php

namespace Palabre\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Classe UserController
 *
 */
class UserController extends Controller
{
    public function profilMenuAction()
    {

        // récupération user
        $user = $this->getUser();

        // liens du menu user
        $aMenu = array();
        $aMenu[0]['path'] = 'fos_user_profile_show';
        $aMenu[0]['label'] = 'menu.profil.show';
        $aMenu[1]['path'] = 'fos_user_profile_edit';
        $aMenu[1]['label'] = 'menu.profil.edit';
        $aMenu[2]['path'] = 'fos_user_change_password';
        $aMenu[2]['label'] = 'menu.profil.change_password';
        $aMenu[3]['path'] = 'fos_user_security_logout';
        $aMenu[3]['label'] = 'menu.profil.deconnexion';

        return $this->render(
            $this->getTemplatePath().'profilMenu.html.twig',
            array('user'=>$user, 'menu'=>$aMenu)
        );
    }
    public function userMenuAction()
    {

        // récupération user
        $user = $this->getUser();

        // liens du menu user
        $aMenu = array();
        $aMenu[0]['path'] = 'fos_user_registration_register';
        $aMenu[0]['label'] = 'menu.user.registration';
        $aMenu[1]['path'] = 'palabre_user_list';
        $aMenu[1]['label'] = 'menu.user.list';

        return $this->render(
            $this->getTemplatePath().'userMenu.html.twig',
            array('menu'=>$aMenu)
        );
    }

    
    
    /**
     * Get template path for this controller
     * 
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'PalabreAppBundle:User:';
    }
}