<?php namespace LaraCms\Lara\Controllers;

use App\Menu;

use Baum\Node;

use View,Response,Input,Validator;

Use laraCms\Lara\BaseController;
use App\Http\Controllers\Controller;

class MenuController extends Controller {

    use BaseController;      
    
    protected $url_controller = '/lara/menu';
    
    protected $name_controller = 'menu';
    
    public function model()
    {
        return new Menu();
    }
    
    public function updateModel($model)
    {
        
        $get = Input::all();
        if (isset($get['title']))
        {
            $model->title = Input::get( 'title' );
        }    
        
        if (isset($get['url']))
        {
            $model->url = Input::get( 'url' );
        }
        
        if (isset($get['page_id']))
        {
            $model->page_id = Input::get( 'page_id' );
        }
        
        if (isset($get['active']))
        {
            $model->active = Input::get( 'active' );
        }    
        
        return $model;
    }

    public function validUpdate ()
    {
        return Validator::make(array(),array(),array());
    }
    
    public function getEdit($var)
    {

        $url_controller = $this->url_controller;
        $model = $this->model()->find($var);
        $id = $model->id;
        return view('lara::moduls.'.$this->name_controller.'.form',  compact('url_controller','model','id'));
    }
    
    public function postUpdate ()
    {
        if (Input::has('id'))
        {
            $model = $this->model()->find(Input::get('id'));
            if ($model) 
            {
                $this->updateModel($model);
                $model->save();
                return response()->json($model->toArray());
            }
        }   
        else
        {
            $model = $this->model()->create(Input::all());
            $model->save();
            return response()->json($model->toArray());
        }
    }

    public function getIndex ()
    {
        return $this->getParent(0);
    }
    
    public function getParent ($parent_id = 0)
    {
        $url_controller = $this->url_controller;
        $inner = view('lara::moduls.'.$this->name_controller.'.grid',  compact('url_controller','parent_id'));
        return $this->view(compact(['inner']));
    }
    
    public function postGetlist ($parent_id = null)
    {
        $parent_id = ($parent_id == 0) ? null : $parent_id;
        
        $parent = $this->model()->find($parent_id);
        $parent_up = ($parent and $parent->parent_id) ? $parent->parent_id : 0 ;
        //$rows = $this->model()->where(['parent_id'=>$parent_id])->get();
        //$rows = $this->model()->all();
        
        if ($parent_id)
        {
            if ($parent)
            {
                $rows = $parent->children()->get();
            }
            
        }
        else
        {
            $rows = $this->model()->roots()->get();
        }
        
        
        
 
        $r = [];
        
        foreach($rows as $val)
        {   
            $arr = $val->toArray();
            $arr['_sunc_page'] = ($val->page and ($val->id == $val->page->menu_id)) ? true : false ;
            $r[] = $arr;
        }

        return response()->json(['rows'=>$r,'parent_up'=>$parent_up]);
        //$url_controller = $this->url_controller;
        //return view('lara::moduls.'.$this->name_controller.'.grid.getlist',  compact('rows','url_controller'));
    }
    
    public function postDnd()
    {
        if (Input::get('target') == 0)
        {
            $source = $this->model()->find(Input::get('source'));
            $source->makeRoot();
        }
        else
        {
            $target = $this->model()->find(Input::get('target'));
            $source = $this->model()->find(Input::get('source'));

            if (Input::get('point') == 'append')
            {
                $source->makeChildOf($target);
            }
            elseif(Input::get('point') == 'top')
            {

                $source->moveToLeftOf($target);
            }
            elseif(Input::get('point') == 'bottom')
            {
                $source->moveToRightOf($target);

            }
        }
        /*
        $model = CatalogCategory::all();
        $rows = $model->toArray();
        return response()->json(['rows' => $rows, 'total' => sizeof($rows)]);
        */
        
        return response()->json([]);
         
    }
}
