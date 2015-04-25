<?php namespace LaraCms\Lara;

use App\User;

use View,Response,Input,Validator;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Exception\HttpException;

trait BaseController {
    
    //protected $url_controller = '/lara/user';
    
    //protected $name_controller = 'user';


    protected function model()
    {
        return new User();
    }
    
    public function urlController()
    {
        return '/'.Config('lara-cms.lara.master.prefix').'/'.$this->name_controller;
    }
    
    protected function updateModel($model)
    {
        $model->name = Input::get( 'name' );
        $model->email = Input::get( 'email' );
        $model->active = Input::get( 'active' );
        $pass = Input::get( 'password' );
        if (!empty( $pass ))
        {
            $model->password = Input::get( 'password' );
        }
        return $model;
    }

    protected function validUpdate ()
    {
        return Validator::make(
            array(
                'name' => Input::get('name'),
                'password' => Input::get('password'),
                'password_confirmation' => Input::get('password_confirmation'),
                'email' => Input::get('email')
            ),
            array(
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'confirmed'
            )
        );
    }
/*
    protected function view ( array $val = array() )
    {
        return view('lara::layouts.master',$val);
    }
    
    public function getIndex ()
    {
        $url_controller = $this->url_controller;
        $inner = view('lara::moduls.'.$this->name_controller.'.grid',  compact('url_controller'));
        return $this->view(compact(['inner']));
    }
  */
    
    public function getIndex ()
    {
        $url_controller = $this->urlController();
        return view('lara::moduls.'.$this->name_controller.'.layout',compact(['url_controller']));
    }
    
    public function anyGrid ()
    {
        $url_controller = $this->urlController();
        return view('lara::moduls.'.$this->name_controller.'.grid',  compact('url_controller'));
    }
    
    public function postGetlist ()
    {
        $rows = $this->model()->all();
        $url_controller = $this->urlController();
        return view('lara::moduls.'.$this->name_controller.'.grid.getlist',  compact('rows','url_controller'));
    }
    
    public function getEdit ($var)
    {
        $url_controller = $this->url_controller;
        $id = $var;
        $model = $this->model()->find($var);
        return view('lara::moduls.'.$this->name_controller.'.form', compact(['url_controller','id','model']));
    }
    
    public function getFormNew ()
    {
        $url_controller = $this->urlController();
        $id = 0;
        return view('lara::moduls.'.$this->name_controller.'.form.new', compact(['url_controller','id']));
    }

    public function postGetdata ($var = 0)
    {
        if ($var == 0)
        {
            return  response()->json([]);;
        }
        $model = $this->model()->find($var);
        return response()->json($model->toArray());
    }

    public function postUpdate ()
    {
   
        if ($this->validUpdate()->fails())
        {
            return response()->json( [
                'error'  => true,
                'fields' => $this->validUpdate()->errors(),
            ]);
        }
        
        if (Input::has('id'))
        {
            $model = $this->model()->find(Input::get('id'));
        }   
        else
        {
            $model = $this->model();
        }
        
        if ($model)
        {
            $model = $this->updateModel($model);
            
            if (!$model->save())
            {                
                return response()->json( [
                    'error'  => true,
                    'fields' => $model->validator->errors(),
                ] );
            }
        }
        return response()->json($model->toArray());
    }
    
    public function postRemove ($var = 0)
    {
        if (Input::has('id'))
        {
            $model = $this->model()->find(Input::get('id'));
        }   
        else
        {
             $model = $this->model()->find($var);
        }

        $model->delete();
        return response()->json([]);
    }   
}
