<?php

/*
 * Classe etendant la classe du FOSUserBundle
 */

namespace Palabre\UserBundle\Util;

use FOS\UserBundle\Util\UserManipulator as UserManipulatorBase;
use FOS\UserBundle\Model\UserManagerInterface;


class UserManipulator extends UserManipulatorBase
{

    /**
     * User manager
     *
     * @var UserManagerInterface
     */
    private $userManager;

    public function __construct(UserManagerInterface $userManager)
    {

        $this->userManager = $userManager;
    }
    
    /**
     * Creates a user and returns it.
     *
     * @param string  $firstname
     * @param string  $lastname
     * @param string  $username
     * @param string  $password
     * @param string  $email
     * @param Boolean $active
     * @param Boolean $superadmin
     *
     * @return \Palabre\UserBundle\Model\UserInterface
     */
    public function createPalabreUser($firstname, $lastname, $username, $password, $email, $active, $superadmin)
    {

        $user = $this->userManager->createUser();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) $active);
        $user->setSuperAdmin((Boolean) $superadmin);
        $this->userManager->updateUser($user);

        return $user;
    }
}
