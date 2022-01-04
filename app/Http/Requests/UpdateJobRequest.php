<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->user()){
			return true;
		}else{
			return false;
		}
    }
	
	public function attributes()
    {
		return ['pro_address','pro_type','sign_type','size','orientation','listing_type','quantity','v_board','overlays','install_notes','terms_conditions','marketting_confirm','install_pic_check','terms_conditions_2','marketting_conditions','anti_grafiti_lamin','flag_holder','solor_spot','status'];
	
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'quantity' => 'required|numeric',
        ];
    }
}
