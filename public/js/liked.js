jQuery(document).ready(function($) {

	// Favorite videos.
	$('.post').on('click', 'a.like-post', function(e){
		e.preventDefault();

		// Prepare data.
		var data = { id: $(this).data('post') },
			toggle = $(this);

		// Send request through ajax.
		$.ajax({
			type: 'post',
			url: '/api/post/like',
			data: data,
			dataType: "json",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
			success: function(data){
				if(data == 'attached')
				{
					toggle.addClass('liked');
					toggle.attr('uk-tooltip', 'Dislike');
				} else {
					toggle.removeClass('liked');
					toggle.attr('uk-tooltip', 'Like');
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
	});

});
