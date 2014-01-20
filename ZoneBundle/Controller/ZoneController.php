<?php

namespace Newstore\ZoneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Newstore\ZoneBundle\Entity\Zone;
use Newstore\ZoneBundle\Form\ZoneType;
use Symfony\Component\HttpFoundation\Response;

class ZoneController extends Controller
{
    public function indexAction()
    {
        $zone = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreZoneBundle:Zone')
                ->findAll();

        return $this->render('NewstoreZoneBundle:Zone:index.html.twig', array(
                    'Zone' => $zone
        ));
    }
    public function voirAction($id)
    {
        $zone = $this->getDoctrine()
                ->getManager()
                ->getRepository('NewstoreZoneBundle:Zone')
                ->find($id);

        return $this->render('NewstoreZoneBundle:Zone:voir.html.twig', array(
                    'Zone' => $zone
        ));
    }
    public function ajouterAction()
    {
        $zone = new Zone;
        $form = $this->createForm(new ZoneType, $zone);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($zone);
                $em->flush();

                return $this->redirect($this->generateUrl('newstore_zone_index'));
            }
        }
        return $this->render('NewstoreZoneBundle:Zone:ajouter.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    public function modifierAction(Zone $zone)
    {
        $form = $this->createForm(new ZoneType, $zone);

        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($zone);
                $em->flush();

                return $this->render('NewstoreZoneBundle:Zone:voir.html.twig', array(
                            'Zone' => $zone
                ));
            }
        }

        return $this->render('NewstoreZoneBundle:Zone:modifier.html.twig', array(
                    'form' => $form->createView(),
                    'Zone' => $zone
        ));
    }
    public function supprimerAction(Zone $zone)
    {
        $form = $this->createFormBuilder()->getForm();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($zone);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Zone bien supprim&eacute;');

                return $this->redirect($this->generateUrl('newstore_zone_index'));
            }
        }

        // Si la requ�te est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('NewstoreZoneBundle:Zone:supprimer.html.twig', array(
                    'Zone' => $zone,
                    'form' => $form->createView()
        ));
    }
    
    public function haveProduitAction(Zone $zone){
        $listProduit = $this->getDoctrine()
                ->getRepository("NewstoreProduitBundle:Produit")
                ->findByZone($zone->getId());
        if(count($listProduit) > 0){
            return new Response("true");
        }
        return new Response("false");
    }
}
