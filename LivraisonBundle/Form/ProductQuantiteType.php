<?php

namespace Newstore\LivraisonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductQuantiteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        
        $builder
                ->remove('Livraison', 'entity', array(
                    'class' => 'NewstoreLivraisonBundle:Livraison',
                    'property' => 'id'))
                ->add('Produit', 'entity', array(
                    'class' => 'NewstoreProduitBundle:Produit',
                    'property' => 'designation'))
                ->add('Quantite', 'text', array(
                    'label'=>'Quantité'
                ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\LivraisonBundle\Entity\LivraisonProduit'
        ));
    }

    public function getName() {
        return 'newstore_livraisonbundle_ProductQuantitetype';
    }

}
