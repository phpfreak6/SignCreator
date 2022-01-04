/* 
*Website Custom Js
*
*/

jQuery(document).ready(function() {
	const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
	
	
	/* 
	*Jobs Datatables
	* Admin Side
	*/
	var dataTable2 = $('.data_table_admin').DataTable({
		// 'processing': true,
		 "pageLength": 100,
		dom: 'frtipB',
		"buttons": [
		{
			extend: 'csv',
            text: '<div class="btn btn-success " data-toggle="tooltip" title="export"><i class="fa fa-file-export"></i> Export</div>'
		},
        
        ],
		'serverSide': true,
		'order': [[0, 'desc']],
		"columnDefs": [
           {"className": "dt-center", "targets": "_all", "defaultContent": '-'},
           
      
               {
                   "targets": [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23 ],
                   "visible": false,
                   "searchable": false
               },        
           
        ],
		'serverMethod': 'post',
		'ajax': {
		    'url':'jobs/all', 
		    'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        	'data': function(data){
                // Read values
                  data.installstatus = $('#installStatusFilter').val();
                 },
		}, 
		aoColumns: [
        { mData: 'id' },
        { mData: 'pro_address' },
        { mData: 'suburb' },
        { mData: 'users.name' },
       
        { mData: 'installers.install_date',
			"sortable": false,
            "render": function (data, type, row) {
				var installStatus = row.install_status;
				
				if(( row.installers == 'undefined' || row.installers == null )) { return ''; }
				
				if(installStatus == 4 || (installStatus == 6 && row.installers.type == 1) || installStatus == 8 ){
					return data;
				}else{
					return '';
				}
				//let date = new Date(data);
				//return date.getDate() + "-" + months[date.getMonth()] + "-" + date.getFullYear();
				//return data;
			}
		},
        { mData: 'installers.installuser.name',
			"sortable": false,
		    "render": function (data, type, row) {
				var installStatus = row.install_status;

				if(( row.installers == 'undefined' || row.installers == null )) { return ''; }
				
				if(installStatus == 4 || (installStatus == 6 && row.installers.type == 1) || installStatus == 8 ){
					return data;
				}else{
					return '';
				}
			}
		},
        { mData: 'install_status' ,
			"render": function (data, type, row) {
				if(data == 1){   
					return 'REQUESTED';
				}else if(data == 2){
					return 'ARTWORK CREATED';
				}else if(data == 3){
					return 'ARTWORK APPROVED';
				}else if(data == 4){
					return 'PRINTED';
				}else if(data == 5){
					return 'INSTALLED';
				}else if(data == 6){
					return 'REMOVAL REQUEST';
				}else if(data == 7){
					return 'REMOVED';
				}else if(data == 8){
					return 'TASK REQUESTED';
				}else if(data == 9){
					return 'NOT INSTALLED';
				}else if(data == 10){
					return 'CANCELLED';
				}else if(data == 11){
					return 'NOT REMOVED';
				}else{
					return 'N/A';
				}
			}
		},
		{ "data": "id" ,
			"searchable": false,
			"sortable": false,
			"render": function (id) {
				 var view_button = '<a href="jobs/'+id+'" title="Edit" class="edit"><i class="fas fa-eye"></i></a> ';
				 var delete_button = '<a href="#" title="Delete" class="delete"><i class="fas fa-trash del"></i></a>';

				 return view_button + delete_button;
				
	

			}
		},
		 { mData: 'post_code' },
		 { mData: 'state' },
		 { mData: 'size' ,
				"render": function (data, type, row) {
					if(data == 1){   
						return '1200X900mm(4X3)';
					}else if(data == 2){
						return '1800X1200mm(6X4)';
					}else if(data == 3){
						return '2400X1800mm(8X6)';
					}else if(data == 4){
						return '2400X2400MM';
					}else if(data == 5){
						return '3000X2400mm(10x8)';
					}else if(data == 6){
						return '3600x2400mm(12x8)';
					}else if(data == 7){
						return '4800x2400mm';
					}else if(data == 8){
						return 'OTHER';
					}else{
						return '';
					}
				}
			},
		 { mData: 'overlays' },
		 { mData: 'install_notes' },
		 { mData: 'pro_type' ,
				"render": function (data, type, row) {
					if(data == 1){   
						return 'RESIDENTIAL';
					}else if(data == 2){
						return 'OFFICE';
					}else if(data == 3){
						return 'COMMERCIAL';
					}else if(data == 4){
						return 'RETAIL';
					}else if(data == 5){
						return 'INDUSTRIAL';
					}else if(data == 6){
						return 'LAND';
					}else{
						return 'N/A';
					}
				}
			},
			 { mData: 'sign_type' ,
				"render": function (data, type, row) {
					if(data == 1){   
						return 'STOCKBOARD';
					}else if(data == 2){
						return 'TEXTBOARD';
					}else if(data == 3){
						return 'PHOTO BOARD';
					}else if(data == 4){
						return 'WINDOW GRAPHIC';
					}else if(data == 5){
						return 'BANNER';
					}else if(data == 6){
						return 'OTHER';
					}else{
						return 'N/A';
					}
				}
			},
			 { mData: 'orientation' ,
				"render": function (data, type, row) {
					if(data == 1){   
						return 'Portrait';
					}else if(data == 2){
						return 'LANDSCAPE';
					}else{
						return 'N/A';
					}
				}
			},
			 { mData: 'listing_type' ,
				"render": function (data, type, row) {
					if(data == 1){   
						return 'For Sale';
					}else if(data == 2){
						return 'For Lease';
					}else if(data == 3){
						return 'For Rent';
					}else if(data == 4){
						return 'Sale/Lease';
					}else if(data == 5){
						return 'Auction';
					}else if(data == 6){
						return 'EOI';
					}else{
						return 'N/A';
					}
				}
			},
			 { mData: 'quantity'},
			 { mData: 'v_board' ,
					"render": function (data, type, row) {
						if(data == 1){   
							return 'Yes';
						}else if(data == 2){
							return 'No';
						}else{
							return 'N/A';
						}
					}
				},
				 { mData: 'artwork_required' ,
					"render": function (data, type, row) {
						if(data == 1){   
							return 'Not Required';
						}else if(data == 2){
							return 'Required';
						}else{
							return 'N/A';
						}
					}
				},
				 { mData: 'Anti_grafiti_lamination' ,
					"render": function (data, type, row) {
						if(data == 1){   
							return 'Accept';
						}else if(data == 2){
							return 'Not Accept';
						}else{
							return 'N/A';
						}
					}
				},
				 { mData: 'flag_holder' ,
					"render": function (data, type, row) {
						if(data == 1){   
							return 'Accept';
						}else if(data == 2){
							return 'Not Accept';
						}else{
							return 'N/A';
						}
					}
				},
				 { mData: 'solar_spot' ,
					"render": function (data, type, row) {
						if(data == 1){   
							return 'Accept';
						}else if(data == 2){
							return 'Not Accept';
						}else{
							return 'N/A';
						}
					}
				},
				 { mData: 'agent_nameplate'}
        ],
		"createdRow": function(row, data, dataIndex) {
			
			if(data["install_date"] == null){
				$(row).css("background-color", "#bedebe");
			}else if(new Date(data["install_date"]) < new Date()) {
			  $(row).css("background-color", "#f5f3b5");
			}
		},
		
		
	});
	
	//status dropdown filter
	$('#installStatusFilter').on('change',function(){
	     $('.data_table_admin').DataTable().draw(true);
	    });
	
	// show confirmation modal when delete button is clicked

	  var table = $('.data_table_admin').DataTable();
	  	$('.data_table_admin').on('click', 'tbody .delete', function () {
	       var mydata = table.row($(this).closest('tr')).data();
	       console.log(mydata);
	       var con=confirm("Are you sure you want to delete this job?")
	       if(con){
	    	 window.open('/admin/jobs/destroy/'+mydata.id+' ','_self');
	       }
	});

	/**
	 *  Data Table Row  href 
	 */
		    var table = $('.data_table_admin').DataTable();
		    $('.data_table_admin tbody').on('click', 'tr', function (evt) {
		    	   var $cell=$(evt.target).closest('td');
		    	    if( $cell.index()<7){
		    	    	 var job = table.row( this ).data(); 
		   		      window.open(' /admin/jobs/'+job.id+' ','_self');
		    	}
		       
		    } );
	

	
	/* 
	*Reporting Datatable
	* 
	*/
		    
	var dataTable = $('.data_table_reporting').DataTable({
		 "pageLength": 100,
		'serverSide': true,
		'order': [[0, 'desc']],
		"columnDefs": [
           {"className": "dt-center", "targets": "_all", "defaultContent": '-'},      
        ],
		'serverMethod': 'post',
		'ajax': {
		    'url':'getReportingjob/', 
		    'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        	'data': function(data){
                // Read values
        		 data.install_start_date = $('#install_start_date').val();
                 data.install_end_date = $('#install_end_date').val();
                 data.printing_start_date = $('#printing_start_date').val();
                 data.printing_end_date = $('#printing_end_date').val();
                 data.task_start_date = $('#task_start_date').val();
                 data.task_end_date = $('#task_end_date').val();
      			  data.start_date = $('#start_date').val();
                  data.end_date = $('#end_date').val();
             	 data.install_complete_start_date = $('#install_complete_start_date').val();
                 data.install_complete_end_date = $('#install_complete_end_date').val();
                 },
		},
		aoColumns: [
        { mData: 'id' },
        { mData: 'pro_address' },
        { mData: 'suburb' },
        { mData: 'users.name' },
       
        { mData: 'installers.install_date',
       
            "render": function (data, type, row) {
				//let date = new Date(data);
				//return date.getDate() + "-" + months[date.getMonth()] + "-" + date.getFullYear();
				return data;
			}
		},
        { mData: 'installers.installuser.name'},
        { mData: 'install_status' ,
			"render": function (data, type, row) {
				if(data == 1){   
					return 'REQUESTED';
				}else if(data == 2){
					return 'ARTWORK CREATED';
				}else if(data == 3){
					return 'ARTWORK APPROVED';
				}else if(data == 4){
					return 'PRINTED';
				}else if(data == 5){
					return 'INSTALLED';
				}else if(data == 6){
					return 'REMOVAL REQUEST';
				}else if(data == 7){
					return 'REMOVED';
				}else if(data == 8){
					return 'TASK REQUESTED';
				}else if(data == 9){
					return 'NOT INSTALLED';
				}else if(data == 10){
					return 'CANCELLED';
				}else if(data == 11){
					return 'NOT REMOVED';
				}else{
					return 'N/A';
				}
			}
		},
		{ "data": "id" ,
			"searchable": false,
			"sortable": false,
			"render": function (id) {
				 var view_button = '<a href="/admin/jobs/'+id+'" title="Edit" class="edit"><i class="fas fa-eye"></i></a> ';
				 return view_button;

			}
		},
        ],
		"createdRow": function(row, data, dataIndex) {
			
			if(data["install_date"] == null){
				$(row).css("background-color", "#bedebe");
			}else if(new Date(data["install_date"]) < new Date()) {
			  $(row).css("background-color", "#f5f3b5");
			}
		},
		
		
	});
	/* 
	*Show Jobs with selected dates datatables Admin side
	*
	*/
	
	$('#btnInstallCompleteFiterSubmitSearch').click(function(){
	     $('.data_table_reporting').DataTable().draw(true);
	    });
	$('#btnTaskFiterSubmitSearch').click(function(){
	     $('.data_table_reporting').DataTable().draw(true);
	    });
	$('#btnprintingFiterSubmitSearch').click(function(){
	     $('.data_table_reporting').DataTable().draw(true);
	    });
	$('#btnInstallFiterSubmitSearch').click(function(){
	     $('.data_table_reporting').DataTable().draw(true);
	    });
	$('#btnFiterSubmitSearch').click(function(){
     $('.data_table_reporting').DataTable().draw(true);
    });

	
	
	/**
	 * data table reporting href
	 */
	
		    var tables = $('.hrefReporting').DataTable();
		    $('.hrefReporting tbody').on('click', 'tr', function (evt) {
		    	   var $cell=$(evt.target).closest('td');
		    	    if( $cell.index()<7){
		    	    	 var job = tables.row( this ).data(); 
		   		      window.open(' /admin/jobs/'+job.id+' ','_self');
		    	}
		       
		    } );
	
	
		    
		    /**
		     * installer priority set data table
		     */
			var dataTable = $('.data_table_priority').DataTable({
				 "pageLength": 100,
				'serverSide': true,
				"columnDefs": [
		           {"className": "dt-center", "targets": "_all", "defaultContent": '-'},  
		           {
	                   "targets": [5],
	                   "visible": false,
	                   "searchable": false
	               },     
		        ],
		        "order": [[ 5, "asc" ]],
				'serverMethod': 'post',
				'ajax': {
				    'url':'today/', 
				    'headers': {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            },
		            'data': function(data){
				          // Read values
							data.installer_select_id = $('#installer_select_id').val();
				            data.install_date = $('#install_date').val();
				           },
				},
				
				aoColumns: [
		        { mData: 'jobs.id' },
		        { mData: 'jobs.pro_address' },
		        { mData: 'jobs.suburb' },
		       
		        { mData: 'install_date',
		       
		            "render": function (data, type, row) {
						//let date = new Date(data);
						//return date.getDate() + "-" + months[date.getMonth()] + "-" + date.getFullYear();
						return data;
					}
				},
		        { mData: 'jobs.install_status' ,
					"render": function (data, type, row) {
						if(data == 1){   
							return 'REQUESTED';
						}else if(data == 2){
							return 'ARTWORK CREATED';
						}else if(data == 3){
							return 'ARTWORK APPROVED';
						}else if(data == 4){
							return 'PRINTED';
						}else if(data == 5){
							return 'INSTALLED';
						}else if(data == 6){
							return 'REMOVAL REQUEST';
						}else if(data == 7){
							return 'REMOVED';
						}else if(data == 8){
							return 'TASK REQUESTED';
						}else if(data == 9){
							return 'NOT INSTALLED';
						}else if(data == 10){
							return 'CANCELLED';
						}else if(data == 11){
							return 'NOT REMOVED';
						}else{
							return 'N/A';
						}
					}
				},
				{mData : 'position'},
		        ],
				"createdRow": function(row, data, dataIndex) {
					  $(row).css("background-color", "#bedebe");
					 //add id to row
					  $(row).attr('data-id', data.id);
				},
				
				
			});
			$('#installerPrioritySubmitSearch').click(function(){
			     $('.data_table_priority').DataTable().draw(true);
			    });

			/**
			 * Move Priority datatable rows to set priority
			 */
			    
			$('.data_table_priority tbody').sortable({
				 stop: function() {
					var selectedData  = new Array();
					$('.data_table_priority tbody > tr').each (function(){
						selectedData.push($(this).attr("data-id"));
					});
					  updateOrder(selectedData);
				}
			});
			
			function updateOrder(data) {
		        $.ajax({
		            url:"setPriority",
		            'headers': {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					   },
		            type:'post',
		            data:{position:data},
		            success:function(){
		             
		            },
		            error: function(data){
	                    console.log(data);
	                    alert(data);
	                }
		        })
			}
		    
	/* 
	*Upload Artworks (ADMIN)
	*
	*/
	   $('#artwork_form').submit(function(e) {
            e.preventDefault();
            var job_id = $('#job_id').val();
            var formData = new FormData(this);
            formData.append('job_id', job_id);
            $.ajax({
                type:'POST',
                url: 'upload-artwork',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
					location.reload();
                },
                error: function(data){
                    console.log(data);
                }
            });
        });

	
	
	/* 
	*INSTALL STATUS STATUS BAR 
	*
	*/	
		
	var	state = $("#install_state").val()-1;
	var	steps = $(".step");
	$.each( steps, function( i ) { 
			if (!jQuery(steps[state]).hasClass('current') && !jQuery(steps[state]).hasClass('done')) {
				jQuery(steps[state]).addClass('current');
				jQuery(steps[state - 1]).removeClass('current').addClass('done');
				return false;
			}
	});		
	/**
	 * Install Picture Upload 
	 */
	$('.install_pic_check').on('click',function(){
		var stat = $("#install_pic_check").is(':checked') ? '1' : '0';
		
		if(stat == '1'){
			$(".install_pic").trigger("click");
		}else{
			$(".install_pic").val('');
			window.reset = function (e) {
			 e.wrap('.install_pic').closest('form').get(0).reset();
			 e.unwrap();
		    }
		}
	});
	/**
	 * install pic validation
	 */
	
	// $('#install_pic').bind("change",function() { 
		// var a = (this.files[0].size);
		// if(a < 5000000){
	        // $('#install_check').html('');
	        // $('#install_check').css('display','none');
	      // }
	// });
	
	
	
	 $('.job_new_form').submit(function(event){
			if($('.install_pic_check').is(":checked")){
				var a = $('.install_pic')[0].files[0].size;
				var ext = $('.install_pic').val().split('.').pop().toLowerCase();
				 if ($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1){
       
             event.preventDefault(); 
             $('#install_check').html('Invalid file type, Accept only PNG, JPG, JPEG');
	            //$('.install_pic_check').prop('checked',false);
	            $('#install_check').show();
	            return false;
				}
				// if(a > 5000000) {
					// event.preventDefault(); 
					// $('#install_check').html('Your image greater than 5MB.');
					
					// $('#install_check').show();
				// }
			}

	    });
		
	/* 
	*Datepicker
	*
	*/
	
	$( ".install_date" ).datepicker({
		dateFormat  : 'dd/mm/yy',
		changeMonth : true,
		changeYear  : true,
		minDate     : 0
	});
	
	/* 
	*Save Installer
	*
	*/
	 $('#installation_form').submit(function(e) {
            e.preventDefault();
			var date = $('#install_date').val();
            var user = $('#installer').val();
            var job_id = $('#job_id').val();
            var formData = new FormData(this);
            formData.append('job_id', job_id);
			if(date && user){
            $.ajax({
                type:'POST',
                url: 'select-installer',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
					if(data.success == 'notPrint'){
					$('#installer_success').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Printing not Completed!</div>');
					}
					if(data.success == 'selected'){
					$('#installer_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Installer Inserted!</div>');
					
					window.location.reload();
					
					}
					
					if(data.success == 'updated'){
					$('#installer_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Installer Updated!</div>');
					
					window.location.reload();
					
					}
					if(data.success == 'already'){
					$('#installer_success').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> Installer Already Inserted!</div>');	
					}
                },
                error: function(data){
                    console.log(data);
                }
            });
			}else{
				$('.install_error').show();
				$('.install_error').html('Input fields cannot be left empty');
			}
        });
		
	 /* 
		*Datepicker
		*
		*/
		
		$( ".remove_date" ).datepicker({
			dateFormat  : 'dd/mm/yy',
			changeMonth : true,
			changeYear  : true,
			minDate     : 0
		});
		
		/* 
	*Save Removal
	*
	*/
	 $('#removal_form').submit(function(e) {
            e.preventDefault();
			var date = $('#remove_date').val();
            var user = $('#removal').val();
            var job_id = $('#job_id').val();
            var formData = new FormData(this);
            formData.append('job_id', job_id);
			if(date && user){
            $.ajax({
                type:'POST',
                url: 'select-removal',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
					if(data.success == 'selected'){
					$('#removal_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Removal Inserted!</div>');
					}
					if(data.success == 'updated'){
					$('#removal_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Removal Updated!</div>');
					}
					if(data.success == 'already'){
					$('#removal_success').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> Removal Already exist!</div>');	
					}
					if(data.success == 'notRemovalRequest'){
					$('#removal_success').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> Client not requested for Removal!</div>');	
					}
                },
                error: function(data){
                    console.log(data);
                }
            });
			}else{
				$('.install_error').show();
				$('.install_error').html('Input fields cannot be left empty');
			}
        });
	/* 
	*Printing Status
	*
	*/
	$('#printing_status').on('click',function(){
		$.confirm({
		    title: 'Are you sure?',
		    
		    buttons: {
		        Yes: function () {
		        	print_complete();
		        },
		        No: function () {
		            print_cancel();
		        },
		        
		    }
		});
	});
	function print_cancel(){
		
		document.getElementById("printing_status").checked = false;
	}
	function print_complete(){
		var job_id = $('#job_id').val();
		var stat = $("#printing_status").is(':checked') ? '1' : '0';
		
		$.ajax({
                type:'POST',
                url: 'printing-done',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
                data: {"job_id" : job_id , "state" : stat},
                success: (data) => {
                    if(data.success == 'unaccepted'){
					$("#printing_status").prop('checked', false);	
					
					$('#printing_success').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Artwork not accepted!</div>');
					}
					if(data.success == 'completed'){
					$('.printing_span').html('PRINTING COMPLETED');
					$('#printing_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Printing Completed!</div>');
					}
					if(data.success == 'incompleted'){
				    $('.printing_span').html('PRINTING INCOMPLETED');
					$('#printing_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Printing  InCompleted!</div>');	
					}
                },
                error: function(data){
                    console.log(data);
                }
            });
		
	}
	
	/* 
	*Artwork not required then automatically approve the install status
	*
	*/
	$('#artwork_required').on('click',function(){
		var job_id = $('#job_id').val();
		var stat = $("#artwork_required").is(':checked') ? '1' : '2';
		
		$.ajax({
                type:'POST',
                url: 'artwork-not-required',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
                data: {"job_id" : job_id , "state" : stat},
                success: (data) => {
                	if(data.success == 'required'){
    					$('#artwork_not_required_danger').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Artwork Required!</div>');	
    					}
					if(data.success == 'notRequired'){
					$('#artwork_not_required_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Artwork Not Required!</div>');
					}
					
                },
                error: function(data){
                    console.log(data);
                }
            });
		
	});
