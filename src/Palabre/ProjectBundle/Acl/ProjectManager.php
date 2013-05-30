<?php

namespace Palabre\ProjectBundle\Acl;

use Palabre\ProjectBundle\Model\Project;
use Fos\UserBundle\Model\User;

use Symfony\Component\Security\Acl\Domain\Entry;
use Symfony\Component\Security\Acl\Domain\Acl;
use Symfony\Component\Security\Acl\Dbal\MutableAclProvider;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Acl\Model\AclProviderInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class ProjectManager implements ProjectManagerInterface
{
	protected $provider;
	
	/**
     * Constructor
     * 
     * @param AclProviderInterface $provider
     */
	public function __construct(AclProviderInterface $provider) 
	{
		$this->provider = $provider;		
	}
	
	/**
     * Grant a permission
     * 
     * @param Project $project The DomainObject to add the permissions for
     * @param User $user The user that we are revoking the permission for
     * @param integer|string $mask The initial mask
     * @return Object The original Entity
     */
	public function grant(Project $project, User $user, $mask = MaskBuilder::MASK_OWNER) 
	{
		$acl = $this->getAcl($project);
		
		$securityIdentity = UserSecurityIdentity::fromAccount($user);
		
		// grant owner access 
		$this->addMask($securityIdentity, $mask, $acl);
		
		return $project;
	}
	
	/**
     * Revoke a permission
     * 
     * <pre>
     *     $manager->revoke($myDomainObject, 'delete'); // Remove "delete" permission for the $myDomainObject
     * </pre>
     * 
     * @param Project $project The DomainObject that we are revoking the permission for
     * @param User $user The user that we are revoking the permission for
     * @param int|string $mask The mask to revoke
     * 
     * @return \ApplicationBundle\Security\Manager Reference to $this for fluent interface
     */
	public function revoke(Project $project, User $user, $mask = MaskBuilder::MASK_OWNER) {
		$acl = $this->getAcl($entity);
		$aces = $acl->getObjectAces();
		
		$securityIdentity = UserSecurityIdentity::fromAccount($user);
		
		foreach($aces as $i => $ace) {
			if($securityIdentity->equals($ace->getSecurityIdentity())) {
				$this->revokeMask($i, $acl, $ace, $mask);
			}
		}
		
		$this->provider->updateAcl($acl);
		
		return $this;
	}

	/**
     * Get or create an ACL object
     * 
     * @param object $entity The Domain Object to get the ACL for
     * 
     * @return Acl The found / created ACL
     */
	protected function getAcl(Project $project) 
	{
		// creating the ACL
		$aclProvider = $this->provider;
		$objectIdentity = ObjectIdentity::fromDomainObject($project);
		try {
			$acl = $aclProvider->createAcl($objectIdentity);
		}catch(\Exception $e) {
			$acl = $aclProvider->findAcl($objectIdentity);
		}
		
		return $acl;
	}
	
	
	/**
     * Remove a mask
     * 
     * @param Acl $acl The ACL to update
     * @param Entry $ace The ACE to remove the mask from
     * @param unknown_type $mask The mask to remove
     * 
     * @return \Palabre\ProjectBundle\Acl\ProjectManager Reference to $this for fluent interface
     */
	protected function revokeMask($index, Acl $acl, Entry $ace, $mask) {
		$acl->updateObjectAce($index, $ace->getMask() & ~$mask);
		
		return $this;
	}
	
	/**
     * Add a mask
     * 
     * @param SecurityIdentityInterface $securityIdentity The ACE to add
     * @param integer|string $mask The initial mask to set
     * @param ACL $acl The ACL to update
     * 
     * @return \Palabre\ProjectBundle\Acl\ProjectManager Reference to $this for fluent interface
     */
	protected function addMask($securityIdentity, $mask, $acl) {
		$acl->insertObjectAce($securityIdentity, $mask);
		$this->provider->updateAcl($acl);
		
		return $this;
	}
}