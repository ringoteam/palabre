<?php

namespace Palabre\ProjectBundle\Controller;

use Palabre\ProjectBundle\Model\Project;
use Palabre\ProjectBundle\Form\ProjectType;

/**
 * Classe ProjectController
 *
 */
class ProjectController 
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
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->getManager()->create($form->getData());
                $this->get('session')->setFlash('success', 'Project created successfully');

                return new RedirectResponse($this->generateUrl('palabre_project_projects'));
            }else {
                $this->get('session')->setFlash('error', 'Some errors have been found');
            }
        }
        
        return $this->render(
            $this->getTemplatePath().'create.html.twig',
            array(
                'form' => $form->createView(),
                'errors' => $form->getErrors()
            )
        );
    }
    
    public function updateAction($id)
    {
        $project = $this->getManager()->find($id);
        $form = $this->getForm($project);
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->getManager()->create($form->getData());
                $this->get('session')->setFlash('success', 'Project updated successfully');

                return new RedirectResponse($this->generateUrl('palabre_project_projects'));
            }else {
                $this->get('session')->setFlash('error', 'Some errors have been found');
            }
        }
        
        return $this->render(
            $this->getTemplatePath().'update.html.twig',
            array(
                'form' => $form->createView(),
                'errors' => $form->getErrors()
            )
        );
    }
    
    public function deleteAction($id)
    {
        $project = $this->getManager()->find($id);
        if($project) {
            $this->getManager()->delete($project);
            $this->get('session')->setFlash('success', 'Project has been deleted successfully');
        }else {
            $this->get('session')->setFlash('error', 'This project does not exist');
        }
        
        return new RedirectResponse($this->generateUrl('palabre_project_projects'));
    }
    
    protected function getManager()
    {
        return $this->get('palabre_project.project_manager');
    }
    
    /**
     * Get template path for this controller
     * 
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'PalabreProjectbundle:Project:';
    }
    
    protected function getForm(Project $project)
    {
        if(!$project) {
            $project = $this->getManager()->createNew();
        }
        
        return $this->createForm(new ProjectType(), $project);
    }
}

