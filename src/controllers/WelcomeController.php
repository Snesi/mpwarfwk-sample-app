<?php
namespace controllers;

use \MPWAR\Controllers\BaseController;
use \MPWAR\Response\View;
use \MPWAR\Response\Json;
use \MPWAR\Database\Database;

class WelcomeController extends BaseController
{
    public function index()
    {
        echo "Hello World";
    }

    public function hello($name)
    {
        if($this->request->isJson()) {
            return Json::make(["greeting" => "hello", "receiver" => $name]);
        } else {
            return View::make("hello.html", ["name" => $name]);
        }
    }

    public function dbTest() {
        $db = Database::get("main_db");
        $result = $db->runQuery("select * from city");
        return Json::make($result);
    }
}
