<?php namespace LaraCms\Lara\Controllers;

use Request,Storage,Input;

use LaraCms\Lara\BaseController;
use App\Http\Controllers\Controller;

class FilesController extends Controller {  

    protected $name_controller = 'files';
    
    protected $upload_path = 'upload';

    public function urlController()
    {
        return '/'.Config('lara-cms.lara.master.prefix').'/'.$this->name_controller;
    }

    public function getIndex()
    {
        $url_controller = $this->urlController();
        $get_inner = 'upload';
        return view('lara::moduls.'.$this->name_controller.'.layout',compact(['url_controller','get_inner']));

    }
    
    public function getUpload()
    {
        $url_controller = $this->urlController();
        return view('lara::moduls.'.$this->name_controller.'.form..upload',compact(['url_controller']));
    }
    
    public function postUpload()
    {
        $allowed = array('png', 'jpg', 'gif','zip');
        
        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
                return '{"status":"error"}';
            }
            
            if (file_exists(base_path('/public/image/'.$_FILES['upl']['name']))){
               return '{"status":"error"}';                 
            }
            
            if(Request::file('upl')->move(public_path($this->upload_path),$_FILES['upl']['name'])){
                return '{"status":"success"}';
            }
        }
        
        return '{"status":"error"}';
    }
    
    public function getManager()
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
        $files = Storage::disk('public')->files('upload');
        
        $rows = [];
        foreach ($files as $key=>$val)
        {
            $rows[] = ['id'=>$key,'name'=>$val,'url'=>$val];
        }
        
        return response()->json(['rows'=>$rows]);
    }
    
    public function postRemove ($var = 0)
    {
        if (Input::has('name'))
        {
            Storage::disk('public')->delete(Input::get('name'));
         }   
        else
        {
            Storage::disk('public')->delete($var);
        }
        return response()->json([]);
    }  
    
    public function getFormNew ($var = 0)
    {
        $url_controller = $this->urlController();
        return view('lara::moduls.'.$this->name_controller.'.form.upload',compact(['url_controller']));
    }  
}
