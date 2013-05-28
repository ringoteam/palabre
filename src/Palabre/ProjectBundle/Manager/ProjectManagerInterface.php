<?php

namespace Palabre\ProjectBundle\Manager;

use Palabre\ProjectBundle\Model\Project;

/**
 * Classe ProjectManagerInterface
 *
 */
interface ProjectManagerInterface 
{
    public function create(Project $project);
    public function createNew();
    public function delete(Project $project);
    public function find($id);
    public function findAll();
    public function update(Project $project);
}

