<?php

namespace Newstore\CategorieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', 'text')
            ->add('raccourci', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\CategorieBundle\Entity\Categorie'
        ));
    }

    public function getName()
    {
        return 'newstore_categoriebundle_categorietype';
    }
}