/**
 * artwork not required is ticked then disable upload artwork section
 */
	    $('#artwork_required').change(function () {
	        if (!this.checked) {
	        $('#upload_artwork').fadeIn('slow');
	        }
	        else {
	            $('#upload_artwork').fadeOut('slow');
	        } 
	        });
	    
	    
	    /**
	     * Task Installer Datepicker
	     */
	    
		$( ".task_installer_date" ).datepicker({
			dateFormat  : 'dd/mm/yy',
			changeMonth : true,
			changeYear  : true,
			minDate     : 0
		});
		
		 /**
		  * Other task Installer on jobs view save 
		  */
		 $('.taskInstaller').submit(function(e) {
	            e.preventDefault();
				var values = {};
				$.each($(this).serializeArray(), function (i, field) {
					values[field.name] = field.value;
				});

				//Value Retrieval Function
				var getValue = function (valueName) {
					return values[valueName];
				};
				var key = getValue("key");
				
				var date = $('#task_installer_date'+key).val();
	            var user = $('#task_installer'+key).val();
				
	            var job_id = $('#job_id').val();
	            var formData = new FormData(this);
	            formData.append('job_id', job_id);
				if(date && user){
	            $.ajax({
	                type:'POST',
	                url: 'task-installer',
					'headers': {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					   },
	                data: formData,
	                cache:false,
	                contentType: false,
	                processData: false,
	                success: (data) => {
	                  //  this.reset();
						if(data.success == 'selected'){
							$('#task_installer_success'+key).html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Installer Inserted!</div>');
							location.reload();
						}
						if(data.success == 'updated'){
							$('#task_installer_success'+key).html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> Installer Updated!</div>');	
						}
						if(data.success == 'already'){
							$('#task_installer_success'+key).html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-times"></i> Installer Already Inserted!</div>');	
						}
					
	                },
	                error: function(data){
	                    console.log(data);
	                }
	            });
				}else{
					$('.task_install_error').show();
					$('.task_install_error').html('Input fields cannot be left empty');
				}
	        });
			
		/**
		  * Get artwork templates
		 */
		$(document).on('click', ".load_template_users", function(e) {
			
			$(".success_msg").hide();
			e.preventDefault();
			var template_id 	= $(this).attr("data-tempid");
			var template_name 	= $(this).attr("data-tempname");
			 $('#selected_template_id').val(template_id);

			$.ajax({
				url: 'artwork/get-artworktemp',
				type: "POST",
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
				data:{
					template_id: template_id,
				},
				success: (data) => {
					
					$(".template_name").text(template_name);
					$(".body_data").html(data);
					$("#artwork_template").modal('show');
				}
					
			});
			
			
		});
		
	/**
	  * assign template to users
	 */	
	$('#assign_template_form').submit(function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: 'artwork/assign-artworktemp',
			type: "POST",
			'headers': {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			   },
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			success: (data) => {
				
				//$(".success_msg").show();
				$("#artwork_template").modal('hide');
			}
				
		});
			

	});

	
});