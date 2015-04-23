<?php namespace LaraCms\Lara\Controllers;

use LaraCms\Lara\BaseController;
use App\Http\Controllers\Controller;

class UserController extends Controller {  
    use BaseController;
    
    protected $url_controller = '/lara/user';
    protected $name_controller = 'user';
}
