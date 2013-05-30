<?php

namespace Palabre\ProjectBundle\Acl;


interface ProjectManagerInterface
{
	/**
	 * Grant a permission
	 * 
	 * @param Project $project The DomainObject to add the permissions for
	 * @param User $user The user that we are revoking the permission for
	 * @param integer|string $mask The initial mask
	 * @return Object The original Entity
	 */
	public function grant(Project $project, User $user, $mask = MaskBuilder::MASK_OWNER);
	
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
	public function revoke(Project $project, User $user, $mask = MaskBuilder::MASK_OWNER);
}