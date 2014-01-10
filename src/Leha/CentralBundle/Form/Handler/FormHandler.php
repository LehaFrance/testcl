<?php

namespace Leha\CentralBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class FormHandler
{
	protected $request;
	protected $form;
	protected $manager;
	
	public function __construct($manager)
	{
		$this->manager = $manager;
	}
	
	public function process(Request $request, $form)
	{
		$this->form = $form;
		
		if ($request->isMethod('POST')) {
			$form->bindRequest($request);
			$entity = $form->getData();
			
			if ($form->isValid()) {
			
				$this->onSuccess($entity);
				
				return true;
			}
		}
		
		return false;
	}
}