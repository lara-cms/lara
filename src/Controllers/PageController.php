<?php namespace LaraCms\Lara\Controllers;

use App\Page;

use View,Response,Input,Validator;
Use laraCms\Lara\BaseController;

use App\Http\Controllers\Controller;

class PageController extends Controller {

    use BaseController;
    
    protected $url_controller = '/lara/page';
    
    protected $name_controller = 'page';
    
    public function model()
    {
        return new Page();
    }
    
    public function updateModel($model)
    {
        if (Input::has( 'title' ))
        {
            $model->title = Input::get( 'title' );
        }    
        
        if (Input::has( 'url' ))
        {
            $model->url = Input::get( 'url' );
        }
        
        if (Input::has( 'template' ))
        {
            $model->template = Input::get( 'template' );
        }
        
        if (Input::has( 'menu_id' ))
        {
            $model->menu_id = Input::get( 'menu_id' );
        } 
        
        if (Input::has( 'active' ))
        {
            $model->active = Input::get( 'active' );
        }    
        
        if (Input::has( 'content' ))
        {
            $model->content = Input::get( 'content' );
        }
        
        return $model;
    }

    public function validUpdate ()
    {
        return Validator::make(
            array(
                'title' => Input::get('title'),
            ),
            array(
                'title' => 'required',
            )
        );
    }
    
    public function getEdit($var)
    {
        $url_controller = $this->url_controller;
        $model = $this->model()->find($var);
        $inner = view('lara::moduls.'.$this->name_controller.'.form',  compact('url_controller','model'));
        return $this->view(compact(['inner']));
    }
}