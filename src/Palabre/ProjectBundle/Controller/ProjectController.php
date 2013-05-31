<?php

namespace Palabre\ProjectBundle\Controller;

use Palabre\ProjectBundle\Model\Project;
use Palabre\ProjectBundle\Form\ProjectType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Classe ProjectController
 *
 */
class ProjectController extends Controller
{
    public function indexAction()
    {
        $projects = $this->getManager()->findAll();
        
        return $this->render(
            $this->getTemplatePath().'index.html.twig',
            array(
                'projects' => $projects 
            )
        );
    }
    
    public function createAction()
    {

        $form = $this->getForm();
        $request = $this->get('Request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $project = $form->getData();
                $this->getManager()->create($project);
                $this->getAclManager()->grant(
                    $project,
                    $this->get('security.context')->getToken()->getUser()
                );
                $this->get('session')->setFlash('success', 'Project created successfully');

                return new RedirectResponse($this->generateUrl('palabre_project_projects'));
            }else {
                $this->get('session')->setFlash('error', 'Some errors have been found');
            }
        }
        
        return $this->render(
            $this->getTemplatePath().'create.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
    
    public function updateAction($id)
    {
        $project = $this->findProject($id);
        $form = $this->getForm($project);
        $request = $this->get('Request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->getManager()->update($form->getData());
                $this->get('session')->setFlash('success', 'Project updated successfully');

                return new RedirectResponse($this->generateUrl('palabre_project_projects'));
            }else {
                $this->get('session')->setFlash('error', 'Some errors have been found');
            }
        }
        
        return $this->render(
            $this->getTemplatePath().'update.html.twig',
            array(
                'form'    => $form->createView(),
                'project' => $project
            )
        );
    }
    
    public function deleteAction($id)
    {
        $project = $this->findProject($id);
        
        $this->getManager()->delete($project);
        $this->get('session')->setFlash('success', 'Project has been deleted successfully');
        
        
        return new RedirectResponse($this->generateUrl('palabre_project_projects'));
    }
    
    public function usersAction($id)
    {
        $project = $this->findProject($id);
        
    }

    public function permissionsAction($id)
    {
        $project = $this->findProject($id);
    }

    protected function findProject($id)
    {
        $project = $this->getManager()->find($id);
        if(!$project) {
            $this->createNotFoundException(sprintf('Project %s does not exist', $id));
        }

        return $project;
    }

    protected function getManager()
    {
        return $this->get('palabre_project.project_manager');
    }
    
    protected function getAclManager()
    {
        return $this->get('palabre_project.acl.project_manager');
    }

    /**
     * Get template path for this controller
     * 
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'PalabreProjectBundle:Project:';
    }
    
    protected function getForm(Project $project = null)
    {
        if(!$project) {
            $project = $this->getManager()->createNew();
        }
        return $this->createForm(
            $this->container->get('palabre_project.project_form_type'), 
            $project
        );
    }
}

