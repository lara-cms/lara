<?php namespace LaraCms\Lara\Controllers;

use App\User;

use LaraCms\Lara\BaseController;
use App\Http\Controllers\Controller;

class UserController extends Controller {  
    use BaseController;

    protected $name_controller = 'user';
    
    protected $paginate = false;
    
    protected function model()
    {
        return new User();
    }
}
