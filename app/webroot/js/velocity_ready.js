
$(".box, .box input, .box .text, .box .submit")
	  .velocity({
	  	translateY: [0, 300],
	  	opacity: 1
	  },{
	  	duration: 800,
	  	display: 'block',
	  	easing: [40, 6]
	  });

// $(".box .submit").click(function(e){
// 	// e.preventDefault();
// 	// e.stopPropagation();
// 	$(".box, .box input, .box .text, .box .submit")
// 	  .velocity({
// 	  	// translateY: [0, 300]
// 	  	opacity: 0
// 	  },{
// 	  	duration: 800,
// 	  	display: 'block',
// 	  	// easing: [40, 6]
// 	  });

// });