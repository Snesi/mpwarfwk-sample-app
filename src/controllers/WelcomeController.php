<?php
namespace Controllers;

use \MPWAR\Controllers\BaseController;

class WelcomeController extends BaseController
{
	public function index() {
		echo "Hello World";
	}

	public function hello($name) {
		echo "Hello " . $name;
	}
}
