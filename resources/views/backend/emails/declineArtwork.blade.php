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
            <td style="padding: 0px 20px;">
                <p><strong>Job ID: </strong> <?=isset($artworkUpload->jobs->id) ? $artworkUpload->jobs->id : ""?></p>
            </td>
        </tr>  
		<tr>
            <td style="padding: 0px 20px;">
                <p><strong>Client Name: </strong> <?=isset($artworkUpload->jobs->users->name) ? $artworkUpload->jobs->users->name : ""?></p>
            </td>
        </tr>
			<tr>
            <td style="padding: 0px 20px;">
                <p><strong>Address: </strong> <?=isset($artworkUpload->jobs->pro_address) ? $artworkUpload->jobs->pro_address : ""?></p>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 20px;">
                <p><strong>Reason for Decline: </strong> <?=isset($artworkUpload->comment) ? $artworkUpload->comment : ""?></p>
            </td>
        </tr>
        <tr>
            <td align="center"  style="/* background:#9dd4ff; */padding: 5px 0px;">
                <strong>
                    <a href="http://orders.signcreators.com.au/" target="_blank" style="color: #000;text-decoration: none;">Signcreators.com.au</a>
                </strong>
            </td>
        </tr>
    </tbody>
</table>  

@endsection