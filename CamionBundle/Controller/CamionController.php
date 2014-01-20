<?php

namespace Newstore\CamionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\CamionBundle\Entity\Camion;
use Newstore\CamionBundle\Form\CamionType;

class CamionController extends Controller {

    public function indexAction() {
        $camions = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreCamionBundle:Camion')
                ->findAll();

        return $this->render('NewstoreCamionBundle:Camion:index.html.twig', array(
                    'Camions' => $camions
        ));
    }

    public function voirAction($id) {
        $camion = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreCamionBundle:Camion')
                ->find($id);

        return $this->render('NewstoreCamionBundle:Camion:voir.html.twig', array(
                    'Camion' => $camion
        ));
    }

    public function ajouterAction() {
        $camion = new Camion;
        $form = $this->createForm(new CamionType, $camion);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($camion);
                $em->flush();

                return $this->redirect($this->generateUrl('newstore_camion_index'));
            }
        }

        return $this->render('NewstoreCamionBundle:Camion:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function modifierAction(Camion $camion) {

        $form = $this->createForm(new CamionType, $camion);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($camion);
                $em->flush();

                return $this->render('NewstoreCamionBundle:Camion:voir.html.twig', array(
                            'Camion' => $camion
                ));
            }
        }

        return $this->render('NewstoreCamionBundle:Camion:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'Camion' => $camion
        ));
    }

    public function supprimerAction(Camion $camion) {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($camion);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Camion bien supprim&eacute;');

                return $this->redirect($this->generateUrl('newstore_camion_index'));
            }
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('NewstoreCamionBundle:Camion:supprimer.html.twig', array(
                    'Camion' => $camion,
                    'form' => $form->createView()
        ));
    }

}
