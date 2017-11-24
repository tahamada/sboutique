<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $envDev=false;        
        if($this->container->getParameter('kernel.environment')=="dev")
            $envDev=true;
        $user = $this->getUser();
        if($user)
            $idClient=$user->getClient()->getId();
        else
            $idClient=null;
        $em = $this->getDoctrine()->getManager();
        $criteria=array();

        $order=null;
        $limit=16;
        $offset=0;
        $tri='asc';
        $designation="";
        if($request->query->get('offset')){
        	$offset=$request->query->get('offset');
        }

        if($request->query->get('recherche')){
        	$designation=$request->query->get('recherche');
        }


        //$articles = $em->getRepository('AppBundle:Articlevendeur')->findBy($criteria,$order, $limit,$offset);
    	$articles = $em->getRepository('AppBundle:Articlevendeur')
    	->createQueryBuilder('a')                        
                /*->where('a.designation LIKE :designation')
                ->setParameter('designation', "%".$designation."%")*/  
                ->orderBy('a.prix', 'ASC')
                ->setMaxResults($limit)
                ->setFirstResult($offset)
                ->getQuery()->getResult();

        return $this->render('app/index.html.twig', [
            'articlesSlide' => [], 'nbArticle'=> count($articles), 'page'=>1,'limit'=>12,'articles'=>$articles,'envDev'=>$envDev,'idClient'=>$idClient
        ]);
    }

    /**
     * @Route("/detail", name="detail_article")
     */
    public function detailAction(Request $request){
        if($request->query->get('idArticle') && $request->query->get('idVendeur')){
            $envDev="";        
            if($this->container->getParameter('kernel.environment')=="dev")
                $envDev="app_dev.php/";

            $user = $this->getUser();
            if($user)
                $idClient=$user->getClient()->getId();
            else
                $idClient=null;
            $em = $this->getDoctrine()->getManager();
            $criteria=['article'=>$request->query->get('idArticle'),'vendeur'=>$request->query->get('idVendeur')];
            $article = $em->getRepository('AppBundle:Articlevendeur')->findOneBy($criteria);
            return $this->render('app/detail.html.twig', [
                'article' => $article, 'envDev'=>$envDev,'idClient'=>$idClient
            ]);
        }
    }

}
