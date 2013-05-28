<?php
 
namespace Palabre\UserBundle;
 
use Symfony\Component\HttpKernel\Bundle\Bundle;
 
class PalabreUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}