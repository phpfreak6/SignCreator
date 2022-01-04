<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ArtworkTemplate;
use App\Models\User;
use App\Models\ArtworkTemplateUser;
use Auth;
use Illuminate\Http\Request;
use Log;
// use Yajra\DataTables\DataTables;


class ArtworkController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Artwork Templates';

        // module name
        $this->module_name = 'artwork';

        // directory path of the module
        $this->module_path = 'artwork';

        // module icon
        $this->module_icon = 'fas fa-paint-brush';

        // module model name, path
        $this->module_model = "App\Models\ArtworkTemplate";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = str_singular($module_name);

        $module_action = 'List';

        $templates = $module_model::get();

        //Log::info(label_case($module_title.' '.$module_action).' | User:'.Auth::user()->name.'(ID:'.Auth::user()->id.')');
		
		//echo "<pre>"; print_r($module_name); die;
		
        return view("backend.$module_path.index",
        compact('module_title', 'module_name', "templates", 'module_path', 'module_icon', 'module_action', 'module_name_singular'));
    }

    public function store(Request $request)
    {
		$data 	= $request->all();
        $update = ArtworkTemplate::where('id', $data['id'])->update([
									'nickname' 		=> $data['nickname'], 
									'name' 			=> $data['name'],
									'pdf_width' 	=> $data['pdf_width'],
									'pdf_height'	=> $data['pdf_height'],
									'template_width'=> $data['template_width']
								]); 
        if($update){
			return redirect('/admin/artwork')->with('status', 'Template has been updated.');
		}
       
    }
	
	public function artwork_templates()
    {
        $module_title 	= $this->module_title;
        $module_name 	= $this->module_name;
        $module_path 	= $this->module_path;
        $module_icon 	= $this->module_icon;
        $module_model 	= $this->module_model;
        $module_name_singular = str_singular($module_name);

        $module_action = 'List';

        $module_name = $module_model::select('id', 'nickname', 'name', 'pdf_width', 'pdf_height', 'template_width');

        $data = $module_name;

        return datatables()->of($module_name)->rawColumns([
            'action'
        ])
		 ->editColumn('action', function ($data) {
			 
            return '<a href="javascript:void(0)" class="btn btn-success btn-sm load_template_users" data-tempid ="'.$data->id.'" data-tempname ="'.$data->name.'">Assign User</a>
			<a href="/admin/artwork/edit-template/'.$data->id.'" class="btn btn-primary btn-sm">Edit</a>';
        })
        ->make(true);
			
    }
	public function edit_template($id)
    {
		$module_title = $this->module_title;
        $module_name  = $this->module_name;
        $module_path  = $this->module_path;
        $module_icon  = $this->module_icon;
        $module_model = $this->module_model;

        $module_action = 'Edit';
		$artwork = ArtworkTemplate::findorfail($id);
		return view("backend.$module_path.edit",
        compact('module_title', 'module_name', 'artwork' , 'module_path', 'module_icon', 'module_action'));
			
    }
	
	function get_artworktemp(Request $request){
		$data 	= $request->all();
		$users = User::whereHas(
			'roles', function($q){
				$q->where('name', 'user');
			}
		)->get()->toArray(); 
		$template_users = ArtworkTemplateUser::where('template_id', $data['template_id'])->get()->toArray();
		
		foreach($template_users as $template_user){
			$template_users[]  = $template_user['user_id'];
		}
		
		$html = "";
		foreach($users as $user){
			$checked = "";
			if (in_array($user['id'], $template_users)){
				$checked = "checked";
			}
			
			$html.= '<div class="checkbox col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<label for="userid-'.$user['id'].'"><input type="checkbox" name="user['.$user['id'].']" id="userid-'.$user['id'].'" value="'.$user['id'].'" '.$checked.'>  '.$user['name'].'</label>
					</div>';
			
		}
		echo $html;
		exit;
	}
	
	
	function assign_artworktemp(Request $request){
		$data 			= $request->all();
		$template_id 	= $data['template_id'];
		
		$assgined 	= ArtworkTemplateUser::where('template_id', $template_id)->delete();
		
		if(isset($data['user'])){
			
		
			foreach($data['user'] as $user){
				
				$user_id 	=  $user;
				
				$ArtworkTemp = new ArtworkTemplateUser();
				$ArtworkTemp->template_id 		= $template_id;
				$ArtworkTemp->user_id 			= $user_id;
				$ArtworkTemp->save();

			}
			
		}
		
	}
	
	
}
