//toggle navbar on scroll
$(window).scroll(function () {

	if ( $(this).scrollTop() > 800 && !$(document.getElementById('Nav')).hasClass('open') ) {
		$(document.getElementById('Nav')).addClass('open');
		$(document.getElementById('Nav')).slideDown();
		document.getElementById('Nav').style.position="fixed";
		document.getElementById('Nav').style.top="0";
		document.getElementById('Nav').style.width="100%";
		document.getElementById('Nav').style.marginLeft="0";
		document.getElementById('Nav').style.marginTop="0";
		document.getElementById('Nav').style.zIndex="1";
		document.getElementById('Nav').style.boxShadow="0px 1px 5px 0px #888";
		document.getElementById('navbarNavDropdown').style.marginLeft="50%";
		document.getElementById('Nav').style.transition = "ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s";
	} else if ( $(this).scrollTop() <= 800 ) {
		if (window.matchMedia('(max-width: 768px)').matches){
			$(document.getElementById('Nav')).removeClass('open');
			document.getElementById('Nav').style.position="relative";
			document.getElementById('Nav').style.width="100%";
			document.getElementById('Nav').style.marginLeft="0";
			document.getElementById('Nav').style.marginTop="0";
			document.getElementById('Nav').style.boxShadow="0px 0px 0px 0px #888";
			document.getElementById('navbarNavDropdown').style.marginLeft="0";
		}
		else{
			$(document.getElementById('Nav')).removeClass('open');
			document.getElementById('Nav').style.position="relative";
			document.getElementById('Nav').style.width="50%";
			document.getElementById('Nav').style.marginLeft="25%";
			document.getElementById('Nav').style.marginTop="-2%";
			document.getElementById('Nav').style.boxShadow="0px 0px 0px 0px #888";
			document.getElementById('navbarNavDropdown').style.marginLeft="0";			
		}
  	}
});

//Toggle Side Nav
function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

//return to top function
$(window).scroll(function() {
    if ($(this).scrollTop() >= 1000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});

$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 667                      // Scroll to top of body
    }, 500);
});

$(document).ready(function(){
	  // Add smooth scrolling to all links
	  $("a").on('click', function(event) {

	    // Make sure this.hash has a value before overriding default behavior
	    if (this.hash !== "") {
	      // Prevent default anchor click behavior
	      event.preventDefault();

	      // Store hash
	      var hash = this.hash;

	      // Using jQuery's animate() method to add smooth page scroll
	      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
	      $('html, body').animate({
	        scrollTop: $(hash).offset().top
	      }, 500, function(){
	   
	        // Add hash (#) to URL when done scrolling (default click behavior)
	        window.location.hash = hash;
	      });
	    } // End if
	  });
	});