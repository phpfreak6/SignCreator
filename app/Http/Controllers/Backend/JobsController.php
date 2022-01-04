<?php
namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\Job;
use App\Models\Install;
use App\Models\Artworkupload;
use App\Models\Installer;
use App\Models\User;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Validator;
use App\Models\OtherTask;
use Carbon\Carbon;
use App\Models\File;

class JobsController extends Controller
{

    public function testEmailTemplate()
    {
        return view('backend.emails.artworktoclient');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
			// module name			
			$module_name = 'Job';			
			$module_title = 'Create';			
			$module_action = 'Create';			
			// directory path of the module			
			$module_path = 'jobs';			
			// module icon			
			$module_icon = 'fas fa-briefcase';
			$roles = '';
			$permissions = '';
            return view('backend.jobs.index', compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'roles', 'permissions'));
        } else {

            if (! session()->has('url.intended')) {
                session([
                    'url.intended' => url()->previous()
                ]);
            }

            return view('auth.login');
        }
    }

    public function reporting()
    {
        return view('backend.jobs.index');
    }

    public function priority()
    {
        return view('backend.jobs.priority');
    }

    public function setPriority(Request $request)
    {
        $i = 0;

        if ($_POST['position']) {
            foreach ($_POST['position'] as $id) {
                $i ++;
                $item = Installer::find($id);
                $item->position = $i;
                $item->save();
            }
            return response()->json(array(
                'success' => 'true'
            ));
        } else {
            return response()->json(array(
                'success' => 'false'
            ));
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
			
			//$path = public_path() . $job->reference_pic;
			$file = File::where('job_id', $id)->where(['type' => 2])->firstOrFail();        //reference pic is stored in file table
            $path = public_path() . $file->file;
            
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
     * Othertask download complete install pic
     */
    public function taskDownloadFile($taskid)
    {
        $file = Installer::where(['other_task_id' => $taskid, 'installstatus' => '1'])->firstOrFail();
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
    public function getAlljob(Request $request)
    {
        $status = (! empty($request->input('installstatus'))) ? ($request->input('installstatus')) : ('');

        $users = auth::User()->getRoleNames();
        $user = $users[0];
        if ($user == "print") {
            /**
             * only artwork approved jobs
             */

            $jobs = Job::where([
                'install_status' => '3'
            ])->with('users')
                ->with('installers')
                ->get();
        } else {
            // for admin
            /**
             * only installed and removed jobs filtered out by default
             */
            $jobs = Job::with('users')->with('installers.installuser')
                ->where(function ($q) {
                $q->where('install_status', '1')
                    ->orWhere('install_status', '2')
                    ->orWhere('install_status', '3')
                    ->orWhere('install_status', '4')
                    ->orWhere('install_status', '6')
                    ->orWhere('install_status', '8')
                    ->orWhere('install_status', '9')
                    ->orWhere('install_status', '10')
                    ->orWhere('install_status', '11');
            })->get();
			
			
			//echo "<pre>"; print_r($jobs); die;
        }
        if (($status)) {
			
            $jobs = Job::where("install_status", '=', $status)->with('users')
                ->with('installers.installuser')
                ->get();
        }
		
	/* 	foreach($jobs as &$_job){
			
			$installStatus = $_job->install_status; 	
			$installer 	= Installer::where(['job_id' => $_job->id])->orderBy('id', 'desc')->first();
			
			if($installStatus == 4 || ($installStatus == 6 && $installer->type == 1) || $installStatus == 8 ){
				
				if($installer){
					$_job->cinstall_date 		=  isset($installer->install_date) ? $installer->install_date: "";
					$user 	= User::where(['id' => $installer->installer_id])->first();
					$_job->installer_name = isset($user->name) ? $user->name: "";
				}else{
					$_job->cinstall_date 		=  "";
					$_job->installer_name 		=  "";
				}
			}else{
				$_job->cinstall_date 		=  "";
				$_job->installer_name 		=  "";
			}
		} */
		
        return datatables()->of($jobs)->make(true);
    }

    /**
     * Get Reporting Jobs only on filter applied with Datatable ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function getReportingjob(Request $request)
    {
        $jobs = [];
        $start_date = (! empty($request->input('start_date'))) ? ($request->input('start_date')) : ('');
        $end_date = (! empty($request->input('end_date'))) ? ($request->input('end_date')) : ('');
        $install_start_date = (! empty($request->input('install_start_date'))) ? ($request->input('install_start_date')) : ('');
        $install_end_date = (! empty($request->input('install_end_date'))) ? ($request->input('install_end_date')) : ('');
        $printing_start_date = (! empty($request->input('printing_start_date'))) ? ($request->input('printing_start_date')) : ('');
        $printing_end_date = (! empty($request->input('printing_end_date'))) ? ($request->input('printing_end_date')) : ('');
        $task_start_date = (! empty($request->input('task_start_date'))) ? ($request->input('task_start_date')) : ('');
        $task_end_date = (! empty($request->input('task_end_date'))) ? ($request->input('task_end_date')) : ('');
        $install_complete_start_date = (! empty($request->input('install_complete_start_date'))) ? ($request->input('install_complete_start_date')) : ('');
        $install_complete_end_date = (! empty($request->input('install_complete_end_date'))) ? ($request->input('install_complete_end_date')) : ('');

        if ($install_start_date && $install_end_date) {
            $jobIds = Installer::whereRaw("date(install_date) >= '" . $install_start_date . "' AND date(install_date) <= '" . $install_end_date . "'")->pluck('job_id')->toArray();
            $jobs = Job::selectRaw('jobs.*')->with(['users','installers.installuser'])->whereIn('id', $jobIds)->get();
        }
        if ($printing_start_date && $printing_end_date) {
            $jobs = Job::whereRaw("date(printing_complete_date) >= '" . $printing_start_date . "' AND date(printing_complete_date) <= '" . $printing_end_date . "'")->with('users')
                ->with('installers.installuser')
                ->get();
        }
        if ($task_start_date && $task_end_date) {
            $jobIds = Installer::whereRaw("date(other_task_completed_date) >= '" . $task_start_date . "' AND date(other_task_completed_date) <= '" . $task_end_date . "'")->pluck('job_id')->toArray();
            $jobs = Job::selectRaw('jobs.*')->with(['users','installers.installuser'])->whereIn('id', $jobIds)->get();
        }
        if ($start_date && $end_date) {
            $jobs = Job::whereRaw("date(created_at) >= '" . $start_date . "' AND date(created_at) <= '" . $end_date . "'")->with('users')
                ->with('installers.installuser')
                ->get();
        }
        if ($install_complete_start_date && $install_complete_end_date) {
            $jobIds = Installer::whereRaw("date(install_complete_date) >= '" . $install_complete_start_date . "' AND date(install_complete_date) <= '" . $install_complete_end_date . "'")->pluck('job_id')->toArray();
            //$jobs = Job::whereIn('id', $jobIds)->with('users')->with('installers')->get();
			
			$jobs = Job::selectRaw('jobs.*')->with(['users','installers.installuser'])->whereIn('jobs.id', $jobIds)->get();
			//->leftjoin('installers','installers.job_id','=','jobs.id')->leftjoin('users','users.id','=','installers.installer_id')
			// echo '<pre>' ; print_r($jobs); die;
        }
		
        return datatables()->of($jobs)->make(true);
    }

    public function getTodayJobs(Request $request)
    {
        $installer_select_id = (! empty($request->input('installer_select_id'))) ? ($request->input('installer_select_id')) : ('');
        $install_date = (! empty($request->input('install_date'))) ? ($request->input('install_date')) : ('');

        $jobs = [];

        if ($installer_select_id && $install_date) {
            $jobs = Installer::where([
                'install_date' => $install_date,
                'installer_id' => $installer_select_id
            ])->with('jobs')->get();
        }

        return datatables()->of($jobs)->make(true);
    }

    /**
     * Get Jobs with Datatable ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function getSinglejob(Request $request)
    {
        $data = $request->all();
        $job = Job::where('id', $data['job_id'])->with('users')
            ->with('installers')
            ->first();
        return view('backend.jobs.modaldata', compact('job'));
    }

    /**
     * Upload Artwork ajax
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadArtwork(Request $request)
    {
        $data = $request->all();
		//echo "<pre>"; print_r($data); die;
        $job = Artworkupload::where('job_id', $data['job_id'])->orderby('id', 'desc')->first();
        if (! empty($job)) {
			if ($request->hasFile('artwork_file')) {
				$job->when = '1';
				$job->save();
			}else{
				$job->status 	= '0';
				$job->when 		= '0';
				$job->token = Job::Token();
				$job->save();
				$create = $job;
			}
        }

		if ($request->hasFile('artwork_file')) {
			
			$create = new Artworkupload();
			$create->job_id = $data['job_id'];
			$create->status = '0';
			$file = $request->file('artwork_file');
			$name = time() . '_' . rand() . "." . $file->getClientOriginalExtension();
			$path = '/artworks/' . $data['job_id'];
			$file->move(public_path() . $path, $name);
			$create->artwotk_image = $path . '/' . $name;
			$create->token = Job::Token();
			$create->when = '0';
			$create->save();
			
		}

        Job::where('id', $data['job_id'])->update([
            'install_status' => '2'
        ]);
		
        $job = Job::where('id', $data['job_id'])->with('users')->first();

        Mail::send('backend.emails.artworktoclient', [
            'create' => $create
        ], function ($message) use ($job) {
            $message->to($job->users->email)->
            // ->bcc([
            // 'Jarrod.anderson@smesgroup.com.au'
            // ])
            subject($job->id . "-" . $job->pro_address);
        });
        if (count(Mail::failures()) > 0) {

            echo "There was one or more failures. They were: <br />";

            foreach (Mail::failures() as $email_address) {
                echo " - $email_address <br />";
            }
        } else {
            echo "No errors, all sent successfully!";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobRequest $request)
    {
        $data = $request->all();
	
		// $date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['preferred_install_date'])->format('Y-m-d');
        // echo '<pre>'; print_r($data); echo '-=-=-=-=-'; echo $date; die;
		$job = new Job();
        $job->install_status = "1";
        $job->status = "1";
        $job->user_id = auth()->user()->id;
        $job->suburb = $data['suburb'];
        $job->post_code = $data['post_code'];
        $job->state = $data['state'];
        $job->pro_type = $data['pro_type'];
        $job->pro_address = $data['pro_address'];
        $job->sign_type = $data['sign_type'];
		$job->sign_options = $data['sign_options'];
		// $job->preferred_install_date = $date;
        $job->size = $data['size'];
        $job->orientation = $data['orientation'];
        $job->quantity = $data['quantity'];
        $job->listing_type = $data['listing_type'];
        $job->v_board = $data['v_board'];
		$job->flag_holder = $data['flag_holder']; 
        $job->overlays = $data['overlays'];
        $job->install_notes = $data['install_notes'];
        $job->terms_conditions = $data['terms_conditions'];
        $job->marketting_confirm = $data['marketting_confirm'];
        $job->latitude = $data['latitude'];
        $job->longitude = $data['longitude'];
        $job->installation_method = $data['installation_method'];
		
        if (! empty($request->file('install_pic'))) {
            if ($job->install_pic_check == '1') {
                $img = Job::find($job->id);
                $file = $request->file('install_pic');
                $name = time() . '_' . $file->getClientOriginalName();
                $path = '/installation_pic/' . $job->id;
                $file->move(public_path() . $path, $name);
                $img->install_pic = $path . '/' . $name;
                $img->save();
            }
        }
		echo '<pre>'; print_r($job); 
		echo '**************DATA************************'; print_r($data); die('there');
        if ($job->save()) {
            return redirect('/admin/jobs');
        }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function show($jobId)
    {
        $job = Job::where('id', $jobId)->with('users')
            ->with('installers')
            ->first();
		 
        return view('backend.jobs.show_job', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function edit($jobId)
    {
        $job = Job::findorfail($jobId);
        $user = User::select([
            'id',
            'name'
        ])->get()->toArray();
        return view("backend.jobs.edit", compact('job', 'user'));
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
			// echo '<pre>'; print_r($data); die;
			$date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['preferred_install_date'])->format('Y-m-d');
			$data['preferred_install_date'] = isset($date) ? $date : NULL;
            $data['terms_conditions'] = isset($data['terms_conditions']) ? $data['terms_conditions'] : NULL;
            $data['marketting_confirm'] = isset($data['marketting_confirm']) ? $data['marketting_confirm'] : NULL;
            $data['install_pic_check'] = isset($data['install_pic_check']) ? $data['install_pic_check'] : NULL;
            // $data['terms_conditions_2'] = isset($data['terms_conditions_2']) ? $data['terms_conditions_2'] : NULL;
            // $data['marketting_conditions'] = isset($data['marketting_conditions']) ? $data['marketting_conditions'] : NULL;
            $data['anti_grafiti_lamin'] = isset($data['anti_grafiti_lamin']) ? $data['anti_grafiti_lamin'] : NULL;
            $data['solor_spot'] = isset($data['solor_spot']) ? $data['solor_spot'] : NULL;
            // $data['install_date'] = isset($data['install_date']) ? $data['install_date'] : NULL;
            // $data['installer'] = isset($data['installer']) ? $data['installer'] : NULL;
			$data['flag_holders']	= isset($data['flag_holders'])? $data['flag_holders'] : '0';
            
            if ($job->update($data)) {
                return redirect('admin/jobs/' . $jobId);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::findOrFail($id);

        // relevant models
        $job->otherTask()->delete();
        $job->artworkUpload()->delete();
        $job->installerRelation()->delete();
        $job->file()->delete();
        $job->delete();

        return redirect('admin/jobs/');
    }

    /**
     * Printing Status
     *
     * @return \Illuminate\Http\Response
     */
    public function printingDone(Request $request)
    {
        $data = $request->all();
        $job = Job::where('id', $data['job_id'])->where('install_status', '>', '2')->first();
        if (empty($job)) {
            return response()->json(array(
                'success' => 'unaccepted'
            ));
        }
        if ($data['state'] == '1') {
            $print = Job::where('id', $data['job_id'])->update([
                'printing_status' => '1',
                'install_status' => '4',
                'printing_complete_date' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        } else if ($data['state'] == '0') {
            $print = Job::where('id', $data['job_id'])->update([
                'printing_status' => null
            ]);
        }
        if ($print && $data['state'] == '1') {
            return response()->json(array(
                'success' => 'completed'
            ));
        } else {
            return response()->json(array(
                'success' => 'incompleted'
            ));
        }
    }

    /**
     * Artwork not required
     */
    public function artworkNotRequired(Request $request)
    {
        $data = $request->all();

        if ($data['state'] == '1') {
            $print = Job::where('id', $data['job_id'])->update([
                'artwork_required' => '1',
                'install_status' => '3'
            ]);
        } else if ($data['state'] == '2') {
            $print = Job::where('id', $data['job_id'])->update([
                'artwork_required' => '2',
                'install_status' => '2'
            ]);
        }
        if ($print && $data['state'] == '1') {
            return response()->json(array(
                'success' => 'notRequired'
            ));
        } else {
            return response()->json(array(
                'success' => 'required'
            ));
        }
    }

    /**
     * Insert selected installer with ajax
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function selectedInstaller(Request $request)
    {
        $data = $request->all();
        $job = Job::where('id', $data['job_id'])->where('printing_status', '1')->first();
        if (empty($job)) {

            return response()->json(array(
                'success' => 'notPrint'
            ));
        }

        $date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['install_date'])->format('Y-m-d');
        $exist = Installer::where('job_id', $data['job_id'])->where([
            'type' => '0'
        ])->first();
        if (! empty($exist)) {
            // return response()->json(array(
                // 'success' => 'already'
            // ));
			$insert = Installer::where('job_id',$data['job_id'])->first();
			$insert->installer_id = $data['installer'];
			$insert->install_date = $date;
			$insert->save();
			
			 return response()->json(array(
				'success' => 'updated'
			));
			
        }else{
			
			$insert = new Installer();
			$insert->job_id = $data['job_id'];
			$insert->installer_id = $data['installer'];
			$insert->install_date = $date;
			$insert->type = '0';
			$insert->save();
			return response()->json(array(
            'success' => 'selected'
            ));
		
		}
    }

    public function selectedRemoval(Request $request)
    {
        $data = $request->all();
		
        $job = Job::where('id', $data['job_id'])->where('install_status', '>', '5')->first();
        if (empty($job)) {

            return response()->json(array(
                'success' => 'notRemovalRequest'
            ));
        }
        $date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['remove_date'])->format('Y-m-d');
        $exist = Installer::where('job_id', $data['job_id'])->where([
            'removalstatus' => '0',
            'type' => '1'
        ])->first();
		//echo "<pre>"; print_r($exist); die;
        if (! empty($exist) && $exist->installstatus == 1) {
            return response()->json(array(
                'success' => 'already'
            ));
        }
		if (! empty($exist) && $exist->installstatus != 1) {
			
			Installer::where('id', $exist['id'])->update([
				'install_date' => $date,
				'installer_id' => $data['removal']
			]);
            return response()->json(array(
                'success' => 'updated'
            ));
        }
        $insert = new Installer();
        $insert->job_id = $data['job_id'];
        $insert->installer_id = $data['removal'];
        $insert->install_date = $date;
        $insert->type = '1';
        $insert->removalstatus = '0';
        $insert->save(); 
		
		
        return response()->json(array(
            'success' => 'selected'
        ));
    }

    /**
     * Other Task Installer add with ajax
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function taskInstaller(Request $request)
    {
        $data = $request->all();
		$date = \Carbon\Carbon::createFromFormat('d/m/Y', $data['task_install_date'])->format('Y-m-d');
        // exist
        $exist = Installer::where('job_id', $data['job_id'])->where([
            'other_task_id' => $data['task_id'],
            'job_id' => $data['job_id'],
            'installer_id' => $data['task_installer'],
            'type' => '0'
        ])->first();
        if (! empty($exist)) {
			Installer::where('id', $exist['id'])->update([
				'install_date' => $date,
				'installer_id' => $data['task_installer']
			]);
            return response()->json(array(
                'success' => 'updated'
            ));
        }
        // new record
        $insert = new Installer();
        $insert->job_id = $data['job_id'];
        $insert->installer_id = $data['task_installer'];
        $insert->install_date = $date;
        $insert->type = '0';
        $insert->other_task_id = $data['task_id'];
        // $insert->installstatus = '0';
        $insert->save();
        return response()->json(array(
            'success' => 'selected'
        ));
    }
	
	 /**
     * Update user Id of jobs
     *
     * @param \App\job $job
     * @return \Illuminate\Http\Response
     */
    public function importJobs(Request $request)
    {
		
		$module_title 	= 'Import';
        $module_name 	= 'Import';
        $module_icon 	= 'fas fa-briefcase';

        $module_action = 'Jobs';
		
		if($request->hasFile('import_file')){
			
			$file = $request->file('import_file');
			$name = time() . '_' . $file->getClientOriginalName();
			$path = '/uploads/';
			$file->move(public_path() . $path, $name);
			
			$filepath = public_path() . $path.$name;
			
			if (($open = fopen($filepath, "r")) !== FALSE) 
			{
				while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
				{        
				  $records[] = $data; 
				}
		  
				fclose($open);
			}
			//echo "<pre>"; print_r($records); die;
			$updated = 0;
			foreach($records as $record){
				
				if($record[0] != '#ID'){
					$job_id 		= trim($record[0]);
					$user_name  	= trim($record[3]);
					$user 			= User::where('name', $user_name)->first();
					if($user){
						
						$updated = 1;
						$update = Job::where('id', $job_id)->update([
									'user_id' => $user->id
								]);
						
					}				
				}
			}
			
			$msg     =  ($updated == '1')? "Jobs User updated successfully!": "No record updated!";
			
			flash('<i class="fas fa-check"></i>'.$msg )->success()->important();

            return redirect()->back();
			
		}else{
			return view('backend.jobs.import_jobs', compact('module_title', 'module_name', 'module_icon', 'module_action'));
		}
		
	}
	
	
}
