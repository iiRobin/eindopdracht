jQuery(document).ready(function($) {

	$('.friend').on('click', 'a.remove-btn', function(e){
		e.preventDefault();

		// Prepare data.
		var user = $(this).data('user'),
			data = { id: user },
			toggle = $(this);

		// Send request through ajax.
		$.ajax({
			type: 'post',
			url: '/profile/'+user+'/remove',
			data: data,
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				$('.friend a').remove();
				$('.friend').append('<p style="font-size:20px;">Friend has been removed!</p>');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	});

});
