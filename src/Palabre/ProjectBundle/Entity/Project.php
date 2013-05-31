<?php
 
namespace Palabre\ProjectBundle\Entity;
 
use Palabre\ProjectBundle\Model\Project as BaseProject;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Palabre\ProjectBundle\Repository\ProjectRepository")
 * @ORM\Table(name="palabre_project")
 */
class Project extends BaseProject
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

    /**
     * Description
     * 
     * @var string 
     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
     * @var \Doctrine\Common\Collections\ArrayCollection  
     * 
     * @ORM\ManyToMany(targetEntity="Palabre\UserBundle\Entity\User", inversedBy="projects", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="palabre_project_user")
     */
    protected $users;

    /**
     * CreatedAt
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    
    
}