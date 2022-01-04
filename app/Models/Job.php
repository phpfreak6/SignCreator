<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Config;

class Job extends Authenticatable
{

    public static function Status()
    {
        return array(
            '1' => 'Requested',
            '2' => 'Artwork Created',
            '3' => 'Artwork Approved',
            '4' => 'Printed',
            '5' => 'Installed',
            '6' => 'Removal Request',
            '7' => 'Removed',
            '8' => 'Task Requested',
            '9' => 'Not Installed',
            '10' => 'Cancelled',
            '11' => 'Not Removed'
        );
    }

    public static $status = array(
        'Requested' => '1',
        'ArtworkCreated' => '2',
        'ArtworkApproved' => '3',
        'Printed' => '4',
        'Installed' => '5',
        'RemovalRequest' => '6',
        'Removal' => '7',
        'Task Requested' => '8',
        'Not Installed' => '9',
        'Cancelled' => '10',
        'Not Removed' => '11'
    );

    public static $states = array(
        'inactive' => '0',
        'active' => '1',
        'canceljob' => '2'
    );

    protected $guarded = [
        'id',
        'updated_at',
        '_token'
    ];

    public static function changeStatus($id, $action)
    {
        $update = self::find($id);
        if ($action == 'canceljob') {
            $update->status = self::$states[$action];
            $update->install_status = "10";
        } else {
            $update->install_status = self::$status[$action];
        }
        $update->save();
        return $update;
    }

    public function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function installers()
    {
        return $this->hasOne('App\Models\Installer', 'job_id', 'id')->latest();
    }

    public function otherTask()
    {
        return $this->hasMany('App\Models\OtherTask', 'job_id', 'id');
    }

    public function File()
    {
        return $this->hasMany('App\Models\File', 'job_id', 'id');
    }

    public function installerRelation()
    {
        return $this->hasMany('App\Models\Installer', 'job_id', 'id');
    }

    public function artworkUpload()
    {
        return $this->hasMany('App\Models\Artworkupload', 'job_id', 'id');
    }

    public static function Token()
    {
        return md5(rand(1, 10) . microtime());
    }

    public static function printingStatus($id)
    {
        return self::where('id', $id)->pluck('printing_status')->first();
    }

    public static function artworkStatus($id)
    {
        return self::where('id', $id)->pluck('artwork_required')->first();
    }

    // public static function insertData($data)
    // {
    // $result = self::insert($data);

    // return $result;
    // }
    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (! file_exists($filename) || ! is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (! $header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public static function UserIds($name)
    {
        $user = User::where('first_name', $name)->first();
        if (! empty($user) && $name == $user->first_name) {
            return $user->id;
        }
        return "";
    }
	
	public static function selectedJobpreferreddate($id)
    {
        $res = self::where('id', $id)->first();
		// echo '<pre>' ; print_r($res->preferred_install_date); die;
		if(!empty($res->preferred_install_date)){
			$date = \Carbon\Carbon::createFromFormat('Y-m-d', $res->preferred_install_date)->format('d/m/Y');
		}else{
			$date = '';
		}
		
		$data = [
					'date' =>$date
				];
		return $data;
    }
    /*
     * public function update(array $attributes = array(), array $data = Array()){
     *
     * echo '<pre>' ; print_r($this); die;
     *
     * }
     */
}
