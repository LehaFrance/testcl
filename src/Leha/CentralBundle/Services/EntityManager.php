<?php

namespace Leha\CentralBundle\Services;

class EntityManager
{
	protected $em;
	
	public function __construct($em)
	{
		$this->em = $em;
	}
}