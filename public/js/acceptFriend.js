jQuery(document).ready(function($) {

	$('.request').on('click', 'a.accept-btn', function(e){
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
				// Subtract 1 from friend-request counter.
				var friendrequests = $('.badge-requests').text();
				$('.badge-requests').text((parseInt(friendrequests) - 1));

				// Add 1 to friends counter.
				var friends = $('.badge-friends').text();
				$('.badge-friends').text((parseInt(friends) + 1));

				// Remove the user from the screen.
				$('.request-' + user).remove();

				// Append message when no friendrequests
				if(parseInt(friendrequests) == 1) {
					$('.requests').append('<p>You don\'t have any friendrequests...</p>');
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	});

});
