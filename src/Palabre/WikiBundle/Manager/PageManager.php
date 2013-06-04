<?php

namespace Palabre\WikiBundle\Manager;

use Palabre\WikiBundle\Model\Page;
use Palabre\WikiBundle\Manager\PageManagerInterface;

/**
* Class PageManager
*
*/
class PageManager implements PageManagerInterface
{
	protected $mapper;
    protected $class;
    
    public function __construct(PageMapperInterface $mapper, $class)
    {
        $this->mapper = $mapper;
        $this->class  = $class;
    }
}