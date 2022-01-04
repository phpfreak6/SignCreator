<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	
	public static function reference_pic($jobid){
		$jobs = self::where(['job_id' => $jobid,'type' => '2'])->get();
		return $jobs;
	}
	
	public static function install_pic($jobid){
		$jobs = self::where(['job_id' => $jobid,'type' => '1'])->get();
		
		return $jobs;
	}
}
