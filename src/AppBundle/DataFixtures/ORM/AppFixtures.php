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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
     /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // create 20 categorie!
        $userManager= $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $encoder =  $this->container->get('security.encoder_factory')->getEncoder($user); 
        for ($i = 0; $i < 60; $i++) {

            //create categorie
            $categorie = new Categorie();
            $categorie->setNom('Categorie '.$i);
            $manager->persist($categorie);   

            //create article    
            $article = new Article();
            $article->setDesignation('Designation '.$i);
            $article->setCategorie($categorie);
            $article->setDescription("Description ".$i);
            $article->setImageurl("image".($i%6).".jpg");
            $manager->persist($article);

            //create articlevendeur
            $articlevendeur = new Articlevendeur();
            $articlevendeur->setArticle($article);
            $articlevendeur->setQuantite(mt_rand(10, 100));
            $articlevendeur->setPayablenfois(0);
            $articlevendeur->setPrix(mt_rand(10, 500));
            
            //create user
            
            $user = $userManager->createUser();
            $user->setEnabled(true);
            $user->setEmail("test$i@test.com");            
            $user->setNom("Nom ".$i);   
            if($i==20)         
                $user->addRole("ROLE_ADMINISTRATEUR");    
            if($i==0 || $i==6 || $i==15){
                $user->addRole("ROLE_VENDEUR");   
            }        
            $user->setPassword($encoder->encodePassword("pass$i", $user->getSalt()));
            

            //create vendeur
            $vendeur= new Vendeur();
            $vendeur->setNomvendeur("vendeur ".$i);
            $manager->persist($vendeur);

            //create client
            $client= new Client();
            $client->setNom('Nom '.$i);
            $client->setPrenom('Prenom '.$i);
            $client->setEmail("test$i@test.com");       
            if($i==0 || $i==6 || $i==15){
            	$vendeurCurrent=$vendeur;
                $client->setVendeur($vendeurCurrent);
            }

            $user->setClient($client);
            $userManager->updateUser($user);
            $manager->persist($client);
            $articlevendeur->setVendeur($vendeurCurrent);
            $manager->persist($articlevendeur);

            //create commentaire
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