<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Articlevendeur;
use AppBundle\Entity\Message;
use AppBundle\Entity\Client;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CommentaireController extends Controller
{
    
    /**
     * @Route("/commentaire/article/{id}", name="commentaire_list")
     */
    public function listAction(Request $request, Articlevendeur $article=null)
    {
        if($article){            
            return $this->render('commentaire/list.html.twig',['commentaires'=>$article->getCommentaires()]);
        }
    }

    /**
     * @Route("/commentaire/add/article/{idArticle}/client/{idPersonne}", name="commentaire_add")
     * @ParamConverter("article", options={"mapping": {"idArticle": "id"}})
     * @ParamConverter("client", options={"mapping": {"idPersonne": "id"}})
     */
    public function detailAction(Request $request,Articlevendeur $article, Client $client){
        $commentaire = new Message();
        $em = $this->getDoctrine()->getManager();
        $commentaire->setDate(new \DateTime('now'));
        $commentaire->setContenu($request->request->get("contenu"));
        $commentaire->setClient($client);
        $commentaire->setArticle($article);
        $commentaire->setVisible(1);

        $em->persist($commentaire);
        $em->flush();
        
        return new Response();
    }

}
