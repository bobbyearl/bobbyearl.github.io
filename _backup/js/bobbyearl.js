// Wait for it... Wait for it...
$(function() {

	// Portfolio
	var context = {
		portfolio: [
			{
				title: 'Our NRCS Rollout Report',
				description: '',
				thumbnail: 'img/nrcs-mrt-rollout-report.png',
				tech: [
					'HTML5',
					'CSS3'
				]
			},
			{
				title: 'Our NRCS Resource Toolbox',
				description: '',
				thumbnail: 'img/nrcs-mrt.png',
				tech: [
					'HTML / HTML5',
					'CSS3 / Bootstrap',
					'Handlebars'
				]
			},
			{
				title: 'VarnerMiller Architect',
				description: '',
				thumbnail: 'img/architect.png',
				tech: [
					'PHP',
					'SQL (MySQL)',
					'HTML5',
					'CSS3',
					'JS / jQuery'
				]
			},
			{
				title: 'Unity3D Game Management',
				description: '',
				thumbnail: 'img/unity3d.png',
				tech: [
					'Unity3D',
					'C#'
				]
			},
			{
				title: 'CofC Shopping Cart',
				description: '',
				thumbnail: 'img/cofc-cart.png',
				tech: [
					'C#',
					'ASP.NET',
					'SQL (MS SQL Server)'
				]
			},
			{
				title: 'CofC Scrapbook',
				description: '',
				thumbnail: 'img/cofc-scrapbook.png',
				tech: [
					'C#',
					'ASP.NET',
					'Flickr API'
				]
			},
			{
				title: 'Navy Networks 101',
				description: '',
				thumbnail: 'img/nnu.png',
				tech: [
					'HTML / HTML5',
					'CSS3 / Bootstrap',
					'Handlebars',
					'SCORM'
				]			
			},
			{
				title: 'ICE ERO Field Operations',
				description: '',
				thumbnail: 'img/ice-ero.png',
				tech: [
					'Adobe Flash',
					'ActionScript 3',
					'SCORM'
				]
			}
		] 
	};

	// Load Template
	var source = $('#template').html();
	var template = Handlebars.compile(source);

	// Shuffle portfolio
	fisherYates(context.portfolio);

	// Display results
	$('#portfolio').html(template(context));
	
	// Enable tooltips
	$('a[rel="tooltip"]').tooltip();
	
	// Enable popovers
	$('a[rel="popover"]').popover({
		placement: 'top',
		html: true,
		trigger: 'hover'
	});

	// Update epoch times
	$('.formatDT').each(function(){
		var m = moment.unix(parseInt($(this).html()));
		$(this).html(m.fromNow());
	});

	// Mobile IE10 Fix
	// http://trentwalton.com/2013/01/16/windows-phone-8-viewport-fix/
	if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		var msViewportStyle = document.createElement("style");
		msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
		document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
	}

});

// Utilities
function fisherYates ( myArray ) {
  var i = myArray.length;
  if ( i == 0 ) return false;
  while ( --i ) {
     var j = Math.floor( Math.random() * ( i + 1 ) );
     var tempi = myArray[i];
     var tempj = myArray[j];
     myArray[i] = tempj;
     myArray[j] = tempi;
   }
}