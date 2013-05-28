<?php

namespace Palabre\ProjectBundle\Mapper;

use Palabre\ProjectBundle\Model\project;

interface ProjectMapperInterface
{
    public function create(Project $project);
    public function update(Project $project);
    public function remove(Project $project);
   
}
