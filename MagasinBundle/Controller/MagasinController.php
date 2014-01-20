<?php

namespace Newstore\MagasinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\MagasinBundle\Entity\Magasin;
use Newstore\MagasinBundle\Form\MagasinType;

class MagasinController extends Controller {

    public function indexAction() {
        $magasins = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreMagasinBundle:Magasin')
                ->findAll();

        // L'appel de la vue ne change pas
        return $this->render('NewstoreMagasinBundle:Magasin:index.html.twig', array(
                    'Magasins' => $magasins
        ));
    }

    public function ajouterAction() {
        $magasin = new Magasin;
        $form = $this->createForm(new MagasinType, $magasin);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($magasin);
                $em->flush();

                return $this->redirect($this->generateUrl('newstore_magasin_index'));
            }
        }

        return $this->render('NewstoreMagasinBundle:Magasin:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function supprimerAction(Magasin $magasin) {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($magasin);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Magasin bien supprim&eacute;');

                return $this->redirect($this->generateUrl('newstore_magasin_index'));
            }
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('NewstoreMagasinBundle:Magasin:supprimer.html.twig', array(
                    'magasin' => $magasin,
                    'form' => $form->createView()
        ));
    }

    public function modifierAction(Magasin $magasin) {
        $form = $this->createForm(new MagasinType(), $magasin);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($magasin);
                $em->flush();

                // On d�finit un message flash
                $this->get('session')->getFlashBag()->add('info', 'magasin bien modifi&eacute;');

                return $this->redirect($this->generateUrl('newstore_magasin_voir', array('id' => $magasin->getId())));
            }
        }

        return $this->render('NewstoreMagasinBundle:Magasin:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'magasin' => $magasin
        ));
    }

    public function voirAction($id) {
        $em = $this->getDoctrine()
                ->getManager();

        $magasin = $em->getRepository('NewstoreMagasinBundle:Magasin')
                ->find($id);

        if ($magasin === null) {
            throw $this->createNotFoundException('Magasin[id=' . $id . '] inexistant.');
        }

        return $this->render('NewstoreMagasinBundle:Magasin:voir.html.twig', array(
                    'magasin' => $magasin,
        ));
    }

}
