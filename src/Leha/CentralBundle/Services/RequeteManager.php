<?php

namespace Leha\CentralBundle\Services;

class RequeteManager extends EntityManager
{
	public function save($requete)
	{
		$this->em->persist($requete);
        $this->em->flush();
		
		return true;
	}
}