<?php

namespace Newstore\FournisseurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\FournisseurBundle\Entity\Fournisseur;
use Newstore\FournisseurBundle\Form\FournisseurType;

class FournisseurController extends Controller {

    public function indexAction() {
        $fournisseurs = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreFournisseurBundle:Fournisseur')
                ->findAll();

        // L'appel de la vue ne change pas
        return $this->render('NewstoreFournisseurBundle:Default:index.html.twig', array(
                    'fournisseurs' => $fournisseurs
        ));
    }

    public function ajouterAction() {
        $fournisseur = new Fournisseur;
        $form = $this->createForm(new FournisseurType, $fournisseur);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fournisseur);
                $em->flush();

                return $this->redirect($this->generateUrl('newstore_fournisseur_index'));
            }
        }

        return $this->render('NewstoreFournisseurBundle:Default:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction(Fournisseur $fournisseur) {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($fournisseur);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Fournisseur bien supprim&eacute;');

                return $this->redirect($this->generateUrl('newstore_fournisseur_index'));
            }
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('NewstoreFournisseurBundle:Default:supprimer.html.twig', array(
                    'fournisseur' => $fournisseur,
                    'form' => $form->createView()
        ));
    }

    public function modifierAction(Fournisseur $fournisseur) {
        $form = $this->createForm(new FournisseurType(), $fournisseur);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fournisseur);
                $em->flush();

                // On d�finit un message flash
                $this->get('session')->getFlashBag()->add('info', 'fournisseur bien modifi&eacute;');

                return $this->redirect($this->generateUrl('newstore_fournisseur_voir', array('id' => $fournisseur->getId())));
            }
        }

        return $this->render('NewstoreFournisseurBundle:Default:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'fournisseur' => $fournisseur
        ));
    }

    public function voirAction($id) {
        $em = $this->getDoctrine()
                ->getManager();

        $fournisseur = $em->getRepository('NewstoreFournisseurBundle:Fournisseur')
                ->find($id);

        if ($fournisseur === null) {
            throw $this->createNotFoundException('Fournisseur[id=' . $id . '] inexistant.');
        }

        return $this->render('NewstoreFournisseurBundle:Default:voir.html.twig', array(
                    'fournisseur' => $fournisseur,
        ));
    }

}
