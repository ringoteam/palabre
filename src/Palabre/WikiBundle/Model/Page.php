<?php

namespace Palabre\WikiBundle\Model;

use FOS\UserBundle\Model\User;

abstract class Page {
	protected $id;
	protected $title;
	protected $descrtiption;
	protected $pagetext;
	protected $owner;
	protected $createdAt;

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getDescription() {
		return $this->descrtiption;
	}

	public function getPageText() {
		return $this->pagetext;
	}

	public function getOwner() {
		return $this->owner;
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setTitle($title)  {
		$this->title = $title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setPageText($pageText) {
		$this->pageText = $pagetext;
	}

	public function setOwner(User $user) {
		$this->owner = $user;
	}

}