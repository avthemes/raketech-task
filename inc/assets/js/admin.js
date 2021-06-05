jQuery( function() {
    
	jQuery( "tbody" ).sortable({
		placeholder: "ui-state-highlight",
		axis: "y",
		forceHelperSize: true,
		forcePlaceholderSize: true,
		handle: ".admin-cell",
		helper: "clone",
		change: function( event, ui ) { jQuery('.save-status').html(''); }
	});

	jQuery(document).on('click', '.btn-save', function() {

		jQuery('.save-status').html( '<i>saving...</i>' );

		var sortedIDs = jQuery( "tbody" ).sortable( "toArray" );
		var data_id = jQuery('.rt-reviews').data('id');

		jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data: { 
					action: 'rt_save_review_position' , 
					security: rt_ajax_object.rt_security,
					id: data_id, 
					positions: sortedIDs 
				}
			}).done(function( msg ) {
				
				jQuery('.save-status').html( msg.response );
			});
	});

	jQuery(document).on( 'change', '#select-list', function() {

		var href = jQuery(this).val();
		
		document.location.href=href;
	});

	jQuery(document).on('click', '#flush-cache', function() {

		var res = confirm('Are you sure you want to delete the cached files?');

		if( res == true ) {

			jQuery('.save-status').html( '<i>clearing cache...</i>' );

			jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data: { 
					action: 'rt_clear_cache' , 
					security: rt_ajax_object.rt_security,
				}
			}).done(function( msg ) {
				
				jQuery('.save-status').html( msg.response );
			});
		}
	});

} );