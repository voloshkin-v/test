(function($) {
	// ------ AJAX PAGINATION

	// $( document ).on( 'click', '.navigation .page-numbers', function( event ) {
	// 	event.preventDefault();
	// 	const href = $( this ).attr( 'href' ),
	// 		  currentPostsSection = $(this).closest('.posts'),
	// 		  currentPostsSectionId = $(this).closest('.posts').attr('id'),
	// 		  loader = $('.loader');

	// 	loader.addClass('active');

	// 	$( currentPostsSection ).load( href + ` #${currentPostsSectionId} .container` , function() {
	// 		loader.removeClass('active');

	// 	} );
	// } );

	// ------  END AJAX PAGINATION



	//  ------ Ajax loadmore

	// const ajaxUrl = myOptions.ajaxUrl;
	// const pages = {};
	// const statusMessage = {
	// 	loading: 'Loading...',
	// 	initialState: 'Load More'
	// };

	// $('.posts').each((i, item) => {
	// 	if ( $(item).attr('data-term') ) {
	// 		const key = $(item).data('term').toLowerCase().replace(' ', '-');
	// 		pages[key] = 2;
	// 	}
	// });

	// $('body').on('click', '.load-more', function(e) {
	// 	e.preventDefault();

	// 	const btn = $(this),
	// 		  catName = $(this).closest('.posts').data('term').toLowerCase().replace(' ', '-'),
	// 		  rowSection = $(this).closest('.posts').find('.row');

	// 	btn.text(statusMessage.loading);
	// 	btn.addClass('active');

	// 	let currentCategoryPage = pages[catName];

	// 	const data = {
	// 		'action': 'load_posts_by_ajax',
	// 		'cat_name': catName,
	// 		'page': currentCategoryPage
	// 	};

	// 	$.post(ajaxUrl, data, function(response) {
	// 		console.log(data);
	// 		if (response) {
	// 			const answer = $(response);
	// 			rowSection.append(answer);

	// 			currentCategoryPage++;
	// 			pages[catName] = currentCategoryPage;

	// 			btn.text(statusMessage.initialState);
	// 			btn.removeClass('active');
	// 		} else {
	// 			btn.remove();
	// 			alert('finished')
	// 		}
	// 	});
	// })

	//  ------ END Ajax loadmore

}(jQuery))

window.addEventListener('DOMContentLoaded', () => {
	const ajaxUrl = myOptions.ajaxUrl,
		pages = {};
		statusMessage = {
			loading: 'Loading...',
			initialState: 'Load More'
		};

	const posts = document.querySelectorAll('.posts'),
		  loadMoreBtns = document.querySelectorAll('.load-more');

	posts.forEach(item => {
		if (item.dataset.term) {
			const key = item.dataset.term.toLowerCase().replace(' ', '-');
			pages[key] = 2;
		}
	});

	loadMoreBtns.forEach(btn => {
		btn.addEventListener('click', (e) => {
			e.preventDefault();

			const termName = btn.closest('.posts').dataset.term.toLowerCase().replace(' ', '-'),
				currentRow = btn.closest('.posts').querySelector('.row'),
				maxNumPages = btn.closest('.posts').dataset.pages;

			let currentPage = btn.closest('.posts').dataset.page;

			btn.classList.add('loading');
			btn.innerText = statusMessage.loading;


			let currentTermPage = pages[termName];

			const formData = new FormData();

			formData.append( 'action', 'load_posts_by_ajax' );
			formData.append( 'term_name', termName );
			formData.append( 'page', currentTermPage );

			fetch(ajaxUrl, {
				method: "POST",
				body: formData
			})
			.then(response => response.text())
			.then(data => {
				currentPage++;
				btn.closest('.posts').setAttribute('data-page', currentPage);

				btn.innerText = statusMessage.initialState;

				currentRow.innerHTML += data;

				currentTermPage++;
				pages[termName] = currentTermPage;

				btn.classList.remove('loading');

				if (currentPage == maxNumPages) {
					btn.remove();
				}
			})
		})
	});
});