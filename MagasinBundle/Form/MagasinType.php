<?php

namespace Newstore\MagasinBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MagasinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('interlocuteurNom')
            ->add('interlocuteurPrenom')
            ->add('mail')
            ->add('telephone')
            ->add('adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('pays')
            ->add('fax')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\MagasinBundle\Entity\Magasin'
        ));
    }

    public function getName()
    {
        return 'newstore_magasinbundle_magasintype';
    }
}
