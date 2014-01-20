<?php

namespace Newstore\CamionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CamionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('conducteurName', 'text', array('label'=>'Nom'))
            ->add('conducteurPrenom', 'text', array('label'=>'Prénom'))
            ->add('conducteurAdresse', 'text', array('label'=>'Adresse'))
            ->add('conducteurCodePostal', 'text', array('label'=>'Code postal','max_length' => 5))
            ->add('conducteurTelephone', 'text', array('label'=>'Téléphone','max_length' => 10))
            ->add('conducteurVille', 'text', array('label'=>'Ville'))
            ->add('capaciteVolume', 'text', array('label'=>'Volume'))
            ->add('immatriculation', 'text', array('label'=>'Immatriculation du camion'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\CamionBundle\Entity\Camion'
        ));
    }

    public function getName()
    {
        return 'newstore_camionbundle_camiontype';
    }
}
