<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;

class MonCompteController extends Controller
{
    /**
     * @Route("/compte/{id}", name="compte")
     */
    public function indexAction(Request $request, Client $client)
    {
        $user = $this->getUser();        

        $form = $this->createForm(ClientType::class, $client);        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $client->getUser()->setEmail($client->getEmail());
            $em->persist($client->getUser());
            $em->flush();            
        }
        return $this->render('monCompte/compte.html.twig',['form' => $form->createView(),'idClient'=>$client->getId(),'client'=>$client,'categorie'=>$categories]);
    }
   
    public function categories() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository(Categorie::class)->findAll();
    }
}
