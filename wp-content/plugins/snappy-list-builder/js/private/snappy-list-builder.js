// wait until the page and jQuery have loaded before running the code below
jQuery(document).ready(function($){
	
	// setup our wp ajax URL
	var wpajax_url = document.location.protocol + '//' + document.location.host + '/wp-admin/admin-ajax.php';
	
	// stop our admin menus from collapsing
	if( $('body[class*=" slb_"]').length || $('body[class*=" post-type-slb_"]').length ) {

		$slb_menu_li = $('#toplevel_page_slb_dashboard_admin_page');
		
		$slb_menu_li
		.removeClass('wp-not-current-submenu')
		.addClass('wp-has-current-submenu')
		.addClass('wp-menu-open');
		
		$('a:first',$slb_menu_li)
		.removeClass('wp-not-current-submenu')
		.addClass('wp-has-submenu')
		.addClass('wp-has-current-submenu')
		.addClass('wp-menu-open');
		
	}
	
	// wp uploader
	// this adds WordPress's file uploader to specially formatted html div.wp-uploader
	// here's an example of what the html should look like this... 
	/*
	<div class="wp-uploader">
	    <input type="text" name="input_name" class="file-url regular-text" accept="jpg|gif">
	    <input type="hidden" name="input_name" class="file-id" value="0" />
	    <input type="button" name="upload-btn" class="upload-btn button-secondary" value="Upload">
	</div>	
	*/
	$('.wp-uploader').each(function(){
		
		$uploader = $(this);
		
		$('.upload-btn',$uploader).click(function(e) {
	        e.preventDefault();
	        var file = wp.media({ 
	            title: 'Upload',
	            // mutiple: true if you want to upload multiple files at once
	            multiple: false
	        }).open()
	        .on('select', function(e){
	            // This will return the selected image from the Media Uploader, the result is an object
	            var uploaded_file = file.state().get('selection').first();
	            // We convert uploaded_image to a JSON object to make accessing it easier
	            // Output to the console uploaded_image
	            var file_url = uploaded_file.attributes.url;
	            var file_id = uploaded_file.id;
	            
				if( $('.file-url',$uploader).attr('accept') !== undefined ) {
					
					
					var filetype = $('.file-url',$uploader).attr('accept');
					
					if( filetype !== uploaded_file.attributes.subtype ) {
						
						
						$('.upload-text',$uploader).val('');
						
						alert('The file must be of type: '+ filetype);
						
						
					} else {
	            
			            // Let's assign the url value to the input field
			            $('.file-url',$uploader).val(file_url).trigger('change');
			            $('.file-id',$uploader).val(file_id).trigger('change');
						
					}
					
				}
	            
	        });
	    });
    });
    
    // setup variables to store our import forms jQuery objects
    $import_form_1 = $('#import_form_1','#import_subscribers');
	$import_form_2 = $('#import_form_2','#import_subscribers');
	
	// this event triggered when import_form_1 file is selected
	$('.file-id',$import_form_1).bind('change',function(){
		
		// get the form data and serialize it
		var form_1_data = $import_form_1.serialize();
		
		// set up form_1 action url
		var form_1_action_url = wpajax_url + '?action=slb_parse_import_csv';
		
		// send the file to php for processing...
		$.ajax({
			url: form_1_action_url,
			method: 'post',
			dataType: 'json',
			data: form_1_data,
			success: function( response ) {
				
				if( response.status == 1 ) {
					
					// get return html
					$return_html = slb_get_form_2_html( response.data );
					
					// update .slb-dynamic-content with the new return html
					$('.slb-dynamic-content',$import_form_2).html($return_html);
					
					// show form 2
					$import_form_2.show();
					
				} else {
					
					// reset form 1's inputs
					$('.file-id',$import_form_1).val(0);
					$('.file-url',$import_form_1).val('');
					
					// hide form 2
					$import_form_2.hide();
					alert( response.message ); 
					
				}
			}
		});
		
	});
	
	// check if our form 2 validates on all change events
	// show and hide elements accordingly
	$(document).on('change','#import_subscribers #import_form_2 .slb-input',function(){
		
		setTimeout(function(){
			
			// if our form 2 validates
			if( slb_form_2_is_valid() ) {
				
				// show .show-only-on-valid elements
				$('.show-only-on-valid',$import_form_2).show();
				
			} else {
				
				// hide .show-only-on-valid elements
				$('.show-only-on-valid',$import_form_2).hide();
				
			}
		
		},100);
		
	});
	
	// for toggling all subscriber data on and off
	$(document).on('click','#import_subscribers #import_form_2 .check-all',function(){
		
		
		// see if our toggle is checked
		var checked = $(this)[0].checked;
		
		// if our toggle is checked
		if( checked ) {
		
			// trigger click on all inputs not checked
			$('[name="slb_import_rows[]"]:not(:checked)',$import_form_2).trigger('click');
		
		} else {
		
			// trigger click on all inputs checked
			$('[name="slb_import_rows[]"]:checked',$import_form_2).trigger('click');
			
		}
		
	});
	
	// hint: this is our ajax form handler for our import subscribers form #2
	$(document).on('submit','#import_subscribers #import_form_2',function(){
		
		// set up form 2 action url
		var form_2_action_url = wpajax_url + '?action=slb_import_subscribers';
		
		// serialize form data
		var form_2_data = $import_form_2.serialize();
		
		// post the form to our php action for processing...
		$.ajax({
			url: form_2_action_url,
			method: 'post',
			dataType: 'json',
			data: form_2_data,
			success: function( response ) {
				
				if( response.status == 1 ) {
					
					// success!
					
					// reset our import form
					$('.slb-dynamic-content').html('');
					$('.show-only-on-valid',$import_form_2).hide();
					$('.file-url',$import_form_1).val('');
					$('.file-id',$import_form_1).val(0);
					
					// return the good news...
					alert(response.message);
					
				} else {
					
					// error
					// begin building our error message text
					var msg = response.message + '\r' + response.error + '\r';
					// loop over the errors
					$.each(response.errors,function(key,value){
						// append each error on a new line
						msg += '\r';
						msg += '- '+ value;
					});
					// return the bad news...
					alert( msg );
					
				}
			}
		});
		
		// stop our form from submitting normally
		return false;
		
	});
	
	// hint: this function returns custom html for import form #2
	function slb_get_form_2_html( subscribers ) {
		
		// count the number of columns we have in our subscribers data
		var columns = Object.keys(subscribers[0]).length;
		
		// setup our return variable
		var return_html = '';
		
		// prepare select html
		var select_fname = slb_get_selector('slb_fname_column',subscribers);
		var select_lname = slb_get_selector('slb_lname_column',subscribers);
		var select_email = slb_get_selector('slb_email_column',subscribers);
		
		// build assignment html
		var assign_html = ''+
			'<p><label>First Name</label> &nbsp; '+select_fname+'</p>'+
			'<p><label>Last Name</label> &nbsp; '+select_lname+'</p>'+
			'<p><label>Email</label> &nbsp; '+select_email+'</p>';
		
		/// build row 1
		var row_1 = slb_get_form_table_row('Assign Data Column',assign_html);
		return_html += row_1;
		
		// build our data table
		var table = '<table class="wp-list-table fixed widefat striped"><thead>';
		
		var tr = '<tr>';
		var th = '<th scope="col" class="manage-column check-column"><label><input type="checkbox" class="check-all"></label></th>';
		tr += th;
			
		var column_id = 0;
			
		$.each( subscribers[0], function(key,value) {
				
			column_id++;
			
			var th = '<th scope="col">'+ key +'</th>';
			
			tr += th;	
			
		});
		
		tr += '</tr>';
		
		table += tr +'</thead>'+
		'<tbody id="the-list">';
		
		var row_id = 0;
				
		// loop over all the subscribers
		$.each( subscribers, function(index,subscriber){
			
			// increment the row_id
			row_id++;
			
			// begin html for our table row
			var tr = '<tr>';
			
			// add our first table cell
			var th = '<th scope="row" class=" check-column"><input type="checkbox" id="cb-select-'+ row_id +'" name="slb_import_rows[]" class="slb-input" value="'+ row_id +'" /></th>';
				
			tr += th;
			
			// set out our column_id
			var column_id = 0;
			
			// loop over all the data columns in this subscriber
			$.each( subscriber, function(key,value){
				
				// increment our column_id
				column_id++;
				
				// setup a fieldname for our checkbox
				var field_name = 's_'+row_id+'_'+column_id;
				
				// create the html for our table cell
				var td = '<td>'+ value +'<input type="hidden" name="'+ field_name +'" class="slb-input" value="'+ value +'"></td>';
				
				// append our new td to tr
				tr += td;	
				
			});
			
			// close our tr
			tr += '</tr>';
			
			// append our new tr to the table
			table += tr;
				
		});
		
		// close our table html		
		table += '</tbody></table>';
		
		// build row 2 html and append our new table to it
		var row_2 = slb_get_form_table_row('Select Subscribers', table, 'Please select all the subscribers you\'d like to import.');
		
		// append row_2 to return_html
		return_html += row_2;
		
		// return the html as a jQuery object
		return $(return_html);
		
	}
	
	// hint: this function returns custom select html with the subscribers data header columns as options
	function slb_get_selector( input_id, subscribers ) {
		
		// setup our return variable
		var select = '<select name="'+ input_id +'" class="slb-input">';
		
		// setup our column_id
		var column_id = 0;
		
		// setup our first option variable
		var option = '<option value="">- Select One -</option>';
		
		// add our first option to our select html
		select += option;
		
		// loop over the subscribers[0] data to get the header keys
		$.each( subscribers[0], function(key,value) {
			
			// increment column_id
			column_id++;
			
			// create our option html
			var option = '<option value="'+ column_id +'">'+ column_id +'. '+ key +'</option>';
			
			// append the option to our select html
			select += option;	
			
		});	
		
		// close our select html
		select += '</select>';
		
		// return the new select html
		return select;
		
	}
	
	// hint: returns an html tr formatted for wordpress admin forms
	function slb_get_form_table_row(label, input, description){
		
		// build our tr html
		var html = '<tr>'+
			'<th scope="row"><label>'+label+'</label></th>'+
			'<td>'+input;
			
			if( description !== undefined ) {
				html += '<p class="description">'+description+'</p>';
			}
			
			html += '</td>'+
		'</tr>';
		
		// return the html
		return html;
	};
	
	// hint: this function checks to see if import_form_2 is valid
	function slb_form_2_is_valid() {
		
		// setup our return variable
		var is_valid = true;
		
		// check if no subscribers are selected
		if( $('[name="slb_import_rows[]"]:checked',$import_form_2).length == 0 ) 
			is_valid = false;
			
		// check if no fname column is selected 
		if( $('[name="slb_fname_column"] option:selected',$import_form_2).val() == '' ) 
			is_valid = false;
			
		// check if no lname column is selected 
		if( $('[name="slb_lname_column"] option:selected',$import_form_2).val() == '' ) 
			is_valid = false;
			
		// check if no email column is selected 
		if( $('[name="slb_email_column"] option:selected',$import_form_2).val() == '' ) 
			is_valid = false;
			
		// return the result
		return is_valid;
		
	}

	
	

	
});