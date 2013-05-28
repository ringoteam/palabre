<?php
 
namespace Palabre\UserBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="palabre_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /*
     * @var \Doctrine\Common\Collections\ArrayCollection  
     * 
     * @ORM\ManyToMany(targetEntity="Palabre\ProjectBundle\Entity\Project", inversedBy="users")
     * @ORM\JoinTable(name="user_project")
     */
    protected $projects;
}