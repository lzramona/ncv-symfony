<?php
/**
 * Created by PhpStorm.
 * User: ramona
 * Date: 20.04.2017
 * Time: 22:33
 */

// src/CarBundle/Entity/Ncvuser.php


namespace CarBundle\Entity;

//use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Security\Core\User\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Ncvuser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}