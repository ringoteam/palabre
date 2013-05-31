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
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection  
     * 
     * @ORM\ManyToMany(targetEntity="Palabre\ProjectBundle\Entity\Project", mappedBy="users", cascade={"persist"})
     */
    protected $projects;

    public function __construct(){
        parent::__construct();

    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName(){
        return $this->lastName;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
