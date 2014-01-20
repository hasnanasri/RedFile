<?php

namespace Newstore\ProduitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Newstore\FournisseurBundle\Entity\Fournisseur;
use Newstore\CategorieBundle\Entity\Categorie;
use Newstore\ZoneBundle\Entity\Zone;

class ProduitType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('designation', 'text')
                ->add('reference', 'text')
                ->add('prix', 'text')
                ->add('stockReel', 'text')
                ->add('stockDisponible', 'text')
                ->add('volume', 'text')
                ->add('volume', 'text')
                ->add('fournisseur', 'entity', array(
                    'class' => 'NewstoreFournisseurBundle:Fournisseur',
                    'property' => 'designation'))
                ->add('categorie', 'entity', array(
                    'class' => 'NewstoreCategorieBundle:Categorie',
                    'property' => 'libelle'))
                ->add('zone', 'entity', array(
                    'class' => 'NewstoreZoneBundle:Zone',
                    'property' => 'libelle'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Newstore\ProduitBundle\Entity\Produit'
        ));
    }

    public function getName() {
        return 'newstore_produitbundle_produittype';
    }

}
