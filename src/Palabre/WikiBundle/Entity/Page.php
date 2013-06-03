<?php

namespace Palabre\WikiBundle\Entity;

use Palabre\WikiBundle\Model\Page as BasePage;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Palabre\WikiBundle\Repository\PageRepository")
 * @ORM\Table(name="palabre_wiki_page")
 */
class Page extends BasePage {

	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
  
    /**
     * Title
     * 
     * @var string 
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * Description
     * 
     * @var string 
     * @ORM\Column(type="text")
     */
    protected $description;
    
     /**
     * PageText
     * 
     * @var string 
     * @ORM\Column(type="text")
     */
    protected $pageText;

    /**
     * @var Palabre\UserBundle\Entity\User  
     * 
     * @ORM\OneToOne(targetEntity="Palabre\UserBundle\Entity\User", cascade={"persist"})
     */
    protected $owner;

    /**
     * CreatedAt
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;
}