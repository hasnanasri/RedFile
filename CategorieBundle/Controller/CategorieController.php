<?php

namespace Newstore\CategorieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\CategorieBundle\Entity\Categorie;
use Newstore\CategorieBundle\Form\CategorieType;

class CategorieController extends Controller {

    public function indexAction() {
        $categories = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreCategorieBundle:Categorie')
                ->findAll();

        return $this->render('NewstoreCategorieBundle:Categorie:index.html.twig', array(
                    'Categories' => $categories
        ));
    }

    public function voirAction($id) {
        $categorie = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreCategorieBundle:Categorie')
                ->find($id);

        return $this->render('NewstoreCategorieBundle:Categorie:voir.html.twig', array(
                    'Categorie' => $categorie
        ));
    }

    public function ajouterAction() {
        $categorie = new Categorie;
        $form = $this->createForm(new CategorieType, $categorie);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();

                return $this->redirect($this->generateUrl('newstore_categorie_index'));
            }
        }

        return $this->render('NewstoreCategorieBundle:Categorie:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction(Categorie $categorie) {

        $form = $this->createForm(new CategorieType, $categorie);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();

                return $this->render('NewstoreCategorieBundle:Categorie:voir.html.twig', array(
                            'Categorie' => $categorie
                ));
            }
        }

        return $this->render('NewstoreCategorieBundle:Categorie:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'Categorie' => $categorie
        ));
    }

    public function supprimerAction(Categorie $categorie) {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($categorie);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Categorie bien supprim&eacute;');

                return $this->redirect($this->generateUrl('newstore_categorie_index'));
            }
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('NewstoreCategorieBundle:Categorie:supprimer.html.twig', array(
                    'Categorie' => $categorie,
                    'form' => $form->createView()
        ));
    }

}
