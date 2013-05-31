<?php
 
namespace Palabre\UserBundle\Entity;
 
use Palabre\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Palabre\ProjectBundle\Model\Project;

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
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection  
     * 
     * @ORM\ManyToMany(targetEntity="Palabre\ProjectBundle\Entity\Project", mappedBy="users", cascade={"persist"})
     */
    protected $projects;
}