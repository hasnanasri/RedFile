<?php

namespace Newstore\LivraisonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LivraisonType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('reference')
                ->remove('dateCreation')
                ->remove('dateModification')
                ->add('statut', 'choice', array('choices' => array(
                        '0' => 'En attente',
                        '1' => 'Livrée')))
                ->add('dateLivraison', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy'))
                ->add('magasin', 'entity', array(
                    'class' => 'NewstoreMagasinBundle:Magasin',
                    'property' => 'designation'))
                ->add('produits', 'collection', array(
                    'type' => new ProductQuantiteType(),
                    'options'=> array(
                      'data_class' => 'Newstore\LivraisonBundle\Entity\LivraisonProduit'  
                    ),
                    'allow_add' => true,
                    'allow_delete' => true
                ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\LivraisonBundle\Entity\Livraison'
        ));
    }

    public function getName() {
        return 'newstore_livraisonbundle_livraisontype';
    }

}
