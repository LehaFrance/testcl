<?php

namespace Leha\HistoriqueBundle\Services;

class EntityManager
{
	protected $em;
	
	public function __construct($em)
	{
		$this->em = $em;
	}
}