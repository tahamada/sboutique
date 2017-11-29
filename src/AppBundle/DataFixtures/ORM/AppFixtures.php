<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Article;
use AppBundle\Entity\Articlevendeur;
use AppBundle\Entity\Client;
use AppBundle\Entity\Vendeur;
use AppBundle\Entity\User;
use AppBundle\Entity\Message;
use AppBundle\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 categorie!
        for ($i = 0; $i < 60; $i++) {
            $categorie = new Categorie();
            $categorie->setNom('Categorie '.$i);
            $manager->persist($categorie);       
            $article = new Article();
            $article->setDesignation('Designation '.$i);
            $article->setCategorie($categorie);
            $article->setDescription("Description ".$i);
            $manager->persist($article);
            $articlevendeur = new Articlevendeur();
            $articlevendeur->setArticle($article);
            $articlevendeur->setQuantite(mt_rand(10, 100));
            $articlevendeur->setPayablenfois(0);
            $articlevendeur->setPrix(mt_rand(10, 500));
            /**
            create user
            **/
            $vendeur= new Vendeur();
            $vendeur->setNomvendeur("vendeur ".$i);
            $manager->persist($vendeur);
            $client= new Client();
            $client->setNom('Nom '.$i);
            $client->setPrenom('Prenom '.$i);
            $client->setEmail('Email@frg.de '.$i);            
            if($i==0 || $i==6 || $i==15){
            	$vendeurCurrent=$vendeur;
                $client->setVendeur($vendeurCurrent);
            }
            
            $manager->persist($client);
            $articlevendeur->setVendeur($vendeurCurrent);
            $manager->persist($articlevendeur);
            $commentaire= new Message();
            $commentaire->setDate(new \DateTime("now"));
            $commentaire->setContenu("Contenu ".$i);
            $commentaire->setVisible(1);
            $commentaire->setArticle($articlevendeur);
            $commentaire->setClient($client);
            $manager->persist($commentaire);


        }       

        $manager->flush();
    }
}