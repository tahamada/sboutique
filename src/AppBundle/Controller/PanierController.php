<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Articlevendeur;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

class PanierController extends Controller
{
    
    /**
     * @Route("/panier", name="panier_list")
     */
    public function listAction(Request $request)
    {
        $panier=[];
        if($request->cookies->get('panier')){
            $panier=unserialize($request->cookies->get('panier'));
        }        
        return $this->render('panier/list.html.twig',['panier'=>$panier]);
        
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     * 
     */
    public function addAction(Request $request,Articlevendeur $article){  

        //url de l'image      
        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
        $imageurl = $helper->asset($article->getArticle(), 'imageFile');

        //tableau article qui sera stocké dans le cookie
        $articleArrayCookie=['id'=>$article->getId(),'designation'=>$article->getArticle()->getDesignation(),'prix'=>$article->getPrix(),'nomVendeur'=>$article->getVendeur()->getNomVendeur(),'idVendeur'=>$article->getVendeur()->getId(),'imageurl'=>$imageurl];

        //ajout dans le cookie
        if($request->cookies->get('panier')==null){
            $panier=[$article->getId()=>['article'=>$articleArrayCookie,'nb'=>1]];
        }
        else{
            $panier=unserialize($request->cookies->get('panier'));            
            if(isset($panier[$article->getId()])){                
                $panier[$article->getId()]['nb']++;

            }
            else{
                //$panier[$article->getId()]=['objet'=>$article,'article'=>$article->getArticle(),'nb'=>1];                
                $panier[$article->getId()]=['article'=>$articleArrayCookie,'nb'=>1];                
            }
        } 

        if(isset($panier))
            $cookie = new Cookie('panier', serialize($panier), strtotime('now + 24 hours'));  

        $nb=0;
        if(isset($panier)){
            foreach($panier as $a){
                $nb+=$a['nb'];
            }
            //$nb=count($panier);
        }
        //var_dump($cookie);
        $cookie;
        $response = new Response(json_encode(['nb'=>$nb]));
        $response->headers->setCookie($cookie);
        //$response->send();
        return $response;
    }

    /**
     * @Route("/stock/{id}", name="panier_stock")
     */
    public function stockAction(Request $request,Articlevendeur $article)
    {
        $panier=unserialize($request->cookies->get('panier'));

        //POST
        $quantiteSaisie=$request->request->get('quantite');

        //ajout de la nouvelle quantite dans le cookie
        $panier[$article->getId()]['nb']=$quantiteSaisie;
        $cookie = new Cookie('panier', serialize($panier), strtotime('now + 24 hours')); 

        $nb=0;
        if(isset($panier)){
            foreach($panier as $a){
                $nb+=$a['nb'];
            }
            //$nb=count($panier);
        }

        
        if($article->getQuantite()>0){            
            if($article->getQuantite()-$quantiteSaisie>0){
                $message=array("reponse"=>"En Stock","etat"=>1,"prix"=>$article->getPrix(),"nbPanier"=>$nb);
            }
            else{
                $message=array("reponse"=>"Limite dépassée","etat"=>-1,"prix"=>$article->getPrix(),"nbPanier"=>$nb);
            }
        }
        else{
            $message=array("reponse"=>"Plus en stock","etat"=>0,"prix"=>$article->getPrix(),"nbPanier"=>$nb);   
        }

                
        $content=json_encode(["reponse"=>$message]);
        $response=new response($content);
        $response->headers->setCookie($cookie);
        return $response;        
    }

    /**
     * @Route("/panier/del/{id}", name="panier_del")
     */
    public function delAction(Request $request, $id)
    {
        
        $panier=unserialize($request->cookies->get('panier'));
        unset($panier[$id]);

        $cookie = new Cookie('panier', serialize($panier), strtotime('now + 24 hours'));  
        
        $nb=0;
        if(isset($panier) && count($panier)>0){
            foreach($panier as $a){
                if(!empty($a))
                    $nb+=$a['nb'];
            }
            //$nb=count($panier);
        }
        
        $content=json_encode(["reponse"=>['nbPanier'=>count($nb)]]);
        $response=new response($content);
        $response->headers->setCookie($cookie);

        return $response; 
        
    }
}
