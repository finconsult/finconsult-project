//javascript loader
$(window).load(function() {
	$(".loader").fadeOut(1500);
});
//parallax
$('.parallax-window').parallax({imageSrc: 'images/header-image.png'});
//to the top button script          
$(document).ready(function() {
	var offset = 220;
	var duration = 1000;
	$(window).scroll(function() {
		if ($(this).scrollTop() > offset) {
			$('.top-btn').fadeIn(duration);
		} else {
			$('.top-btn').fadeOut(duration);
		}
	});
	$('.top-btn').click(function(event) {
		event.preventDefault();
		jQuery('html, body').animate({scrollTop: 0}, duration);
		return false;
	})
});
//login button
$(document).ready(function() {
	var offset = 0;
	var duration = 1300;
	$('.log').click(function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop: 3500}, duration);
		return false;
	})
});
//owl carousel
$(document).ready(function() {
  $(".hidden-members").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 2,
      itemsDesktop : [1199,1],
      itemsDesktopSmall : [979,1]
  });
});
//owl carousel
$(document).ready(function() {
  $(".allbadges-gallery").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,3]
  });
});
//owl carousel
$(document).ready(function() {
  $(".badges-hidden").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,3]
  });
});