<?php namespace LaraCms\Lara;

use App\User;

use View,Response,Input,Validator;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Exception\HttpException;

trait BaseController {
    
    //protected $name_controller = 'user';
    //protected $paginate = false;

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
    
    public function query($model)
    {
        return $model->get();
    }
    
    public function toArray($model)
    {
        return $model->toArray();
    }
    
    public function postGetlist ()
    {
        $model = $this->model();
        $rows = $this->query($model);
        $r = [];
        foreach($rows as $val)
        {   
            $r[] = $this->toArray($val);
        }
        
        if ($rows and $this->paginate) {
            $paginate = [];
            
            $pages = ceil( $rows->total() / 10 );

            for ($i=1; $i<=$pages;$i++)
            {
                $paginate[] = array(
                    'number' => $i,
                    'url' => $i,
                    'active' => ($i == $rows->currentPage()) ? true : false,
                );

            }
        }
        else
        {
            $paginate = false;
        }
        
        return response()->json(['rows'=>$r,'paginate'=>$paginate]);
    }
    
    public function getEdit ($var)
    {
        $url_controller = $this->urlController();
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
    
    public function makeQueryFromInput($input) 
    {
        $r = [];
        foreach ($input as $val)
        {
            if (!empty($val['value']))
            {
                $r[$val['name']] = $val['value'];
            }
        }
        return $r;
    }
}
