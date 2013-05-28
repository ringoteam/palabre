<?php

namespace Palabre\ProjectBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ProjectType
 *
 * Form for Redis instance
 * 
 */
class ProjectType extends AbstractType
{
    /**
     * Build form
     * 
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden');
        $builder->add('name', 'text');
    }

    /**
     * Get form default options
     * 
     * @param array $options
     * @return array Form options
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Palabre\ProjectBundle\Model\Project',
        );
    }
    
    /**
     * Get form name
     * @return string Form name
     */
    public function getName()
    {
        return 'palabre.project.form.project';
    }
}