const url = "http://insta-project.com.devel";

window.addEventListener('load', () => {

	//Like button
	function like() {

		$('.like').unbind('click').click(function() {


			$(this).addClass('dislike').removeClass('like');
			$(this).attr('src', url+'/img/heart-red.png');
			let self = $(this);

			$.ajax({
				url: `${url}/like/${$(this).data('id')}`,
				headers: {
					'Content-Type': 'application/json'
				},
				type: 'GET',
				success: function(res) {
					console.log(res)
					if(res.like) {

						let countElement = self.siblings('.count-like');
						countElement.html(`${res.countsLike}`);

					}

				}
			})

			dislike();
		})
	}
	like();
	
	//Dislike button
	function dislike() {

		$('.dislike').unbind('click').click(function() {

			
			$(this).addClass('like').removeClass('dislike');
			$(this).attr('src', url+'/img/heart.png')
			let self = $(this);

			like();

			$.ajax({
				url: `${url}/dislike/${$(this).data('id')}`,
				type: 'GET',
				headers: {
					'Content-Type': 'application/json'
				},
				success: function(res) {
					console.log(res)
					if(res.like) {

						let countElement = self.siblings('.count-like');
						
						countElement.html(`${res.countsLike}`);
					}
				}
			})

		})

	}
	dislike();

});
