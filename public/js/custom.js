/* 
*Website Custom Js
*
*/
jQuery(document).ready(function() {
	
	const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
	/* 
	*Jobs Datatables
	*
	*/
	var dataTable = $('.data_table').DataTable({
		 "pageLength": 100,
		// 'processing': true,
		'serverSide': true,
		'order': [[0, 'desc']],
		"columnDefs": [
           {"className": "dt-center", "targets": "_all", "defaultContent": '-'}
        ],
		'serverMethod': 'post',
		'ajax': {
		    'url': BASE_URL+'/get-jobs',
		    'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			'data': function(data){
          // Read values
				
			var val = $('#showAllCheckbox').is(':checked')?1:"";
			data.showAll = val;
			
           },
		},
		aoColumns: [
		{ mData: "id" },
        { mData: 'pro_address' },
        { mData: 'suburb' },
        { mData: 'pro_type',
			"render": function (data, type, row) {
				return job_pro_type[data];
			}
		},
        { mData: 'sign_type' ,
		"render": function (data, type, row) {
				return job_sign_type[data];
			}
		},
        { mData: 'size' ,
		"render": function (data, type, row) {
				return sizes[data];
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
			"render": function (id, row) {
			    var view_button = '<a href="/jobs/'+id+'" title="View" class="view"><i class="fas fa-eye"></i></a> ';
			  return view_button;
			}
		},
        ],
		
	});
	

	    /**
	     * installer data table default sorted by suburb (a-z)
	     */
		var dataTable2 = $('.data_table_installer').DataTable({
			 "pageLength": 100,
			// 'processing': true,
			'serverSide': true,
			'order': [[10, 'asc']],
			"columnDefs": [
	           {"className": "dt-center", "targets": "_all", "defaultContent": '-'},
	           {
                   "targets": [8,9,10],
                   "visible": false,
                   "searchable": false
               },        
           
	        ],
			'serverMethod': 'post',
			'ajax': {
			    'url': BASE_URL+'/get-jobs',
			    'headers': {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
				'data': function(data){
	          // Read values
					
			 data.installstatus = $('#installStatusFilter').val();
				var val = $('#showAllCheckbox').is(':checked')?1:"";
	        //    data.showAll = val;
				
	           },
			},
			aoColumns: [
			{ mData: "jobs.id" },
			{ mData: "jobs.users.name" },  
	        { mData: 'jobs.pro_address' },
	        { mData: 'jobs.suburb' },
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
			{ mData: 'type' ,
				"render": function (data, type, row) {
					if(data == 0){   
						return 'TYPE INSTALL';
					}else if(data == 1){
						return 'TYPE REMOVAL';
					}else{
						return 'N/A';
					}
				}
			},
			{ mData: 'other_task_id' ,
				"render": function (data, type, row) {
					if(data == null){   
						return 'NO';
					}else{
						return 'YES';
					}
				}
			},
			{ "data": "id" ,
				"searchable": false,
				"sortable": false,
				"render": function (id, row) {
				    var view_button = '<a href="/jobs/'+id+'" title="View" class="view float-right"><i class="fas fa-eye"></i></a> ';
				  return view_button;
				}
			},
			{ mData: "jobs.latitude" },
			{ mData: "jobs.longitude" },
			{ mData: "position" },
	        ],
			
		});

		
	    
			    
		/**
		 *  Data Table Row  href   with googlemap link on address
		 */
		  var table = $('.hrefDataTable').DataTable();
		    $('.hrefDataTable tbody').on('click', 'tr', function (evt) {
		   	 var job = table.row( this ).data(); 
		    	window.open(' /jobs/'+job.id+' ','_self');
//		    	   var $cell=$(evt.target).closest('td');
//		    	    if( $cell.index()== 1){
//		   		      window.open('http://maps.google.co.uk/maps?q='+job.jobs.latitude+ ',' +job.jobs.longitude);
//
//		    	}
		    } );

	/* 
	*Homepage Show All Jobs Checkbox 
	*
	*/
	
	$('#showAllCheckbox').on( 'change', function () {
		if($(this).is(':checked')){
			$('.job_heading').html('All Jobs');
			val = 1;
			console.log(val);
		}else{
			$('.job_heading').html('Active Jobs');
			val = 0;  
			console.log(val);
		}
          
        dataTable.draw();
    } );
	
	
	/* 
	*Show Jobs with selected dates datatables Admin side
	*
	*/
	$('#btnFiterSubmitSearch').click(function(){
		$('.data_table_admin').DataTable().draw(true);
    });
	/**
	 * display jobs as per selected state
	*/
	
	$('#installStatusFilter').on('change',function(){
		$('.data_table').DataTable().draw(true);
	});
	
	
	/* 
	*Open Model On click datatable row (ADMIN)
	*
	*/
	$('.data_table_admin tbody').on('click', 'tr', function () {
        var job = dataTable2.row(this).data();
		$.ajax({
               'type':'POST',
               'url':'jobs/get-single-job','headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               'data':{job_id : job.id},
               success:function(data) {
                  $("#modalhtml").html(' ');
                  $("#modalhtml").html(data);
				  $('#jobModal').modal('show');
               }
        });
		
		
    });   
	
	/* 
	*Zoom Library
	*
	*/
	// $('#artwork_zoom').zoom();
	// $('#artwork_zoom_click').zoom({ on:'click' });	
	$('.zoo-item').ZooMove({
		cursor: 'true',
		scale: '1.2',
	});

	
	$('.artwork_decline').on('click',function(){
		$('#CommentModal').modal('show');
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
	 * Install Picture Upload trigger on radio click
	 */
	$('.install_pic_check').on('click',function(){
		// var stat = $("#install_pic_check").val();
		var stat = $('input[name="install_pic_check"]').val()
		if(stat == '1'){
			$(".install_pic").trigger("click");
		}
	});
	/**
	 * Reference Picture Upload 
	 */
	$('.reference_pic_check').on('click',function(){
		// var state = $("#reference_pic_check").val();
		var state = $('input[name="reference_pic_check"]').val();
		if(state == '1'){
			$(".reference_pic").trigger("click");
		}
//		}else{
//			$(".reference_pic").val('');
//			window.reset = function (e) {
//			 e.wrap('.refernce_pic').closest('form').get(0).reset();
//			 e.unwrap();
//		    }
//		}
	});
	
	// $('#install_pic').bind("change",function() { 
		// var a = (this.files[0].size);
		// if(a < 5000000){
	        // $('#install_check').html('');
	        // $('#install_check').css('display','none');
	      // }
	// });
	// $('#reference_pic').bind("change",function() { 
		// var a = (this.files[0].size);
		// console.log(a);
		// if(a < 5000000){
	        // $('#reference_check').html('');
	        // $('#reference_check').css('display','none');
	      // }
	// });
	
	
	$('#artwork_type').bind("change",function() {
		var selected =  $(this).val();
		
		if(selected == '1'){
			$('.upload_artwork_file').hide();
			$('.artwork_template').hide();
			$(".artwork_template").prop('required',false);
		}else if(selected == '2'){
			$('.artwork_template').hide();
			$('.upload_artwork_file').show();
			$(".artwork_template").prop('required',false);
			
		}else if(selected == '3'){
			$('.upload_artwork_file').hide();
			$('.artwork_template').show();
			$(".artwork_template").prop('required',true);
		}
	});
	
	$("#editArtwork").click(function () {
		$(".success_msg").hide();
		$("#artworkModel").modal('show');
	});
	/* $("#artwork_ready_checkbox").click(function () {
		if ($(this).is(":checked")) {
			$(".edit_template").hide();
		} else {
			$(".edit_template").show();
		}
	}); */
	
	$("#viewEditArtwork").click(function () {
		load_template_data('view_job');
	});
		
	$('#artwork_template, input[type=radio][name=editor_type]').bind("change",function() {
	
		load_template_data('create_job');
		
	});
	
	function load_template_data(page){
		
		$(".success_msg").hide();
		$("#editArtwork").show();
		var template_id = $("#artwork_template").val(); 
		var login_user_id = $("#login_user_id").val(); 
		if($(this).hasClass('artwork_template')){
			var editor_type = 0;
		}else{
			var editor_type = $('input[type=radio][name="editor_type"]:checked').val();
		}
		//console.log(editor_type);
		tinymce.remove('#artwork_editor');
		//	tinyMCE.activeEditor.setContent('');
		var menubar_show 	= false;
		var tool_bar 		= "preview | undo redo | image code | sizeselect |  fontsizeselect export";

		var load_plugin = [
							'image preview',
							'lists noneditable',
						 ];
		if(editor_type == '1'){
			
			var menubar_show = true;
			var load_plugin = [
							'advlist autolink lists link image charmap print preview anchor',
							'searchreplace fullscreen',
							'contextmenu paste code noneditable', 
						 ];
		}
		
		if(template_id){
	
			//if(template_id == '4' || template_id == '5' || template_id == '6' || template_id == '7' || template_id == '8' || template_id == '9' || template_id == '10'  || template_id == '11'){
				
				var width = 918;
				
				if(editor_type == '1'){
					/* if(template_id == 8){
						var height = 1360;
					}else{
						var height = 1239;
					} */
					var height = 1239;
					
				}else{
					
				/* 	if(template_id == 8){
						var height = 1335;
					}else{
						var height = 1200;
					} */
					var height = 1200;
				}
				
				
				tinymce.init({
					fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt 100pt 110pt",
					selector: '#artwork_editor',
					plugins: load_plugin, 
					toolbar: tool_bar, 
					menubar: menubar_show, 
					width: width, 
					height: height, 
					content_css : BASE_URL+"/css/tinymce.css",
					//statusbar: false,
					image_description: false,
					image_dimensions: false,
					object_resizing : false,
					noneditable_noneditable_class: 'non-editable',				
					//content_style:
					//"@import url('https://fonts.googleapis.com/css2?family=Amaranth:wght@400;700&display=swap'); body { font-family: 'Amaranth', sans-serif; }"
					setup: function (editor) {
							editor.on('click', function (e) {
								if (e.target.nodeName.toLowerCase() == 'img') {
									setTimeout( function() {
										$(".tox-tbtn--enabled").trigger("click"); 	// to trigger click on image hover
									}, 1000);
									setTimeout( function() {						//to click upload button instead of general
										jQuery('.tox-dialog__body-nav').find('.tox-dialog__body-nav-item.tox-tab').trigger('click');
									}, 1000);  
								}
							});
							editor.on('ExecCommand', function (e) {              //to set the same font-size of bullets on font-size change
								if(e.command == 'FontSize') {
									let val 	= e.value;
									let node 	= e.target.selection.getNode();
									let nodeParent = node.parentNode;
									if ( nodeParent.nodeName === 'LI') {
										editor.dom.setStyle(nodeParent, 'font-size', val);
									
									} 
								}
							});
							editor.on('change', function (e) {
					
								var change_image  = getimageCookie("change_image"); 
								if(change_image == '1'){
									var imgsrc = tinyMCE.activeEditor.selection.getNode().src;
									jQuery("#uploaded_img").attr('src',imgsrc+"?refresh=" + new Date().getTime());
									setTimeout( function() {
										jQuery('#artwork_editor_crop').modal('show');
									}, 1000);
									setimageCookie("change_image", "0", 1);
								}
							});
						},
						images_upload_handler:function (blobInfo, success, failure, progress) {
							var xhr, formData;
							xhr = new XMLHttpRequest();
							xhr.withCredentials = false;
							xhr.open('POST', BASE_URL+'/upload-artworkimg');
							xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
							xhr.upload.onprogress = function (e) {
								progress(e.loaded / e.total * 100);
							};
							xhr.onload = function() {
								var json;
								if (xhr.status === 403) {
								  failure('HTTP Error: ' + xhr.status, { remove: true });
								  return;
								}

								if (xhr.status < 200 || xhr.status >= 300) {
								  failure('HTTP Error: ' + xhr.status);
								  return;
								}

								json = JSON.parse(xhr.responseText);

								if (!json || typeof json.location != 'string') {
								  failure('Invalid JSON: ' + xhr.responseText);
								  return;
								}
								success(json.location);
								// to show crop option after change image
								//if(jQuery('.mce-floatpanel.mce-window').is(":visible") && jQuery('.mce-floatpanel.mce-window').attr('aria-label')=="Insert/edit image"){
								if(jQuery('.tox-dialog__header').is(":visible")){
									setimageCookie("change_image", "1", 1);
								}else{
									setimageCookie("change_image", "0", 1);
								}	
								
							};

							xhr.onerror = function () {
								failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
							};

							formData = new FormData();
							formData.append('file', blobInfo.blob(), blobInfo.filename());

							xhr.send(formData);
						}
				});
				
			//}
			
			/* else if(login_user_id == 81){
					tinymce.init({
						selector: '#artwork_editor',
						width: 850, 
						height: 1200, 
						plugins:load_plugin,
						content_css : BASE_URL+"/css/tinymce.css",
						//imagetools_toolbar: "rotateleft rotateright | flipv fliph ",
						toolbar: tool_bar,
						menubar:menubar_show,
						statusbar: false,
						image_description: false,
						image_dimensions: false,
						object_resizing : false,
						content_style:
						"@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap'); body { font-family: Open Sans', sans-serif; }",
						setup: function (editor) {						
							editor.on('click', function (e) {
								if (e.target.nodeName.toLowerCase() == 'img') {
									setTimeout( function() {
										$(".tox-tbtn--enabled").trigger("click"); 	// to trigger click on image hover
									}, 1000);
									setTimeout( function() {						//to click upload button instead of general
										jQuery('.tox-dialog__body-nav').find('.tox-dialog__body-nav-item.tox-tab').trigger('click');
									}, 1000);  
								}
							});
							editor.on('change', function (e) {
					
								var change_image  = getimageCookie("change_image"); 
								if(change_image == '1'){
									var imgsrc = tinyMCE.activeEditor.selection.getNode().src;
									jQuery("#uploaded_img").attr('src',imgsrc+"?refresh=" + new Date().getTime());
									setTimeout( function() {
										jQuery('#artwork_editor_crop').modal('show');
									}, 1000);
									setimageCookie("change_image", "0", 1);
								}
							});
						},
						images_upload_handler:function (blobInfo, success, failure, progress) {
							var xhr, formData;
							xhr = new XMLHttpRequest();
							xhr.withCredentials = false;
							xhr.open('POST', BASE_URL+'/upload-artworkimg');
							xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
							xhr.upload.onprogress = function (e) {
								progress(e.loaded / e.total * 100);
							};
							xhr.onload = function() {
								var json;
								if (xhr.status === 403) {
								  failure('HTTP Error: ' + xhr.status, { remove: true });
								  return;
								}

								if (xhr.status < 200 || xhr.status >= 300) {
								  failure('HTTP Error: ' + xhr.status);
								  return;
								}

								json = JSON.parse(xhr.responseText);

								if (!json || typeof json.location != 'string') {
								  failure('Invalid JSON: ' + xhr.responseText);
								  return;
								}
								success(json.location);
								// to show crop option after change image
								//if(jQuery('.mce-floatpanel.mce-window').is(":visible") && jQuery('.mce-floatpanel.mce-window').attr('aria-label')=="Insert/edit image"){
								if(jQuery('.tox-dialog__header').is(":visible")){
									setimageCookie("change_image", "1", 1);
								}else{
									setimageCookie("change_image", "0", 1);
								}	
								
							};

							xhr.onerror = function () {
								failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
							};

							formData = new FormData();
							formData.append('file', blobInfo.blob(), blobInfo.filename());

							xhr.send(formData);
						}
					});
					
			}else if(login_user_id == 3){
					
					tinymce.init({
						selector: '#artwork_editor',
						plugins: load_plugin, 
						toolbar: tool_bar,
						menubar: menubar_show,
						width: 850, 
						height: 1200,
						content_style:
						"@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap'); body { font-family: Montserrat', sans-serif; }",
					});
					
			} */
			
			
			if(page == 'view_job'){
				var job_id = $("#artwork_template").attr("data-jobid");
				var ajax_data = {job_id: job_id, template_id: template_id};
			}else{
				var ajax_data = {job_id: '', template_id: template_id};
			}
			
			$.ajax({
				type:'POST',
				url: BASE_URL+'/artwork-template',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
				data: ajax_data,
				success: (data) => {
					
					//tinyMCE.execCommand('mceAddControl', true, 'artwork_editor');
					$('#artworkModel').modal('show');
					setTimeout( function() {
						tinymce.activeEditor.setContent(data);
					}, 1000);
					
					/*  if(editor_type == '1'){
			
						setimageCookie("advanced", "1", 1);
						var footer = $("iframe").contents().find("body .template_footer");
						var bottom = $("iframe").contents().find("body .template_footer").css( "bottom" );
						
						var bottom_len 	= bottom.replace("px", "");
						bottom_len 		= parseInt(bottom_len) - 39;
						footer.css("bottom", bottom_len+'px'); 
						debugger;
									 
					}else{
						var footer = $("iframe").contents().find("body .template_footer");
						var advanced  = getimageCookie("advanced"); 
						if(advanced == '1'){
							var bottom = $("iframe").contents().find("body .template_footer").css( "bottom" );
							 var bottom_len 	= bottom.replace("px", "");
							bottom_len 		= parseInt(bottom_len) + 39;
							footer.css("bottom", bottom_len+'px'); 
						} 
						
					}  */
									
					//$('.radio_btn1').attr("checked", true).trigger("click"); 
				},
				error: function(data){
					console.log(data);
				}
			});
			
			
				
		}
		
	}
	
	/**
	 * Save image of template
	*/
	$("#uploadArtwork").click(function () {
	//document.getElementById("uploadArtwork").addEventListener("click", function() {
		
		var bottom = $("iframe").contents().find("body .template_footer").css( "bottom" );
		var footer = $("iframe").contents().find("body .template_footer");
		footer.css("position",'relative');
		footer.css("bottom",'0px');
		
		var job_id = $("#artwork_template").attr("data-jobid");
		body = $('iframe').contents().find('body .template')[0];
		html2canvas(body,
		{	
			scale: 5,
			allowTaint: true,
			useCORS: true
		}).then(function (canvas) {
			var anchorTag = document.createElement("a");
			document.body.appendChild(anchorTag);
			anchorTag.href = canvas.toDataURL("image/png");
			var dataURL = canvas.toDataURL();
			$("#artwork_template_img").val(dataURL);
			$("#artwork_template_markup").val(body.outerHTML);
			
			$(".success_msg").show();
						
			/* var myImage = canvas.toDataURL("image/jpeg,1.0");

			var pdf = new jsPDF('p', 'mm', 'a4');
			pdf.addImage(myImage, 'png', 0, 0, 215, 300); 
			
			var blobdata = pdf.output('blob');

			var formData = new FormData();
            formData.append('pdf_file', blobdata);
			
			if(typeof(job_id) != 'undefined'){
				formData.append('job_id', job_id);
			}
	
			$.ajax({
				url: BASE_URL+'/upload-artworkpdf',
				type: "POST",
				processData: false,
				cache:false,
				contentType: false,
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
				data:formData,
				success: (data) => {
					console.log('uploaded');
					$("#artwork_template_pdf").val(data.pdfname);
					//location.reload();
				}
			});	 */
			
						
			if(typeof(job_id) != 'undefined'){
				
				$.ajax({
					url: BASE_URL+'/update-artworktemp',
					type: "POST",
					'headers': {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					   },
					data:{
						job_id: job_id,
						dataURL: dataURL,
						template_markup: body.outerHTML
					},
					success: (data) => {
						
						footer.css("position",'fixed');
						footer.css("bottom", bottom);
						
						var imgurl = $("#artwotk_image").attr("src");
						$("#artwotk_image").removeAttr("src"); 
						$("#artwotk_image").attr("src", imgurl);
						$(".success_msg").show();
						setTimeout( function(){
							$("#artworkModel").modal('hide');
							location.reload();
						}, 1000);
						console.log('saved');
					}
						
				});
				
			}else{
				setTimeout( function(){
					$("#artworkModel").modal('hide');
					
				}, 1000);
			}
		});
	}); 
	
	/**
	 * Save image of template
	*/
	$("#downloadArtwork").click(function () {
	//document.getElementById("downloadArtwork").addEventListener("click", function() {
		
		var bottom = $("iframe").contents().find("body .template_footer").css( "bottom" );
		var footer = $("iframe").contents().find("body .template_footer");
		footer.css("position",'relative');
		footer.css("bottom",'0px');
		
		body = $('iframe').contents().find('body .template')[0];
		html2canvas(body,
		{	
			//dpi: 144,
			scale: 3,
			allowTaint: true,
			useCORS: false,
			logging: true,
		}).then(function (canvas) {
			
			footer.css("position",'fixed');
			footer.css("bottom", bottom);
			
			var anchorTag = document.createElement("a");
			document.body.appendChild(anchorTag);
			anchorTag.download = "artwork-template.png";
			anchorTag.href = canvas.toDataURL("image/png");
			//anchorTag.href = canvas.toDataURL("image/png,1.0");
			var dataURL = canvas.toDataURL();
			anchorTag.target = '_blank';
			anchorTag.click();
				  				
								
			/* var myImage = canvas.toDataURL("image/jpeg,1.0");
			var pdf = new jsPDF('p', 'mm', 'a4');
			pdf.addImage(myImage, 'png', 0, 0, 215, 300); 
			
			var blobdata = pdf.output('blob');
			pdf.save('artwork-temppdf.pdf');  */
		});
	}); 
	
		
	
	
	/**
	 * custom cropper function
	*/		
	$(document).ready(function(){
		
		var $modal = $('#artwork_editor_crop');
		var image = document.getElementById('uploaded_img');

		var cropper;
		$modal.on('shown.bs.modal', function() {
			var imgwidth  = tinyMCE.activeEditor.selection.getNode().width;
			var imgheight = tinyMCE.activeEditor.selection.getNode().height;
			debugger;   
			var minwidth  = imgwidth - 150;
			var minheight  = imgheight - 100;
			var asp  = 8;
			if(imgwidth < 600){
				
				var asp  = 14;
			}
			cropper = new Cropper(image, {
				autoCropArea: 0,
				//aspectRatio: 16 / asp,
				aspectRatio: imgwidth / imgheight,
				//cropBoxResizable:false,
				minCropBoxWidth: minwidth,
				minCropBoxHeight: minheight,
				resize:true,
				strict: true,
				highlight: false,
				dragCrop: false,
				zoomable: true,
				zoomOnTouch: true,
				zoomOnWheel: true,
				viewMode: 3,
				dragMode: 3,
				preview:'.preview',
				ready: function () {
					//Should set crop box data first here
					cropper.setCropBoxData({
						width: imgwidth,
						height: imgheight 
					});
				}
			});
		}).on('hidden.bs.modal', function(){
			cropper.destroy();
			cropper = null;
		});
		
		/**
		 * Crop image click function
		*/	
		$('#crop').click(function(){
			
			$(".loader").show();
			canvas = cropper.getCroppedCanvas();
			canvas.toBlob(function(blob){
				url = URL.createObjectURL(blob);
				var reader = new FileReader();
				reader.readAsDataURL(blob);
				reader.onloadend = function(){
					var base64data = reader.result;
					//tinyMCE.activeEditor.selection.getNode().src  = base64data;
					//$modal.modal('hide');
					$(".sidebar-collapse").addClass('modal-open');
					$.ajax({
						url: BASE_URL+'/artwork-cropimg',
						'headers': {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						   },
						method:'POST',
						data:{image:base64data},
						success:function(data)
						{
							tinyMCE.activeEditor.selection.getNode().src  = data+"?timestamp=" + new Date().getTime();
							setTimeout( function() {
								$(".loader").hide();
								$modal.modal('hide');
							}, 3000);
							
						}
					});
				};
			});
		});
		
	});
	
	$('#artwork_readyto_print').click(function(){
		
		if(confirm("Artwork is Ready to Print?")){
			approve_artwork();
		}
		else{
		    approve_cancel();
		}
	});
	
	function approve_cancel(){
		
		return true;
	}
	
	/**
	 * approve artwork click function
	*/	
	function approve_artwork(){
		
		var job_id 	= $("#artwork_template").attr("data-jobid");
		var approve = '1';
		$.ajax({
			url: BASE_URL+'/approve-artwork',
			'headers': {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			   },
			method:'POST',
			data: {"job_id" : job_id , "approve" : approve},
			success:function(data)
			{
				if(approve == '1'){
					$('#approve_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Artwork approved sucessfully!</div>');
					$(".artwork_approved_div").hide();
				}else{
					$('#approve_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i> Artwork not approved!</div>');
					$(".artwork_approved_div").show();
				}
				
			}
		});
	}
	
	/**
	 * set cookie function
	*/	
	function setimageCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	/**
	 * get cookie function
	*/
	function getimageCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	
	$('#install_pic').bind("change",function() {
		for(var i = 0 ; i < this.files.length ; i++){
			var fileName = this.files[i].name;
			$('.pkf-insimg').append('<div class="filessname">' + fileName + '</div>');
		}
		var a = $(this)[0].files.length;
		var dd = $('.install_pic').val();
		var s= dd.replace(/\\/g, '/');
		s = s.substring(s.lastIndexOf('/')+ 1);
		// $('.pkf-insimg').html(s); 
		if(a < 6){
	        $('#install_check').html('');
	        $('#install_check').css('display','none');
	    }else{
			$('#reference_check').html('You can select maximum 5 images.');
	        $('#reference_check').show();
		}
	});
	
	
	$('#reference_pic').bind("change",function() { 
		for(var i = 0 ; i < this.files.length ; i++){
			var fileName = this.files[i].name;
			$('.pkf-img').append('<div class="filessname">' + fileName + '</div>');
		}
		var a = $(this)[0].files.length;
		var dd = $('.reference_pic').val();
		var s= dd.replace(/\\/g, '/');
		s = s.substring(s.lastIndexOf('/')+ 1);
		// $('.pkf-img').html(s);
		if(a < 6){
			$('#reference_check').html('');
			$('#reference_check').css('display','none');
		}else{
		  $('#reference_check').html('You can select maximum 5 images.');
		  $('#reference_check').show();
		}
	});
	 
		 $('.job_new_form').submit(function(event){
			if($('.install_pic_check').is(":checked")){
				var a = $('.install_pic')[0].files.length;
				var ext = $('.install_pic').val().split('.').pop().toLowerCase();
				 if ($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1){
          
                event.preventDefault(); 
                $('#install_check').html('Invalid file type, Accept only PNG, JPG, JPEG');
	            //$('.install_pic_check').prop('checked',false);
	            $('#install_check').show();
	            return false;
				}
				if(a < 6){
					$('#reference_check').html('');
					$('#reference_check').css('display','none');
				  }else{
					event.preventDefault(); 
					$('#reference_check').html('You can select maximum 5 images.');
					$('#reference_check').show();
				  }
				
			}
			/**
			 * Reference Picture validation 
			 */
			
			if($('.reference_pic_check').is(":checked")){
				var reference = $('.reference_pic')[0].files.length;
	            var ext_reference = $('.reference_pic').val().split('.').pop().toLowerCase();
				if ($.inArray(ext_reference, ['png','jpg','jpeg','pdf']) == -1){
          
                event.preventDefault(); 
                $('#reference_check').html('Invalid file type, Accept only PNG, JPG, JPEG');
	            $('#reference_check').show();
	            return false;
				}
				
				if(reference < 6){
					$('#reference_check').html('');
					$('#reference_check').css('display','none');
				  }else{
					  event.preventDefault(); 
					  $('#reference_check').html('You can select maximum 5 images.');
						$('#reference_check').show();
				  }
				
			}
		        
	        
	    });
	    
		    
	
	/**
	 * autocomplete google api for property address
	 */
	$("#pro_address").on('focus',function(){
		googleAutocomplete();
	 });
	 function googleAutocomplete() {
		 var options = {
				  componentRestrictions: {country: "AU"}
				 };
               var input = document.getElementById('pro_address');
               var autocomplete = new google.maps.places.Autocomplete(input, options);
 		       google.maps.event.addListener(autocomplete, 'place_changed', function () {
 			   var place = autocomplete.getPlace();
 			   var latitude = place.geometry.location.lat();
               var longitude = place.geometry.location.lng();
 			   for (var i = 0; i < place.address_components.length; i++) {
 			      for (var j = 0; j < place.address_components[i].types.length; j++) {
 			         if (place.address_components[i].types[j] == "locality" ) {
 			        	 	suburb = place.address_components[i];
 			    }
 			        if (place.address_components[i].types[j] == "postal_code" ) {
			        	 	post_code = place.address_components[i];
			    }
 
 			       if (place.address_components[i].types[j] == "administrative_area_level_1" ) {
		        	 	state = place.address_components[i];
 			       	}
 			  }
 			}
 			document.getElementById("suburb").value = suburb.long_name;
 			document.getElementById("post_code").value = post_code.long_name;
 			document.getElementById("state").value = state.long_name;
 			document.getElementById("latitude").value = latitude;
 			document.getElementById("longitude").value = longitude;
         });
       }
		
	 /**
	  * Other task on jobs view save 
	  */
	  $('#otherTaskSubmit').submit(function(e) {
          e.preventDefault();
          var job_id = $('#job_id').val();
          var formData = new FormData(this);
          console.log(formData);
          formData.append('job_id', job_id);
          $.ajax({
              type:'POST',
              url: 'other-task',
				'headers': {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   },
              data: formData,
             // cache:false,
             // contentType: false,
            //  processData: false,
              success: (data) => {
                  this.reset();
                  alert('Task has been added successfully');
					location.reload();
              },
              error: function(data){
                  console.log(data);
              }
          });
      });
	  
	  
		 /**
		  * Installation Complete by installer
		  */
	  $('.completeModal').click(function() {
		  var task_id = $(this).attr('data-id'); 
		   $('#installComplete').submit(function(e) {
		   $('#upload_in_progress_installComplete').html('<div class ="uploadInProgressText"><h5>Upload in Progress...</h5></div>');	

		          e.preventDefault();
		          var job_id = $('#job_id').val();
		          $(".task_id").val(task_id);
		          var formData = new FormData(this);
		        
		         formData.append('job_id', job_id);
		          $.ajax({
		              type:'POST',
		              url: BASE_URL+'/install-complete',
						'headers': {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						   },
		              data: formData,
		              processData: false,
		              cache:false,
		              contentType: false,
		              success: (data) => {
		                  this.reset();
	  					$('#install_complete_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="fas fa-check"></i>Installation Completed Successfully!</div>');	
                      location.reload();
		              },
		              error: function(data){
		                  console.log(data);
		              }
		          });
		      });
		});
	  
	  /**
		  * Installation Not Complete by installer
		  */
	  $('.notInstalledModal').click(function() {
		  var task_id = $(this).attr('data-id'); 
		   $('#installNotComplete').submit(function(e) {
		          e.preventDefault();
		          var job_id = $('#job_id').val();
		          $("#other_task_id").val(task_id);
		          var formData = new FormData(this);
		        
		         formData.append('job_id', job_id);
		          $.ajax({
		              type:'POST',
		              url: BASE_URL+'/install-not-complete',
						'headers': {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						   },
		              data: formData,
		             processData: false,
		              cache:false,
		              contentType: false,
		              success: (data) => {
	  				location.reload();
		              },
		              error: function(data){
		                  console.log(data);
		              }
		          });
		      });
	  });
	  
	  /**
	   * display current time
	   */
	  function showTime() {
		  var date = new Date();
		  var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
		  var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	      var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
	      var am_pm = date.getHours() >= 12 ? "PM" : "AM";
		    time = hours + ":" + minutes + ":" + seconds + " " + am_pm;
		    document.getElementById('openClockDisplay').innerHTML = time;
		  }
		  setInterval(showTime, 1000);	

	/*
	Datepicker
	*/
	$( "#preferred_install_date" ).datepicker({
		dateFormat  : 'dd/mm/yy',
		changeMonth : true,
		changeYear  : true,
		minDate     : 0
	});
      
});