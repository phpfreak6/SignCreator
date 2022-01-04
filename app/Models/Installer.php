<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;use Illuminate\Foundation\Auth\User as Authenticatable;use Config;

class Installer extends Model
{

    public static function statusofInstall($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '0')->first();
        if ($res) {
            if ($res->installstatus == '0') {
                return 'INSTALLER SELECTED';
            } else if ($res->installstatus == '1') {
                return 'INSTALL COMPLETED';
            }
        } else {
            return null;
        }
    }

    public static function statusofRemoval($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '1')->first();
        if ($res) {
            if ($res->installstatus == '0') {
                return 'REMOVAL SELECTED';
            } else if ($res->installstatus == '1') {
                return 'REMOVAL COMPLETED';
            }
        } else {
            return null;
        }
    }

    public static function installDate($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '0')->first();
        if ($res) {
            return $res->install_date;
        } else {
            return null;
        }
    }
	
	
	public static function installCompleted($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '0')->first();
        if ($res) {
            return $res->install_image;
        } else {
            return null;
        }
    }
	
	public static function removedinstallCompleted($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '1')->first();
        if ($res) {
            return $res->install_image;
        } else {
            return null;
        }
    }
	
	public static function taskcompletedpic($jobId, $taskId)
    {
        $res = self::where(['job_id'=>$jobId, 'installstatus' => '1', 'other_task_id' => $taskId ])->first();
        if ($res) {
            return $res->install_image;
        } else {
            return null;
        }
    }


    public static function removeDate($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '1')->first();
        if ($res) {
            return $res->install_date;
        } else {
            return null;
        }
    }
	
	public static function removedby($jobId)
    {
        $res = self::where('job_id', $jobId)->where('type', '1')->first();
		
        if ($res) {
			$username = User::selectRaw('users.name')->where('id', $res->installer_id)->first();
            return $username->name;
        } else {
            return null;
        }
    }
		
	public static function getInstlleruser($jobId)
    {
		$jobs = Job::selectRaw('jobs.*')->with(['users','installers.installuser'])->where('id', $jobId)->first();
		//echo "<pre>"; print_r($jobs ); die;
		if (isset($jobs->installers->installuser->name) && $jobs->installers->installstatus ==1) {
            return $jobs->installers->installuser->name;
        } else {
            return null;
        }
	}
	
	public static function taskInstlleruser($taskid)
    {
		$res = self::where(['other_task_id' => $taskid, 'installstatus' => '1'])->first();
		if ($res) {
			$username = User::selectRaw('users.name')->where('id', $res->installer_id)->first();
            return $username->name;
        } else {
            return null;
        }
	}

	
	public function installuser(){        
			return $this->hasOne('App\Models\Installeruser', 'id', 'installer_id');    
			
	}
	
    public function jobs()
    {
        return $this->hasOne('App\Models\Job', 'id', 'job_id');
    }
	
	public static function selectedInstaller($jobId)
    {
        
		$res = self::where('job_id', $jobId)->where('type', '1')->first();	
	
		if($res){
			$date = \Carbon\Carbon::createFromFormat('Y-m-d', $res->install_date)->format('d/m/Y');
			$installer = $res->installer_id;
			
		}else{
			
			$res = self::where('job_id', $jobId)->where('type', '0')->first();
			if ($res) {
				$date = \Carbon\Carbon::createFromFormat('Y-m-d', $res->install_date)->format('d/m/Y');
				$installer = $res->installer_id;
			}else{
				$date = '';
				$installer = 0;	
			}
		}
		
		$data = [
					'date' =>$date,
					'installer'=>$installer
				];
			
		return $data;
    }
	
	
}
