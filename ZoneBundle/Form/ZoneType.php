<?php

namespace Newstore\ZoneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ZoneType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle')
                ->add('coordonnees')
                ->add('color')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\ZoneBundle\Entity\Zone'
        ));
    }

    public function getName() {
        return 'newstore_zonebundle_zonetype';
    }

}
