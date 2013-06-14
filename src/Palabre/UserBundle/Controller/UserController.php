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
   
    /**
    * Liste des users
    *
    * @param string $tri : nom du champ du tri
    * @param int $page : page courante
    * @todo : recherche par email, nom, prénom , login
    * @todo : tris
    */
    public function listAction($tri = null, $page)
    {

        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');

        // liste de tris
        $types_tri = array();
        $types_tri[0]['label'] = 'user.list.last_name';
        $types_tri[0]['value'] = 'lastName';
        $types_tri[1]['label'] = 'user.list.first_name';
        $types_tri[1]['value'] = 'firstName';
        $types_tri[2]['label'] = 'user.list.username';
        $types_tri[2]['value'] = 'username';
        $types_tri[3]['label'] = 'user.list.email';
        $types_tri[3]['value'] = 'email';

        //tri par defaut
        $current_tri = 'lastName';
        $label_current_tri = 'lastName';

        // controle tri
        for($i=0; $i<count($types_tri); $i++){
            if($types_tri[$i]['value'] == $tri){
                $current_tri = $types_tri[$i]['value'];
                $label_current_tri = $types_tri[$i]['label'];
            }
        }

        // récupération des users en fct pagination et tri
        $all_users = array();
        $all_users = $userManager->findUsers();
        $total_users    = count($all_users);
        $users_per_page = 5;
        $last_page      = ceil($total_users / $users_per_page);
        $previous_page  = $page > 1 ? $page - 1 : 1;
        $next_page      = $page < $last_page ? $page + 1 : $last_page; 
        $users          = $this ->getDoctrine()
                                ->getRepository('PalabreUserBundle:User')
                                ->createQueryBuilder('p')
                                ->setFirstResult(($page * $users_per_page) - $users_per_page)
                                ->setMaxResults($users_per_page)
                                ->orderBy('p.'.$tri)
                                ->getQuery()
                                ->getResult();

        return $this->render($this->getTemplatePath().'list.html.twig', 
            array(
                'users' => $users,
                'current_tri' => $current_tri,
                'label_current_tri' => $label_current_tri,
                'types_tri' => $types_tri,
                'last_page' => $last_page,
                'previous_page' => $previous_page,
                'current_page' => $page,
                'next_page' => $next_page,
                'total_users' => $total_users,
            )
        );
        

    }


    /**
    * Création d'un user
    *
    * @param object Request $request : données du formulaire
    */
    public function createAction(Request $request)
    {
        
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setEnabled(true);
       
        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                
                $userManager->updateUser($user);

                $this->get('session')->getFlashBag()->add('success', $this->get('translator')->trans('user.create.confirmed', array('%username%' => $user->getUsername()), 'PalabreUserBundle'));

                $url = $this->container->get('router')->generate('palabre_user_list');
                $response = new RedirectResponse($url);
            
                return $response;
            }
        }

        return $this->render($this->getTemplatePath().'create.html.twig', 
            array('form' => $form->createView())
        );
    }

    /**
    * Edition d'un user
    *
    * @param int $id : identifiant du user
    * @param object Request $request : données du formulaire
    * @todo : ne pas utiliser fos_user.profile.form.factory car permet uniquement edition du user logué!!!! faire un nouveau formulaire spécifique
    */
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
                
                $url = $this->container->get('router')->generate('palabre_user_list');
                $response = new RedirectResponse($url);

                return $response;
            }
        }

        return $this->render($this->getTemplatePath().'edit.html.twig', 
            array('form' => $form->createView())
        );

        
    }
        
    /**
    * Suppression d'un user
    *
    * @param int $id : identifiant du user
    * @todo message user supprimé
    */
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

    /**
     * Get template path for this controller
     * 
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'PalabreUserBundle:User:';
    }
}