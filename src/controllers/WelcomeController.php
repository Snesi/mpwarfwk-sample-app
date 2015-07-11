<?php
namespace Controllers;

use \MPWAR\Controllers\BaseController;
use \MPWAR\Templating\View;

class WelcomeController extends BaseController
{
	public function index() {
		echo "Hello World";
	}

	public function hello($name) {
		return View::make("hello.html", ["name" => $name]);
	}
}
