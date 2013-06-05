<?php


namespace Palabre\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as ProfileFormTypeBase;

class ProfileFormType extends ProfileFormTypeBase
{    


    function buildForm(FormBuilderInterface $builder, array $options)
    {
        // champs supplémentaires
        $builder->add('firstName', null, array('label' => 'form.first_name', 'translation_domain' => 'PalabreUserBundle'));
        $builder->add('lastName', null, array('label' => 'form.last_name', 'translation_domain' => 'PalabreUserBundle'));

        
        // champs de FOSUserBundle
        parent::buildForm($builder, $options);

    }


    public function getName()
    {
        return 'palabre_user_profile';
    }
}
