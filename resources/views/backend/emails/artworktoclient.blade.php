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
                <p style="padding-left:20px; font-size: 18px; text-align: justify; padding-right: 20px;">Please find attached Sign Creators proof for the above address</p>
            </td>
        </tr>  <br>
		<tr>
            <td>
                <p style="padding-left:20px; font-size: 18px; text-align: justify; padding-right: 20px;">PLEASE NOTE: This proof is supplied to check layout, spelling and overall design. It also allows you to check colour and layers.  Please note these do visually change depending on screen and computer set up. If you have any specific requirements, please contact us at<strong> orders@signcreators.com.au </strong> </p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="padding-left:20px; font-size: 18px; text-align: justify; padding-right: 20px;">Your job will not proceed until the artwork is approved.
                 </p>
            </td>
        </tr>
        
		<tr>
            <td align="center"  >
			<div style="margin-bottom:25px;margin-top:25px">
                <a href="{{url('/')}}/artwork/{{$create->token}}" style="
					color: #e4e4e4;
					background-color: #7ec775;
					padding: 10px;
					border-radius: 6px;
					text-decoration: none;
					font-size: larger;
				" >Click Here To Start The Approval Process.</a>
			</div>
            </td>
			
        </tr>
         <br><br>
		<tr>
            <td>
			<div style="margin-bottom:25px; padding-left:25px">
Thank you,<br>
<b>SIGN CREATORS</b>
            
			</div>
            </td>
			
        </tr>
        <tr>
            <td align="center"  style="/* background:#9dd4ff; */padding: 5px 0px;">
                <strong>
                    <a href="http://orders.signcreators.com.au/" target="_blank" style="font-size: 18px; color: #000;text-decoration: none;">Signcreators.com.au</a>
                </strong>
            </td>
        </tr>
    </tbody>
</table>  
@endsection