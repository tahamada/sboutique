<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Categorie;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /*$categories = $this->get('BoutiqueServices')->categorie();*/
        /*$categories = $this->get('app_boutique')->categorie();*/
        $categories = $this->categories();

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
        $categorie='all';
        $opcategorie='\'all\'';
        $designation="";
        if($request->query->get('offset')){
        	$offset=$request->query->get('offset');
        }

        if($request->query->get('designation')){
        	$designation=$request->query->get('designation');
        }

        if($request->query->get('categorie') && $request->query->get('categorie')!='all'){
            $categorie=$request->query->get('categorie');
            $opcategorie='c.id';
        }

        if($request->query->get('tri')){
            $tri=$request->query->get('tri');
            
        }

        $limit=12;
        $offset=0;
        $page=1;
        if($request->query->get('page')!=null && is_numeric($request->query->get('page')) && intval($request->query->get('page'))>0){
            $offset=(intval($request->query->get('page'))-1)*intval($limit);
            $page=$request->query->get('page');
        }

        //compte le nombre d'article 
        $nbarticles = $em->getRepository('AppBundle:Articlevendeur')
        ->createQueryBuilder('c')
         ->select('COUNT(c)')
         ->getQuery()
         ->getSingleScalarResult();

        //article du slider
        $slideAricle= $em->getRepository('AppBundle:Articlevendeur')->findBy(
            array(),array('id'=>'desc'),5
        );

        //article de la recherche
        //$articles = $em->getRepository('AppBundle:Articlevendeur')->findBy($criteria,$order, $limit,$offset);
    	$articles = $em->getRepository('AppBundle:Articlevendeur')
    	->createQueryBuilder('av')
                ->join('av.article', 'a')
                ->join('a.categorie','c')                     
                ->where('a.designation LIKE :designation')
                ->setParameter('designation', "%".$designation."%")
                ->andWhere("$opcategorie = :cid")
                ->setParameter('cid', $categorie)
                ->orderBy('av.prix', $tri)
                ->setMaxResults($limit)
                ->setFirstResult($offset)
                ->getQuery()->getResult();

        if($request->query->get('mode')!=null && $request->query->get('mode')=='ajax')
                $twig="app/articleList.html.twig";            
        else
            $twig="app/index.html.twig";

        return $this->render($twig, [
            'articlesSlide' => [], 'nbArticle'=> $nbarticles, 'page'=>$page,'limit'=>$limit,'articles'=>$articles,'envDev'=>$envDev,'idClient'=>$idClient,'categorie'=>$categories, 'articlesSlide'=>$slideAricle
        ]);
    }

    /**
     * @Route("/detail", name="detail_article")
     */
    public function detailAction(Request $request){
        $categories = $this->categories();
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

            $criteria=['article'=>$request->query->get('idArticle')];
            $articleAutreVendeur = $em->getRepository('AppBundle:Articlevendeur')->findBy($criteria);


            return $this->render('app/detail.html.twig', [
                'article' => $article, 'envDev'=>$envDev,'idClient'=>$idClient,'categorie'=>$categories,'articleAutreVendeur'=>$articleAutreVendeur,'idVendeur'=>$request->query->get('idVendeur')
            ]);
        }
    } 

    public function categories() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository(Categorie::class)->findAll();
    }    
    
}
