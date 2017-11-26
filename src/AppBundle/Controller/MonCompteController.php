<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use AppBundle\Entity\Categorie;

class MonCompteController extends Controller
{
    /**
     * @Route("/compte/{id}", name="compte")
     */
    public function indexAction(Request $request, Client $client)
    {
        if($this->getUser()!=null && $this->getUser()->getId()==$client->getUser()->getId()){
            $categories = $this->categories();
            $form = $this->createForm(ClientType::class, $client);        
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $client->getUser()->setEmail($client->getEmail());
    
                $encoder = $this->container->get('security.encoder_factory')->getEncoder($client->getUser());
                if(!empty($client->getPassword()))
                    $client->getUser()->setPassword($encoder->encodePassword($client->getPassword(), $client->getUser()->getSalt()));
                $em->persist($client->getUser());
                $em->flush();            
            }
            return $this->render('monCompte/compte.html.twig',['form' => $form->createView(),'idClient'=>$client->getId(),'client'=>$client,'categorie'=>$categories]);
        }
        else
            return $this->redirectToRoute('homepage');
    }
   
    public function categories() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository(Categorie::class)->findAll();
    }
}
