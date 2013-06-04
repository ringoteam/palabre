<?php

namespace Palabre\WikiBundle\Controller;

use Palabre\WikiBundle\Model\Page;
use Palabre\WikiBundle\Form\PageType;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
* Class PageController
*
*/
class PageController extends Controller
{
	public function indexAction()
	{
		$pages = $this->getManager()->findAll();
        
        return $this->render(
            $this->getTemplatePath().'index.html.twig',
            array(
                'pages' => $pages
            )
        );
	}
}