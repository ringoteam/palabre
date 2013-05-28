<?php

namespace Palabre\ProjectBundle\Manager;

use Palabre\ProjectBundle\Model\Project;
use Palabre\ProjectBundle\Mapper\ProjectMapperInterface;

/**
 * Classe ProjectManager
 *
 */
class ProjectManager implements ProjectManagerInterface
{
    protected $mapper;
    protected $class;
    
    public function __construct(ProjectMapperInterface $mapper, $class)
    {
        $this->mapper = $mapper;
        $this->class  = $class;
    }
    
    public function create(Project $project)
    {
        return $this->mapper->create($project);
    }
    
    public function createNew()
    {
        $class = $this->class;
        
        return new $class();
    }
    
    public function delete(Project $project)
    {
        $this->mapper->remove($project);
    }
    
    public function find($id)
    {
        return $this->mapper->find($id);
    }
    
    public function findAll()
    {
        return $this->mapper->findAll();
    }
    
    public function update(Project $project)
    {
        return $this->mapper->update($project);
    }
}

