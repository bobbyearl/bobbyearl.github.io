$(document).ready(function() {
	$.ajax({
		type: "GET",
		url: "news.xml",
		dataType: "xml",
		success: function(xml) {
			$(xml).find('story').each(function(){
				var text = $(this).find('text').text();
				var link = $(this).find('link').text();
				$('<li></li>').html(text + '<br /><a href="' + link + '">More&nbsp;&gt;</a>').appendTo('#inner-news');
			});
			$('#loading').hide();
		},
		error: function(a, b, c) {
			$('#loading').hide();
			$('#error').show();
		}
	});					   
});