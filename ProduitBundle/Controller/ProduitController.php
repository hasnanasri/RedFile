<?php

namespace Newstore\ProduitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\ProduitBundle\Entity\Produit;
use Newstore\ProduitBundle\Form\ProduitType;

class ProduitController extends Controller {

    public function indexAction() {
        $produits = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreProduitBundle:Produit')
                ->findAll();

        return $this->render('NewstoreProduitBundle:Produit:index.html.twig', array(
                    'Produits' => $produits
        ));
    }

    public function voirAction($id) {
        $produit = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreProduitBundle:Produit')
                ->find($id);

        return $this->render('NewstoreProduitBundle:Produit:voir.html.twig', array(
                    'Produit' => $produit
        ));
    }

    public function ajouterAction() {
        $produit = new Produit;
        $form = $this->createForm(new ProduitType, $produit);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($produit);
                $em->flush();

                return $this->redirect($this->generateUrl('newstore_produit_index'));
            }
        }

        return $this->render('NewstoreProduitBundle:Produit:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction(Produit $produit) {

        $form = $this->createForm(new ProduitType, $produit);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($produit);
                $em->flush();

                return $this->render('NewstoreProduitBundle:Produit:voir.html.twig', array(
                            'Produit' => $produit
                ));
            }
        }

        return $this->render('NewstoreProduitBundle:Produit:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'Produit' => $produit
        ));
    }

    public function supprimerAction(Produit $produit) {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($produit);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Produit bien supprim&eacute;');

                return $this->redirect($this->generateUrl('newstore_produit_index'));
            }
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('NewstoreProduitBundle:Produit:supprimer.html.twig', array(
                    'Produit' => $produit,
                    'form' => $form->createView()
        ));
    }

}
