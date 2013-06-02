<?php
 
namespace Palabre\UserBundle\Model;
 
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Palabre\ProjectBundle\Model\Project;


class User extends BaseUser
{
    protected $firstName;
    
    protected $lastName;

    protected $projects;

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

    public function addProject(Project $project)
    {
        if(!$this->getProjects()->contains($project)) {
            $this->getProjects()->add($project);
        }
    }
    public function getProjects()
    {
        if(!$this->projects) {
            $this->projects = new ArrayCollection();
        }
        return $this->projects;
    }

    public function removeProject(Project $project)
    {
        $this->getProjects()->removeElement($project);
    }

    public function setProjects(ArrayCollection $projects) 
    {
        $this->projects = $projects;
    }

    public function __toString()
    {
        return ucFirst($this->firstName).' '.ucFirst($this->lastName);
    }
}
