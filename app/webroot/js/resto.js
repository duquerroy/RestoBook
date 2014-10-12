 $(document).ready(function() {
	$(".sidebar .nav > .has-sub > a").click(function () {
		var e = $(this).next(".sub-menu");
		var t = ".sidebar .nav > li.has-sub > .sub-menu";
		$(t).not(e).slideUp(250);
		$(e).slideToggle(250)
	});
	$(".sidebar .nav > .has-sub .sub-menu li.has-sub > a").click(function () {
		var e = $(this).next(".sub-menu");
		$(e).slideToggle(250)
	})

	$(".sidebar ul.nav li.has-sub ul.sub-menu li.active").parent("ul .sub-menu").slideDown(250);
	$(".sidebar ul.nav li.has-sub ul.sub-menu li.active").parents(".has-sub").css("background-color", "#476884;");

	


});

