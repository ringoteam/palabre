<?php

namespace Palabre\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Classe HomeController
 *
 */
class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render(
            $this->getTemplatePath().'index.html.twig'
        );
    }
    
    
    /**
     * Get template path for this controller
     * 
     * @return string
     */
    protected function getTemplatePath()
    {
        return 'PalabreAppBundle:Main:';
    }
}