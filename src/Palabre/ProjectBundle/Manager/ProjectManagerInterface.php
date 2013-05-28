<?php

namespace Palabre\ProjectBundle\Manager;

/**
 * Classe ProjectManagerInterface
 *
 */
class ProjectManagerInterface 
{
    public function create(Project $project);
    public function createNew();
    public function delete(Project $project);
    public function find($id);
    public function findAll();
    public function update(Project $project);
}

