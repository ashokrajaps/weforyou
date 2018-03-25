jQuery(document).ready(function() { 
   jQuery('#testimonials .quotes').quovolver({
      children    : 'li',
      transitionSpeed : 600,
      autoPlay    : true,
	  autoPlaySpeed:6000,
      equalHeight   : false,
      navPosition   : 'below',
      navPrev     : true,
      navNext     : true,
      navNum      : true,
      navText     : false,
      navTextContent  : 'Quote @a of @b'
    });
    
  });