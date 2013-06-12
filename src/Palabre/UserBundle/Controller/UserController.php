<?php

namespace Palabre\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserManager;



use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Classe UserController
 *
 */
class UserController extends Controller
{
    public function listAction()
    {

        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');

        // récupération des users
        $users = array();
        $users = $userManager->findUsers();
        

        return $this->render(
            'PalabreUserBundle:User:list.html.twig',
            array('users'=>$users)
        );
    }

    public function editAction($id, Request $request)
    {

        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');

        // récupération du user en fct de l'id
        $user = $userManager->findUserBy(array('id' => $id));
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not exist.');
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {

                $userManager->updateUser($user);
                
                //TODO : message flash confirmation

                $url = $this->container->get('router')->generate('palabre_user_list');
                 $response = new RedirectResponse($url);

                return $response;
            }
        }

        return $this->container->get('templating')->renderResponse(
            'PalabreUserBundle:User:edit.html.twig',
            array('form' => $form->createView())
        );

        
    }
        
    public function deleteAction($id)
    {

        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');

        // récupération du user en fct de l'id
        $user = $userManager->findUserBy(array('id' => $id));
        // user inconnu
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not exist.');
        // suppression du user
        }else{
            $userManager->deleteUser($user);
        }

        // redirection vers la liste
        $url = $this->container->get('router')->generate('palabre_user_list');
        $response = new RedirectResponse($url);
        return $response;
    }
}