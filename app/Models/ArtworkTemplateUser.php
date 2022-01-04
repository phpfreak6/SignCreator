<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtworkTemplateUser extends Model
{
	protected $table = 'artwork_template_users';
	
	public function artworktemplates()
	{
		return $this->hasOne('App\Models\ArtworkTemplate', 'id', 'template_id');
	}
}


