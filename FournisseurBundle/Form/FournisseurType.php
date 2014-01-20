<?php

namespace Newstore\FournisseurBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', 'text')
            ->add('interlocuteurNom', 'text')
            ->add('interlocuteurPrenom', 'text')
            ->add('mail', 'email')
            ->add('telephone', 'text')
            ->add('adresse', 'text')
            ->add('codePostal', 'text')
            ->add('ville', 'text')
            ->add('pays', 'text')
            ->add('fax', 'text', array('required'=>false))
        ;
    }
    
    

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\FournisseurBundle\Entity\Fournisseur'
        ));
    }

    public function getName()
    {
        return 'newstore_fournisseurbundle_fournisseurtype';
    }
}
