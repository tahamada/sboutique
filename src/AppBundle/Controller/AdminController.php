<?php

namespace AppBundle\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
     public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function prePersistEntity($articlevendeur)
    {
    	if(get_class ($articlevendeur)=="AppBundle\Entity\Articlevendeur"){
    		$articlevendeur->setVendeur($this->getUser()->getClient()->getVendeur());
    	}    	
    	
    }
}