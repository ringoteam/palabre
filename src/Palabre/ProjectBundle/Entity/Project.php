<?php
 
namespace Palabre\UserBundle\Entity;
 
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity(repositoryClass="Palabre\ProjectBundle\Repository\ProjectRepository")
 * @ORM\Table(name="palabre_project")
 */
class Project extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
  
    /**
     * Name
     * 
     * @var string 
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    
    /*
     * @var \Doctrine\Common\Collections\ArrayCollection  
     * 
     * @ORM\ManyToMany(targetEntity="Palabre\UserBundle\Entity\User", inversedBy="projects")
     * @ORM\JoinTable(name="user_project")
     */
    protected $users;
    
}