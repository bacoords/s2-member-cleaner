(function( $ ) {
	'use strict';

	$( window ).load(function() {

		$('#s2mc-delete-batch-btn').click(function(e){

			e.preventDefault();

			if( window.confirm("Are you sure you want to delete?") ){
				$('#s2mc-loading').addClass('show');
				var nonce = $( '#s2mc-delete-batch-ajax-nonce' ).val();
				var args = {
					'action' : 's2mc_ajax_delete_batch',
					'security' : nonce
				};
				$.post(ajaxurl, args, function(response) {

						$('#s2mc-loading').removeClass('show');
						alert(response + ' users were deleted.');
						location.reload();
				});
			}

		});

	});

})( jQuery );
