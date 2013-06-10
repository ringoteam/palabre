<?php

namespace Palabre\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Classe UserController
 *
 */
class UserController extends Controller
{
    public function menuAction()
    {

        // récupération user
        $user = $this->getUser();

        // liens du menu user
        $aMenu = array();
        $aMenu[0]['path'] = 'fos_user_profile_show';
        $aMenu[0]['label'] = 'menu.profil_show';
        $aMenu[1]['path'] = 'fos_user_profile_edit';
        $aMenu[1]['label'] = 'menu.profil_edit';
        $aMenu[2]['path'] = 'fos_user_change_password';
        $aMenu[2]['label'] = 'menu.profil_change_password';
        $aMenu[3]['path'] = 'fos_user_registration_register';
        $aMenu[3]['label'] = 'menu.registration';
        $aMenu[4]['path'] = 'fos_user_security_logout';
        $aMenu[4]['label'] = 'menu.deconnexion';
        $aMenu[5]['path'] = 'palabre_user_list';
        $aMenu[5]['label'] = 'menu.user_list';

        return $this->render(
            $this->getTemplatePath().'menu.html.twig',
            array('user'=>$user, 'menu'=>$aMenu)
        );
    }
/*
    public function getUser()
    {

        $user = $parent::getUser();
        echo('beni');

        return $user;
    }*/
    
    
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