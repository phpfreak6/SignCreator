<?php
namespace App\Http\Controllers\Frontend;

use Auth;
use Datatables;
use App\Models\Job;
use App\Models\Artworkupload;
use App\Models\Install;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobExport;
use Config;
use URL;
use App\Models\Installer;
use Validator;
use App\Models\OtherTask;
use App\Models\ArtworkTemplate;
use App\Models\ArtworkTemplateUser;
use Mail;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use App\Models\File;

class JobsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            // $jobs = Job::where(['user_id'=>(auth()->user()->id),'status'=>'1'])->paginate(2);

            return view('frontend.jobs.index');
        } else {

            if (! session()->has('url.intended')) {
                session([
                    'url.intended' => url()->previous()
                ]);
            }

            return view('auth.login');
        }
    }

    /**
     * download file
     */
    public function download($id, $type)
    {
        $job = Job::where('id', $id)->firstOrFail();
        if ($type == "2") {
            // install pic =2 reference pic =1
            $path = public_path() . $job->install_pic;
        } elseif ($type == "1") {
            $path = public_path() . $job->reference_pic;
        } else {
            $path = public_path();
        }
        return response()->download($path, $job->original_filename, [
            'Content-Type' => $job->mime
        ]);
    }

    /**
     * download other task reference_image
     */
    public function downloadOtherTaskImage($id)
    {
        $other_task = OtherTask::where('id', $id)->firstOrFail();
        $path = public_path() . $other_task->reference_pic;
        return response()->download($path, $other_task->original_filename, [
            'Content-Type' => $other_task->mime
        ]);
    }

    /**
     * download downloadInstallerInstallImage
     */
    public function downloadInstallerInstallImage($id)
    {
        $install_image = Installer::where('id', $id)->firstOrFail();
        $path = public_path() . $install_image->install_image;

        return response()->download($path, $install_image->original_filename, [
            'Content-Type' => $install_image->mime
        ]);
    }

    /**
     * download downloadArtworkImage
     */
    public function downloadArtworkImage($id)
    {
        $artwork = Artworkupload::where('id', $id)->firstOrFail();
        $path = public_path() . $artwork->artwotk_image;
        return response()->download($path, $artwork->original_filename, [
            'Content-Type' => $artwork->mime
        ]);
    }

    public function renderArtwork($id) {

	    $job = Job::where('id', $id)->firstOrFail();
	    $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<style>
html, body {
  margin: 0; padding: 0;
}
</style>
</head>
<body>
{$job->artwork_markup}
</body>
</html>
HTML;

	    return response($html);
    }
	
	/**
     * download downloadArtworkPdf
    */
    public function downloadArtworkPdf($id)
    {
//	    print_r(Config::get('constant.size'));exit();
	    $job = Job::where('id', $id)->firstOrFail();
		$template = ArtworkTemplate::where('id', $job->artwork_template)->firstOrFail();
	    //echo "<pre>"; print_r($template); exit();
		$pdf_height    	=  ($template->pdf_height !='0')? $template->pdf_height: '1842';
		$pdf_width    	=  ($template->pdf_width !='0')?  $template->pdf_width: '1200';
		
	    $url = "http://localhost/jobs/renderArtwork/{$id}";
	    $save_path = "/var/www/html/public/artworks/{$id}/rendered.pdf";
	    $cmd = "C:/Program Files/wkhtmltopdf -B 0mm -L 0mm -R 0mm -T 0mm --page-height {$pdf_height}mm --page-width {$pdf_width}mm --zoom 7 --image-quality 100 {$url} {$save_path}";
	    exec($cmd, $output, $return);
	    

        return response()->download($save_path, $id .'.pdf', [
            'Content-Type' => 'application/pdf'
        ]); 


        //$artwork 	= Job::where('id', $id)->firstOrFail();
        //$path 		= public_path() .'/uploads/artwork-pdf/'. $artwork->artwork_pdf;
        //return response()->download($path, $id.'.pdf', [
        //    'Content-Type' => $artwork->mime
        //]); 
    }

    /**
     * download multiple install pic
     */
    public function downloadFile($id)
    {
		
        $file = File::where('id', $id)->firstOrFail();
        $path = public_path() . $file->file;
        return response()->download($path, $file->original_filename, [
            'Content-Type' => $file->mime
        ]);
    }
	
	/**
     * download complete install pic
     */
    public function downloadInstallFile($id)
    {
		$file = Installer::where('job_id', $id)->firstOrFail();
        $path = public_path() . $file->install_image;
        return response()->download($path, $file->original_filename, [
            'Content-Type' => $file->mime
        ]);
    }
	
	/**
     * download removal complete install pic
     */
    public function removalDownloadFile($id)
    {
        $file = Installer::where(['job_id' => $id, 'type' => '1'])->firstOrFail();
        $path = public_path() . $file->install_image;
        return response()->download($path, $file->original_filename, [
            'Content-Type' => $file->mime
        ]);
    }

    /**
     * Get Jobs with Datatable ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function getJobs(Request $request)
    {
        $users = auth::User()->getRoleNames();
        $user = $users[0];

        if ($user == "installer") {
            // installed(5) and removed jobs(7) filtered out
            $jobs = Installer::where([
                'installer_id' => (auth()->user()->id),
                'installstatus' => null //comment if not working
            ])->with('jobs')
                ->join('jobs', function ($join) {
                $join->on('installers.job_id', '=', 'jobs.id')
                    ->where('jobs.install_status', '!=', 5)
                    ->where('jobs.install_status', '!=', 7);
            })
			->with('jobs.users')
                ->where(function ($q) {
                $q->where('install_date', Carbon::today('+10:00')->toDateString());
                // ->orWhere('created_at', date('Y-m-d'));
            })
                ->get('installers.*') 
                ->toArray();
        /**
         * installed job not display and retrieve repeated data from whereIn
         */
        } else {
            // logged_in_user is admin or user or print
            /**
             * removed job not display
             */
            /* $jobs = Job::where([
                'user_id' => (auth()->user()->id),
                'status' => '1',
                [
                    'install_status',
                    '!=',
                    "7"
                ]
            ])->get(); */
			$jobs = Job::with('users')->with('installers')->Where('user_id', (auth()->user()->id))
                ->where(function ($q) {
                $q->where('install_status', '1')
                    ->orWhere('install_status', '2')
                    ->orWhere('install_status', '3')
                    ->orWhere('install_status', '4')
                    ->orWhere('install_status', '5')
                    ->orWhere('install_status', '6')
                    ->orWhere('install_status', '8')
                    ->orWhere('install_status', '9')
                    ->orWhere('install_status', '10')
                    ->orWhere('install_status', '11');
            })
                ->get();
            $showAll = (! empty($request->input('showAll')) ? ($request->input('showAll')) : (''));

            if ($showAll) {
                $jobs = Job::where([
                    'user_id' => (auth()->user()->id)
                ])->get();
            }
        }
        
        return datatables()->of($jobs)->make(true);
    }

    /**
     * Job Removal
     *
     * @return \Illuminate\Http\Response
     */
    public function jobStatus($id, $action)
    {
        if ($action == 'othertask') {
            $job = Job::findorfail($jobId);

            return view("frontend.jobs.show", compact('job'));
        } else {
            $job = Job::changeStatus($id, $action);
        }
        return redirect('/jobs');
    }
	
	public function changeRemovalStatus(Request $request, $id)
    {
        
        $job = Job::where('id',$id)->update(['install_status' => '6' , 'removal_note' => $request->removal_note]);
        
        return redirect('/jobs');
    }

    public function declineArtwork($token)
    {
        $artwork = Artworkupload::where('token', $token)->first();

        if ($artwork) {
            return view('frontend.jobs.artworkcomment', compact('artwork'));
        } else {
            flash('<i class="fas fa-exclamation-triangle"></i> Your Token Expired !!')->error()->important();
            return redirect('/jobs');
        }
    }

    public function acceptArtwork($token)
    {
        $artwork = Artworkupload::where('token', $token)->first();

        if ($artwork) {
            $artwork->status = '1';
            $artwork->token = null;
            $artwork->save();
            // install_status updated as artwork approved
            Job::where('id', $artwork->job_id)->update([
                'install_status' => '3'
            ]);
            // Mail::send('backend.emails.approvedArtwork', [], function ($message) {
            // $message->to('Jarrod.anderson@smesgroup.com.au')->subject('Artwork Approved');
            // });
            flash('<i class="fas fa-check"></i> Artwork Approved !!')->success()->important();
            return redirect('/jobs');
        } else {
            flash('<i class="fas fa-exclamation-triangle"></i> Your Token Expired !!')->error()->important();
            return redirect('/jobs');
        }
    }

    public function saveComment(Request $request, $token)
    {
        $data = $request->all();
        $artworkUpload = Artworkupload::where('token', $token)->with('jobs')->first();
        $artworkUpload->status = '2';
        $artworkUpload->comment = $data['artwotk_comment'];
        $artworkUpload->token = null;
        $artworkUpload->save();
        flash('<i class="fas fa-check"></i> Your Reason Submitted !!')->success()->important();
        // mail to admin
        Mail::send('backend.emails.declineArtwork', [
            'artworkUpload' => $artworkUpload
        ], function ($message) {
            $message->to('orders@signcreators.com.au')->subject('Artwork Declined');
        });
        if (count(Mail::failures()) > 0) {

            echo "There was one or more failures. They were: <br />";

            foreach (Mail::failures() as $email_address) {
                echo " - $email_address <br />";
            }
        } else {
            echo "No errors, all sent successfully!";
        }

        return redirect('/jobs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user_id 	= auth()->user()->id;
		//$templates = ArtworkTemplate::all();
		$templates = ArtworkTemplateUser::with('artworktemplates')->where('user_id', $user_id)->get();
		//echo "<pre>"; print_r($templates); die;
        return view('frontend.jobs.create', compact('templates'));
    }
	
	/**
     * get all the artwork templates
    */
	public function getTemplates(Request $request)
    {
		$data 	= 	$request->all();
		
		if(isset($data['job_id'])){
		
			$id 		= 	$data['job_id'];
			$template 	= 	Job::where('id', $id)->first();
			echo $template->artwork_markup;
			exit;
			
		}else{
			
			$id 		= $data['template_id'];
			$template 	= ArtworkTemplate::where('id', $id)->first();
			echo $template->template_data;
			exit;
		}
    }
	
	/**
     * Upload artwork editor image
    */
	public function uploadArtworkimg(Request $request)
    {
		 if($request) {
			$file = $request->file('file'); 
			$name = time().'_'.$file->getClientOriginalName();
			$path = '/artwork-uploaded-images/';
			$file->move(public_path() . $path, $name); 
			return response()->json(['location'=> URL::to('/').$path.$name]); 
		} 
    }
	
	/**
     * Upload artwork editor pdf
    */
	public function uploadArtworkpdf(Request $request)
    {
		 if($request) {
			$file = $request->file('pdf_file'); 
			
			$name = time().'.pdf';
			$path = '/uploads/artwork-pdf/';
			$file->move(public_path() . $path, $name); 
			
			if(isset($request->job_id)){
				Job::where('id', $request->job_id)->update([
						'artwork_pdf' => $name
					]);
			}
			return response()->json(['pdfname'=> $name]); 
		} 
    }
	
	
	/**
     * Upload artwork template img
    */
	public function uploadArtworktemp(Request $request)
    {

		 if($request->tempimage) {
			 
			$img = str_replace('data:image/png;base64,', '', $request->tempimage);  
			$img = str_replace(' ', '+', $img);  
			$data = base64_decode($img);  
			$file =  '/artworks/' . uniqid().'_' .time(). '.png';  
			$success = \File::put(public_path().$file, $data);  
			echo $success ? $file : 'Unable to save the file.';
			exit;
			
		} 
    }
	
    /**
     * Listing of all the jobs
    */
    public function list()
    {
        return view('frontend.jobs.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
	
    public function store(StoreJobRequest $request)
    {
        if ($this->validate($request, [
            'terms_conditions' 			=> 'required|in:0',
            'marketting_confirm' 		=> 'required|in:0',
            'installation_statement' 	=> 'required|in:0'
        ], [
            'terms_conditions.in' 		=> 'Terms and Conditions are mandatory',
            'marketting_confirm.in' 	=> 'Marketting Confirm Conditions are mandatory',
            'installation_statement.in' => 'Installation Statement check is mandatory'
        ])) {
            $data = $request->all();
			//echo '<pre>'; print_r($data); die('here');
			$date = Null;
			if( $data['preferred_install_date']){
				$date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['preferred_install_date'])->format('Y-m-d');
			}
            $job = new Job();
		
            $job->install_status 	= "1";
            $job->status 			= "1";
            $job->user_id 			= $data['user_id'];
            $job->suburb 			= $data['suburb'];
            $job->post_code 		= $data['post_code'];
            $job->state 			= $data['state'];
            $job->pro_type 			= $data['pro_type'];
            $job->sign_type 		= $data['sign_type'];
            $job->sign_options 		= $data['sign_options'];
			$job->preferred_install_date = $date;
            $job->size 				= $data['size'];
            $job->orientation 		= $data['orientation'];
            $job->quantity 			= $data['quantity'];
            $job->listing_type 		= $data['listing_type'];
            $job->v_board 			= $data['v_board'];
			$job->flag_holder 		= $data['flag_holder'];
			$job->flag_holders 		= isset($data['flag_holders'])? $data['flag_holders'] : '0';
			$job->artwork_type 		= isset($data['artwork_type'])? $data['artwork_type']: NULL ;
			$job->send_email_to 	= isset($data['send_email_to'])? $data['send_email_to']: NULL ;
			$job->artwork_pdf 		= isset($data['artwork_template_pdf'])? $data['artwork_template_pdf']: NULL ;
			$job->installation_method 	= $data['installation_method'];
			
			
			// if(isset($data['flag_holder'])){
				// $job->flag_holder = $data['flag_holder'];
			// }
            if (! empty($data['agent_nameplate'])) {
                $job->agent_nameplate = $data['agent_nameplate'];
            }
            if (! empty($data['textboard_information'])) {
                $job->textboard_information = $data['textboard_information'];
            }
            $job->overlays = $data['overlays'];
            $job->install_notes = $data['install_notes'];
            $job->terms_conditions = $data['terms_conditions'];
            $job->marketting_confirm = $data['marketting_confirm'];
            $job->latitude = $data['latitude'];
            $job->longitude = $data['longitude'];
            $job->installation_statement = $data['installation_statement'];
			// echo '<pre>'; print_r($job); die('instalqql');
			/*if (! empty($request->file('install_pic'))) {
				$i = 1;
				foreach ($request->file('install_pic') as $key => $value) {
					$i ++;
					$img = new File();
					$name = time() . '_' . $value->getClientOriginalName();
					echo $path = '/installation_pic/' . $job->id; die('kkkk');
					$value->move(public_path() . $path, $name);
					$img->job_id = $job->id;
					$img->type = "1";
					$img->file = $path . '/' . $name;
					echo '<pre>'; print_r($img); die('instalqql');
					$img->save();
					$job->install_pic_check = '1';
				}
			}else{
				die('else install');
				$job->install_pic_check = '0';
			}
			if (! empty($request->file('reference_pic'))) {
				die('reference');
				foreach ($request->file('reference_pic') as $key => $value1) {
							
					$img2 = new File();
					
					$name2 = time() . '_' . $value1->getClientOriginalName();
					$path1 = '/reference_pic/' . $job->id;
					$value1->move(public_path() . $path1, $name2);
					$img2->job_id = $job->id;
					$img2->type = "2";
					$img2->file = $path1 . '/' . $name2;
					$img2->save();
					$job->reference_pic_check = '1';
				}
			}else{
				die('else reference');
				$job->reference_pic_check = '0';
			}*/
			// echo '<pre>'; print_r($data); die;
            if (! empty($data['install_pic_check'])) {
                $job->install_pic_check = $data['install_pic_check'];
            }
            if (! empty($data['reference_pic_check'])) {
                $job->reference_pic_check = $data['reference_pic_check'];
            }
			// echo '<pre>'; print_r($job); 
			// echo '**************DATA************************'; print_r($data); die('there');
			
			$job->pro_address 		= 	$data['pro_address'];
            $job->save();
			
			if(isset($data['artwork_type'])){
				
				if($data['artwork_type'] == '3' && isset($data['artwork_template_img'])){
					
					if (!is_dir(public_path().'/artworks/' . $job->id)) {
						mkdir(public_path().'/artworks/' . $job->id);
					}
		
					$img 		= str_replace('data:image/png;base64,', '', $data['artwork_template_img']);  
					$img 		= str_replace(' ', '+', $img);  
					$imgdata 	= base64_decode($img);  
					$filepath 	=  '/artworks/'. $job->id .'/'. uniqid().'_' .time(). '.png';  
					$success = \File::put(public_path().$filepath, $imgdata);
					
					if ($success){
						   
						$job->artwork_template 		= $data['artwork_template'];					
						$job->artwork_markup 		= $data['artwork_template_markup'];					
						
						$create = new Artworkupload();
						$create->job_id 		= $job->id;
						$create->artwotk_image 	= $filepath;
						$create->when = '0';
						$create->save();
					}
					
					$job->install_status        = isset($data['artwork_ready_checkbox']) ? "3" : "2";         // 3=>artwork Approved  2=>artwork created
					
					$job->artwork_required 		= "2";     
				
				
				}elseif($data['artwork_type'] == '2'){
					
					$job->install_status 		= "3";               	 //Artwork Approved
					$job->artwork_required 		= "2";  
						
					
				}elseif($data['artwork_type'] == '1'){
					
					$job->install_status 		= "3";               	 //Artwork not required
					$job->artwork_required 		= "1";  
					
				}
				 
			}

            if (! empty($request->file('install_pic'))) {
                if ($job->install_pic_check == '1') {
                    // $i = 1;
                    foreach ($request->file('install_pic') as $key => $value) {
                        // $i ++;
                        $img = new File();
                        $name = time() . '_' . $value->getClientOriginalName();
                        $path = '/installation_pic/' . $job->id;
                        $value->move(public_path() . $path, $name);
                        $img->job_id = $job->id;
                        $img->type = "1";
                        $img->file = $path . '/' . $name;
                        $img->save();
                    }
                }
            } else {
                $job->install_pic_check = '0';
            }
			
            if (! empty($request->file('reference_pic'))) {
                if ($job->reference_pic_check == '1') {
                    // $img = Job::find($job->id);
                    // $file = $request->file('reference_pic');
                    // $name = time() . '_' . $file->getClientOriginalName();
                    // $path = '/reference_pic/' . $job->id;
                    // $file->move(public_path() . $path, $name);
                    // $img->reference_pic = $path . '/' . $name;
                    // $img->save();
					
                    foreach ($request->file('reference_pic') as $key => $value1) {
						
						$img2 = new File();
						
						$name2 = time() . '_' . $value1->getClientOriginalName();
						$path1 = '/reference_pic/' . $job->id;
						$value1->move(public_path() . $path1, $name2);
						$img2->job_id = $job->id;
                        $img2->type = "2";
                        $img2->file = $path1 . '/' . $name2;
						$img2->save();
					}
					
                }
            } else {
                $job->reference_pic_check = '0';
            }
			// echo '<pre>'; print_r($job); 
			// echo '**************DATA************************'; print_r($data); die('there');
            if ($job->save()) {
				
                return redirect('/jobs');
            }
        }
    }
	
	/**
     * Save crop artwork images
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
	
    public function artworkCropimg(Request $request)
    {
		$img 		= str_replace('data:image/png;base64,', '', $request->image);  
		$img 		= str_replace(' ', '+', $img);  
		$imgdata 	= base64_decode($img);  
		$filepath 	=  '/artwork-uploaded-images/'. uniqid().'_' .time(). '.png';  
		$success = \File::put(public_path().$filepath, $imgdata);
		if($success){
			echo  URL::to('/').$filepath ;
			exit;
		}
		
	}
	
	/**
     * Update artwork template
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
	
    public function updateArtworktemp(Request $request)
    {
		$data = $request->all();
		if($data['job_id']){
			$job = Job::find($data['job_id']);
			$job->artwork_markup = $data['template_markup'];
			$job->save();
			
			$artwotk_image 	= Artworkupload::where('job_id', $data['job_id'])->value('artwotk_image');
			if($artwotk_image){
				$filepath 		= $artwotk_image;
				$img 			= str_replace('data:image/png;base64,', '', $data['dataURL']);  
				$img 			= str_replace(' ', '+', $img);  
				$imgdata 		= base64_decode($img);   
				$success 		= \File::put(public_path().$filepath, $imgdata);
			}
			exit;
		}
					
	}
	
	/**
     * Update artwork approved status
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
	
    public function approveArtwork(Request $request)
    {
		$data = $request->all();
		if($data['job_id']){
			$job = Job::find($data['job_id']);
			$job->install_status = ($data['approve'])? '3' : '2';
			$job->save();
			exit;
		}
		
	}

    /**
     * Display the specified resource.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function show($jobId)
    {
        $users 	= auth::User()->getRoleNames();
        $user_type 	= $users[0];

        if ($user_type == "installer") {
            // $jobId is the installer table id in this case
            $job = Installer::where('id', $jobId)->with('jobs')->with('jobs.users')->first();
        } else {
            $job = Job::findorfail($jobId);
        }

        return view("frontend.jobs.show", compact('job','user_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view("frontend.jobs.edit", compact('job'));
    }

    /**
     * Show the form for Other job specified resource.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function otherJob($id)
    {
        $job = Job::findorfail($id);
        return view("frontend.jobs.other", compact('job'));
    }

    /**
     * Create Other job specified resource.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function otherTask(Request $request)
    {
        $data = $request->all();
        // job (install status update)
        if (! empty($data['job_id'])) {
            Job::where('id', $data['job_id'])->update([
                'install_status' => '8'
            ]);
        }
        // other task save
        $otherTask = new OtherTask();
        $otherTask->job_id = $data['job_id'];
        $otherTask->notes = $data['notes'];
        $otherTask->task_id = $data['task_id'];
        if ($request->hasFile('reference_pic_other_task')) {
            $file = $request->file('reference_pic_other_task');
            $name = time() . '_' . $file->getClientOriginalName();
            $path = '/reference_pic_other_task/' . $data['job_id'];
            $file->move(public_path() . $path, $name);
            $otherTask->reference_pic = $path . '/' . $name;
        }

        if ($otherTask->save()) {
            return redirect('/jobs');
        }
    }

    public function exportData()
    {
        return Excel::download(new JobExport(), 'jobs.csv');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobRequest $request, $jobId)
    {
        $job = Job::findorfail($jobId);
        if ($job) {
            $data = $request->all();
			$date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['preferred_install_date'])->format('Y-m-d');
            $data['terms_conditions'] = isset($data['terms_conditions']) ? $data['terms_conditions'] : NULL;
            $data['marketting_confirm'] = isset($data['marketting_confirm']) ? $data['marketting_confirm'] : NULL;
            $data['install_pic_check'] = isset($data['install_pic_check']) ? $data['install_pic_check'] : NULL;
            $data['terms_conditions_2'] = isset($data['terms_conditions_2']) ? $data['terms_conditions_2'] : NULL;
            $data['marketting_conditions'] = isset($data['marketting_conditions']) ? $data['marketting_conditions'] : NULL;
            $data['anti_grafiti_lamin'] = isset($data['anti_grafiti_lamin']) ? $data['anti_grafiti_lamin'] : NULL;
            $data['solor_spot'] = isset($data['solor_spot']) ? $data['solor_spot'] : NULL;
			$data['preferred_install_date'] = isset($date) ? $date : NULL;
            $job->update($data);
            if ($job->update($data)) {
                return redirect('/jobs/' . $jobId);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    /**
     * Install Complete by installer
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function installComplete(Request $request)
    {
        $data = $request->all();

        if (! empty($data['task_id'])) {
            $install = Installer::where([
                'job_id' => $data['job_id'],
                'installer_id' => auth()->user()->id,
                'other_task_id' => $data['task_id'],
                'type' => $data['install_type']
            ])->first();
        } else {
            $install = Installer::where([
                'job_id' => $data['job_id'],
                'installer_id' => auth()->user()->id,
                'type' => $data['install_type']
            ])->first();
        }

        if ($data['install_type'] == "0") {
            // update job install status again installed
            if (! empty($data['job_id'])) {
                Job::where('id', $data['job_id'])->update([
                    'install_status' => '5'
                ]);
            }
        } else {
            // update job install status removed
            Job::where('id', $data['job_id'])->update([
                'install_status' => '7'
            ]);
        }
        // mark task as completed
        if (! empty($data['task_id'])) {
            OtherTask::where([
                'id' => $data['task_id'],
                'job_id' => $data['job_id']
            ])->update([
                'status' => '1'
            ]);
        }
        if ($request->hasFile('install_image')) {
            $file = $request->file('install_image');
            $name = time() . '_' . $file->getClientOriginalName();
            $path = '/install_image/' . $data['job_id'];
            $file->move(public_path() . $path, $name);
            $install->install_image = $path . '/' . $name;
        }

        // mark task completed date(current)
        if (! empty(($data['task_id']))) {
            $install->other_task_completed_date = date('Y-m-d');
        } else {
            $install->install_complete_date = date('Y-m-d');
        }
        $install->installstatus = "1";
        if ($install->save()) {

            if (empty(($data['task_id']))) {
                // install complete mail excluding other tasks
                if (! empty($data['job_id'])) {
                    $job = Job::where('id', $data['job_id'])->with('users')->first();

                    if ($data['install_type'] == "0") {
                        // install complete mail
						
						if($job->send_email_to){
							
							Mail::send('backend.emails.installComplete', [
								'job' => $job,
								'install' => $install
							], function ($message) use ($job) {
								$message->to($job->users->email)
								->cc([$job->send_email_to])->
								subject("Installation Completed");
							});

						}else{
							
							Mail::send('backend.emails.installComplete', [
								'job' => $job,
								'install' => $install
							], function ($message) use ($job) {
								$message->to($job->users->email)->subject("Installation Completed");
							});
						}
                    } else {
                        // removal complete mail
                        Mail::send('backend.emails.removalComplete', [
                            'job' => $job,
                            'install' => $install
                        ], function ($message) use ($job) {
                            $message->to($job->users->email)->subject("Removal Completed");
                        });
                    }
                }
            } else {
                if (! empty($data['job_id'])) {
                    $job = Job::where('id', $data['job_id'])->with('users')->first();
                    $otherTask = OtherTask::where([
                        'id' => $data['task_id'],
                        'job_id' => $data['job_id']
                    ])->first();
                    // otherTask complete mail
                    Mail::send('backend.emails.otherTaskComplete', [
                        'job' => $job,
                        'install' => $install,
                        'otherTask' => $otherTask
                    ], function ($message) use ($job) {
                        $message->to($job->users->email)->subject("Task Completed");
                    });
                }
            }
            return redirect('/jobs');
        }
    }

    /**
     * Install Not Complete by installer
     */
    public function installNotComplete(Request $request)
    {
        $data = $request->all();

        if (! empty($data['task_id'])) {
            $install = Installer::where([
                'job_id' => $data['job_id'],
                'installer_id' => auth()->user()->id,
                'other_task_id' => $data['task_id'],
                'type' => $data['install_type']
            ])->first();
        } else {
            $install = Installer::where([
                'job_id' => $data['job_id'],
                'installer_id' => auth()->user()->id,
                'type' => $data['install_type']
            ])->first();
        }

        if (! empty($data['job_id'])) {
            // update job install status as not installed
            if ($data['install_type'] == "0") {
                Job::where('id', $data['job_id'])->update([
                    'install_status' => '9'
                ]);
            } else {
                // update job install status as not removed
                Job::where('id', $data['job_id'])->update([
                    'install_status' => '11'
                ]);
            }
        }
        // mark task as not completed
        if (! empty($data['task_id'])) {
            OtherTask::where([
                'id' => $data['task_id'],
                'job_id' => $data['job_id']
            ])->update([
                'status' => '2'
            ]);
			// $job = Job::where('id', $data['job_id'])->update([
                    // 'install_status' => '9'
			// ]);
			$job = Job::where('id', $data['job_id'])->with('users')->first();
			$instll_not = $data['not_complete_reason'];
			Mail::send('backend.emails.installNtComplete', [
				'job' => $job,
				'reason' => $instll_not,
			], function ($message) use ($instll_not) {
				$message->to('order@signcreators.com.au')->subject("Installation Not Completed");
			});
		}
        $install->not_complete_reason = $data['not_complete_reason'];
        $install->installstatus = "0";
        if ($install->save()) {
            return redirect('/jobs');
        }
    }

    /**
     * Csv old data deploy
     */
    public function uploadFile(Request $request)
    {
        $result = "";
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        // Valid File Extensions
        $valid_extension = array(
            "csv"
        );

        // 2MB in Bytes
        $maxFileSize = 2097152;

        if (in_array(strtolower($extension), $valid_extension)) {

            if ($fileSize <= $maxFileSize) {

                $location = 'uploads';

                $file->move($location, $filename);
                $filepath = public_path($location . "/" . $filename);
                // Import CSV to Database
                $jobs = Job::csvToArray($filepath);

                foreach ($jobs as $value) {
                    $name = $value['name'];
                    $id = Job::UserIds($name);
                    if (! empty($id)) {
                        $j = new Job();
                        $j->id = $value['id'];
                        $j->pro_address = $value['pro_address'];
                        $j->install_status = "5";
                        $j->user_id = $id;
                        $j->status = "1";
                        $j->install_pic_check = '0';
                        $j->save();
                    }
                }
                $result = "1";
            }
        }
        if ($result == 1) {

            flash('<i class="fas fa-check"></i> Jobs imported successfully')->success()->important();

            return redirect()->back();
        } else {

            flash('<i class="fas fa-times"></i> Please try again with correct format')->error()->important();

            return redirect()->back();
        }
    }
}
