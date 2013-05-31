<?php

namespace Palabre\ProjectBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * Class ProjectType
 *
 * Form for Project
 * 
 */
class ProjectType extends AbstractType
{
    protected $class;
    protected $userManager;

    public function __construct(UserManagerInterface $userManager, $class)
    {
        $this->userManager = $userManager;
        $this->class = $class;
    }

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
        $builder->add('description', 'textarea');
        $builder->add('users', 'double_list', array(
           'class' => 'PalabreUserBundle:User',
           'multiple' => true
        ));
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
            'data_class' => $this->class,
        );
    }
    
    /**
     * Get form name
     * @return string Form name
     */
    public function getName()
    {
        return 'palabre_project_type_project';
    }
}