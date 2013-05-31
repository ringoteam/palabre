<?php
namespace Palabre\ProjectBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DoubleListType extends AbstractType
{
    
    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'double_list';
    }
}