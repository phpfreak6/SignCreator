<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artworkupload extends Model
{

    public static function artwotkStatus($job_id)
    {
        $s = self::where('job_id', $job_id)->where('when', '0')->first();
        // artwork not required status
        $job = Job::where('id', $job_id)->first();
        if (! empty($job)) {
            if ($job->artwork_required == "1") {
                return [
                    'status' => 'ARTWORK NOT REQUIRED'
                ];
            }
        }
        // not required code end
        if (! empty($s)) {
            if ($s->status == '0') {
                return [
                    'status' => 'SENT',
                    'whensent' => $s->created_at
                ];
            } else if ($s->status == '1') {
                return [
                    'status' => 'ACCEPTED',
                    'whensent' => $s->created_at
                ];
			} else if ($s->status == '2') {
                return [
                    'status' => 'DECLINED',
                    'whensent' => $s->created_at
                ];
            }else{
				return [
					'status' => 'NOT SENT'
				];
			}
        } else {
            return [
                'status' => 'NOT SENT'
            ];
        }
    }

    public static function comment($job_id)
    {
        $s = self::where('job_id', $job_id)->first();
        if (! empty($s)) {
            return $s->comment;
        } else {
            return null;
        }
    }

    public function jobs()
    {
        return $this->hasOne('App\Models\Job', 'id', 'job_id');
    }
	
	public static function artworkimage($job_id)
    {
        $s = self::where('job_id', $job_id)->orderBy('id', 'desc')->first();
        if (! empty($s)) {
            return $s;
        } else {
            return null;
        }
    }
	
	public static function artworkpdf($job_id)
    {
		$s = Job::where('id', $job_id)->first();
        if (! empty($s)) {
            return $s;
        } else {
            return null;
        }
    }
	
	
	
	
}
