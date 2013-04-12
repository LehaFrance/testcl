<?php

namespace Leha\HistoriqueBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class RechercheHandler
{
	protected $request;
	protected $form;
	
	public function __construct(Form $form, Request $request)
	{
		$this->form = $form;
		$this->request = $request;
	}
	
	public function process()
	{
		if ($this->request->getMethod() == 'POST') {
			$this->form->bindRequest($this->request);
		}
	}
	
	public function onSuccess()
	{
	
	}
}