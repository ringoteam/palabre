<?php

namespace Palabre\WikiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
* Class PageType
*
* Form for Page
*/

class PageType extends AbsctractType 
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
            'data_class' => 'Palabre\WikiBundle\Model\Page',
        );
    }
    
    /**
     * Get form name
     * @return string Form name
     */
    public function getName()
    {
        return 'palabre.wiki.form.page';
    }

}