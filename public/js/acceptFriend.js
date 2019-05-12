jQuery(document).ready(function($) {

	$('.requests').on('click', 'a.accept-btn', function(e){
		e.preventDefault();

		// Prepare data.
		var user = $(this).data('user'),
			data = { id: user },
			toggle = $(this);

		// Send request through ajax.
		$.ajax({
			type: 'post',
			url: '/profile/'+user+'/accept',
			data: data,
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				$('.request-' + user).remove();
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	});

});
