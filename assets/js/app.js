// Wait for it... Wait for it...
;(function() {
  'use strict';
  
  $(function () {
    
    // Enable tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Enable portfolio popovers
    $('[data-toggle="popover"]').popover({
      placement: 'top',
      html: true,
      trigger: 'hover',
      content: function() {
        return $($(this).data('target')).html();
      }
    });
    
    // Shuffle portfolio
    var parent = $('.portfolio-item-wrapper'),
        children = $('.portfolio-item');
    
    while (children.length) {
      parent.append(children.splice(Math.floor(Math.random() * children.length), 1)[0]); 
    }

    // Update epoch times
    $('[data-date]').each(function () {
      var element = $(this),
          date = element.data('date'),
          parse = element.data('parse'),
          format = element.data('format'),
          diff = element.data('diff'),
          now = moment(),
          then = moment(date, parse),
          html = '';
      
      if (typeof diff != 'undefined') {
        html = now.diff(then, diff);
      } else if (typeof format != 'undefined') {
        html = then.format(format);
      } else {
        html = then.fromNow();
      }
      
      element.html(html);
    });

    // Mobile IE10 Fix
    // http://trentwalton.com/2013/01/16/windows-phone-8-viewport-fix/
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
      var msViewportStyle = document.createElement("style");
      msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}"));
      document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
    }

  });
  
}());