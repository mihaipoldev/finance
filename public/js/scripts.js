var addUrl = null;
var postId = null;
var token  = null;

$(function() {
	$(document)
		.on('click', '#btn-add', function(event) {
			event.preventDefault();

			$('#editForm').attr('action', $(this).data('url'));

			$('#editModal').modal();
		})

		.on('click', '.tool-wrapper.edit', function(event) {
			event.preventDefault();

			var postId = $(this).data('post-id');
			var $post  = $('#post' + postId);

			var title      = $post.find('.title').text();
			var categoryId = $post.find('.category').data('category-id');
			var amount     = $post.find('.amount').text();
			var date       = $post.find('.date:first').text();

			$('#post-title').val(title);
			$('#post-amount').val(amount);
			$('#post-date').val(date);
			$('#post-category').val(categoryId);

			$('#editForm').attr('action', $(this).data('url'));

			$('#editModal').modal();
		})

		.on('click', '.tool-wrapper.delete', function(event) {
			event.preventDefault();

			$('#post-delete').attr('href', $(this).data('url'));

			$('#deleteModal').modal();
		});

	// $(window).scroll(function() {
	// 	console.log($(this).scrollTop());
	// 	$('.statistics').animate({top: $(this).scrollTop()});
	// });

	// $(window).scroll(function() {
	// 	if ($(window).scrollTop() > 135) {
	// 		$(".statistics").stop().animate({"marginTop": ($(window).scrollTop()) - 135 + "px", "marginLeft": ($(window).scrollLeft()) + "px"}, 1);
	// 	}
	//
	// });

	$(window).scroll(function() {
		var target          = $('.statistics');
		var targetContainer = $('.statistics-container');
		if ($(window).scrollTop() > targetContainer.offset().top) {
			target.addClass('fixed');
		}
		else {
			target.removeClass('fixed');
		}


		// var y_position = $(window).scrollTop();
		// if(y_position > div_position) {
		// 	target.addClass('fixed');
		// }
		// else {;
		// }
	});

});