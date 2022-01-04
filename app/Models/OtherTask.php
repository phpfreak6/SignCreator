<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherTask extends Model
{

    public static function otherTask()
    {
        return array(
            '1' => 'Re-Erect - Weather (+NIL)',
            '2' => 'Re-Erect - Other (+$50 + GST)',
            '3' => 'Remove Graffiti (+$40 GST)',
            '4' => 'Relocate (+$50 + GST)',
            '5' => 'New/Additional Nameplate or Decal (+$40 GST)',
            '6' => 'Sold Decal - Generic unless noted (+$22.50 + GST)',
            '7' => 'Leased Decal - Generic unless noted (+$22.50 + GST)',
            '8' => 'Others'
        );
    }

    public static function otherTaskName($id)
    {
        $arr = array(
            'Re-Erect - Weather (+NIL)' => '1',
            'Re-Erect - Other (+$50 + GST)' => '2',
            'Remove Graffiti (+$40 GST)' => '3',
            'Relocate (+$50 + GST)' => '4',
            'New/Additional Nameplate or Decal (+$40 GST)' => '5',
            'Sold Decal - Generic unless noted (+$22.50 + GST)' => '6',
            'Leased Decal - Generic unless noted (+$22.50 + GST)' => '7',
            'Others' => '8'
        );
        return array_search($id, $arr);
    }

    public function installer()
    {
        return $this->hasOne('App\Models\Installer', 'other_task_id', 'id');
    }
}
