jQuery(document).ready(function($) {

	$('.add-friend').on('click', 'button.add-btn', function(e){
		e.preventDefault();

		// Prepare data.
		var user = $(this).data('user'),
			data = { id: user },
			toggle = $(this);

		// Send request through ajax.
		$.ajax({
			type: 'post',
			url: '/profile/'+user+'/add',
			data: data,
			dataType: "json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				$('.add-friend button.add-btn').remove();
				$('.add-friend').append('<button class="uk-button">Request send!</button>');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	});

});
