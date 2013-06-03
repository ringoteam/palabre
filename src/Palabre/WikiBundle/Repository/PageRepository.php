<?php

namespace Palabre\WikiBundle\Repository;

use Palabre\WikiBundle\Mapper\PageMapperInterface;
use Palabre\WikiBundle\Model\Page;
use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository implements PageMapperInterface
{
    public function create(Page $page)
    {
        $this->_em->persist($page);
        $this->_em->flush();
        
        return $page;
    }
    
    public function update(Page $page)
    {
        $this->_em->persist($page);
        $this->_em->flush();
        
        return $page;
    }
    public function remove(Page $page)
    {
        $this->_em->remove($page);
        $this->_em->flush();
    }
}