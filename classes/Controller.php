<?php
abstract class Controller
{

	protected $action;

	public function __construct($action)
	{

		$this->action = $action;
	}


	protected function returnView($dest)
	{

		// the name of view page will match the method name of the corresponding class

		$view = '/view/' . str_replace('Controller', '', get_class($this)) . '/' . $dest . '.php';

		header('Location: '  . $view);
		exit();
	}
}
