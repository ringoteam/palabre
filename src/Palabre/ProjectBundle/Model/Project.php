<?php

namespace Palabre\ProjectBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Palabre\UserBundle\Model\User;

abstract class Project
{
    protected $id;
    protected $name;
    protected $description;
    protected $users;
    protected $createdAt;

    public function addUser(User $user)
    {
        if(!$this->getUsers()->contains($user)) {
            $this->getUsers()->add($user);
            $user->addProject($this);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsers()
    {
        if(!$this->users) {
            $this->users = new ArrayCollection();
        }
        return $this->users;
    }

    public function removeUser(User $user)
    {
        $this->getUsers()->removeElement($user);
        $user->removeProject($this);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setUsers(ArrayCollection $users) 
    {
        $this->users = $users;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
