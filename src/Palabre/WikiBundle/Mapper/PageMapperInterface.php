<?php

namespace Palabre\WikiBundle\Mapper;

use Palabre\WikiBundle\Model\Page;

interface PageMapperInterface
{
    public function create(Page $page);
    public function update(Page $page);
    public function remove(Page $page);
   
}