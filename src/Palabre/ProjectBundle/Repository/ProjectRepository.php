<?php

namespace Palabre\ProjectBundle\Repository;

use Palabre\ProjectBundle\Mapper\ProjectMapperInterface;
use Palabre\ProjectBundle\Model\Project;
use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository implements ProjectMapperInterface
{
    public function create(Project $project)
    {
        $this->_em->persist($project);
        $this->_em->flush();
        
        return $project;
    }
    
    public function update(Project $project)
    {
       
        $this->_em->persist($project);
        $this->_em->flush();
        
        return $project;
    }
    public function remove(Project $project)
    {
        $this->_em->remove($project);
        $this->_em->flush();
    }
}