@extends('backend.emails.layout')
@section('content')
<table width="600" align="center" cellpadding="0"  cellspacing="0" style="border: 1px solid #d2d2d2;font-family: Montserrat, Helvetica Neue, Arial, sans-serif;">
    <tbody>
        <tr>
            <td align="center"  style="/* background:#9dd4ff; */padding: 5px 0px;">
                <img src="http://orders.signcreators.com.au/img/logo.png" style="height: 75px;">
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-bottom: 0px; padding-left:20px; font-size: 18px; text-align: justify; padding-right: 20px;">Dear <?=isset($job->users->name) ? ($job->users->name) : ""?>
</p>
            </td>
        </tr>
		<tr>
            <td style="padding-left:20px; font-size: 18px; text-align: justify;  padding-right: 20px;">
                <p style="font-size: 18px; text-align: justify;">Great news, your sign removal has been completed at 
 <br>          
          <?=isset($job->pro_address) ? ($job->pro_address) : ""?> </p>          
            </td>
        </tr>
        <tr>
            <td>
                <p style="padding-left:20px; font-size: 18px; text-align: justify; padding-right: 20px;">Thank you for using Sign Creators, we look forward to your next install.
              <br>For any further assistance please email your project manager on
              <strong>support@signcreators.com.au
              </strong>
                 </p>
            </td>
        </tr>
        <tr>
            <td>
			<div style="margin-bottom:25px; padding-left:25px">
<b>SIGN CREATORS</b>
            
			</div>
            </td>
			
        </tr>
        
        	<tr>
        	<td>
        			<?php

        if (! empty($install->install_image)) {
            ?>
	 <a href="{{ url('jobs/downloadInstallerInstallImage/'.$install->id) }}" target="_self" style="margin-bottom: 25px; padding-left: 173px" >Please click here to download Install Picture</a> 	
				
				<?php
        }
        ?>
        
        </td>
        </tr>	
        <tr>
        		
        		<td>	<?php

        if (! empty($install->install_image)) {
            ?>
				<img src="{{url($install->install_image)}}"
						style="width: 93.5%; height: 400px; padding: 0 20px; object-fit: contain;" />
				<?php
        }
        ?>
        
        </td>
        </tr>
 
		
        <tr>
            <td align="center"  style="/* background:#9dd4ff; */padding: 5px 0px;">
                <strong>
                    <a href="http://orders.signcreators.com.au/" target="_blank"style="font-size: 18px; color: #000;text-decoration: none;">Signcreators.com.au</a>
                </strong>
            </td>
        </tr>
    </tbody>
</table>  
<style>
tr br:empty {
    display: none;
}
</style>
@endsection