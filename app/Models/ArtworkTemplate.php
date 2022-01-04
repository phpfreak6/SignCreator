<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtworkTemplate extends Model
{
	protected $table = 'artwork_templates';
	
	public function templateuser()
	{
		return $this->hasOne('App\Models\ArtworkTemplateUser', 'template_id', 'id');
	}
} 


