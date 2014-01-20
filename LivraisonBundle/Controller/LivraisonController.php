<?php

namespace Newstore\LivraisonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\LivraisonBundle\Form\LivraisonType;
use Newstore\LivraisonBundle\Entity\Livraison;
use Newstore\LivraisonBundle\Entity\LivraisonProduit;

class LivraisonController extends Controller {

    public function indexAction() {
        $livraisons = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreLivraisonBundle:LivraisonProduit')
                ->getLivraisonProduit();

        return $this->render('NewstoreLivraisonBundle:Livraison:index.html.twig', array(
                    'Livraisons' => $livraisons
        ));
    }

    public function ajouterAction() {
        $livraison = new Livraison;
        $form = $this->createForm(new LivraisonType, $livraison);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $livraison = new Livraison;
                $data = $form->getData();
                $livraison->setReference($data->getReference());
                $livraison->setStatut($data->getStatut());
                $livraison->setMagasin($data->getMagasin());
                $livraison->setDateLivraison($data->getDateLivraison());
                $em = $this->getDoctrine()->getManager();
                $em->persist($livraison);
                $em->flush();

                $produits = $data->getProduits();
                for ($i = 0; $i < count($produits); $i++) {
                    $produit = $produits[$i]->getProduit();
                    $LivraisonProduit = new LivraisonProduit;
                    $LivraisonProduit->setLivraison($livraison);
                    $LivraisonProduit->setProduit($produit);
                    $produit->setStockDisponible($produit->getStockDisponible() - $produits[$i]->getQuantite());
                    $LivraisonProduit->setQuantite($produits[$i]->getQuantite());
                    $em->persist($LivraisonProduit);
                }
                $em->flush();
            }

            return $this->render('NewstoreLivraisonBundle:Livraison:voir.html.twig', array(
                        'Item' => $this->ajouterProduitToLivraison($livraison),
            ));
        }
        return $this->render('NewstoreLivraisonBundle:Livraison:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction(Livraison $livraison) {
        $request = $this->get('request');
        $form = $this->createForm(new LivraisonType, $this->ajouterProduitToLivraison($livraison));

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $produits = $this->getDoctrine()
                        ->getRepository("NewstoreLivraisonBundle:LivraisonProduit")
                        ->findByLivraison($livraison->getId());

                $em = $this->getDoctrine()->getManager();
                for ($i = 0; $i < count($produits); $i++) {
                    $produit = $produits[0];
                    $em->remove($produit);
                    $livraison->removeProduit($produit);
                }
                //$em->flush();

                $em->persist($livraison);
                //$em->flush();
                return $this->render('NewstoreLivraisonBundle:Livraison:test.html.twig', array(
                            'variable' => $produits,
                ));
            }
        }
        return $this->render('NewstoreLivraisonBundle:Livraison:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'Livraison' => $livraison
        ));
    }

    public function voirAction(Livraison $livraison) {

        $produits = $this->getDoctrine()
                ->getRepository("NewstoreLivraisonBundle:LivraisonProduit")
                ->getProduitsByLivraisonWithQuantite($livraison->getId());

        for ($i = 0; $i < count($produits); $i++) {
            $produit = $produits[0];
            $LivraisonProduit = new LivraisonProduit();
            $LivraisonProduit->setLivraison($livraison);
            $LivraisonProduit->setProduit($produit[0]);
            $LivraisonProduit->setQuantite($produit['quantite']);
            $livraison->addProduit($LivraisonProduit);
        }


        return $this->render('NewstoreLivraisonBundle:Livraison:voir.html.twig', array(
                    'Item' => $livraison
        ));
    }

    public function supprimerAction(Livraison $livraison) {
        $form = $this->createFormBuilder()->getForm();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {

                $produits = $this->getDoctrine()
                        ->getRepository("NewstoreLivraisonBundle:LivraisonProduit")
                        ->findByLivraison($livraison->getId());

                $em = $this->getDoctrine()->getManager();
                for ($i = 0; $i < count($produits); $i++) {
                    $produit = $produits[0];
                    $em->remove($produit);
                    $livraison->removeProduit($produit);
                }
                $em->flush();

                $em->remove($livraison);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Livraison bien supprim&eacute;');
                return $this->redirect($this->generateUrl('newstore_livraison_index'));
            }
        }
        return $this->render('NewstoreLivraisonBundle:Livraison:supprimer.html.twig', array(
                    'form' => $form->createView(),
                    'Livraison' => $livraison
        ));
    }

    public function gettotallivraisonAction($id) {
        $somme = 0;

        $livraison = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreLivraisonBundle:LivraisonProduit')
                ->findByLivraison($id);

        foreach ($livraison as $key => $value) {
            $somme += $value->getQuantite();
        }

        return $this->render('NewstoreLivraisonBundle:Livraison:nombre.html.twig', array(
                    'Nombre' => $somme
        ));
    }

    private function ajouterProduitToLivraison(Livraison $livraison) {
        $produits = $this->getDoctrine()
                ->getRepository("NewstoreLivraisonBundle:LivraisonProduit")
                ->findByLivraison($livraison->getId());

        for ($i = 0; $i < count($produits); $i++) {
            $produit = $produits[$i];
            $livraison->addProduit($produit);
        }

        return $livraison;
    }

}
