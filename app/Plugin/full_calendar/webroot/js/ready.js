/*
 * webroot/js/ready.js
 * CakePHP Full Calendar Plugin
 *
 * Copyright (c) 2010 Silas Montgomery
 * http://silasmontgomery.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 */

// JavaScript Document
$(document).ready(function() {
    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({




		header: {
    		left:   'title',
    		center: '',
    		right:  'today agendaDay,agendaWeek,month prev,next'
		},
		defaultView: 'agendaWeek',
		firstHour: 6,
		slotMinutes: 15,
		minTime: localStorage.getItem('dateStartCalend'),
		weekMode: 'variable',
		aspectRatio: 1,
		editable: true,
		events: plgFcRoot + "/events/feed",
		eventRender: function(event, element) {
        	element.qtip({
				content: event.details,
				position: {
					target: 'mouse',
					adjust: {
						x: 10,
						y: -5
					}
				},
				style: {
					name: 'light',
					tip: 'leftTop'
				}
        	});
    	},
		eventDragStart: function(event) {
			$(this).qtip("destroy");
		},



		eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
			$(this).qtip("destroy");

			var startdate = new Date(event.start);
			var startyear = startdate.getFullYear();
			var startday = startdate.getDate();
			if (startday<10) {startday = "0" + startday};
			var startmonth = startdate.getMonth()+1;
			if (startmonth<10) {startmonth = "0" + startmonth};
			var starthour = startdate.getHours();
			if (starthour<10) {starthour = "0" + starthour};
			var startminute = startdate.getMinutes();
			if (startminute<10) {startminute = "0" + startminute};
			var enddate = new Date(event.end);
			var endyear = enddate.getFullYear();
			var endday = enddate.getDate();
			if (endday<10) {endday = "0" + endday};
			var endmonth = enddate.getMonth()+1;
			if (endmonth<10) {endmonth = "0" + endmonth};
			var endhour = enddate.getHours();
			if (endhour<10) {endhour = "0" + endhour};
			var endminute = enddate.getMinutes();
			if (endminute<10) {endminute = "0" + endminute};


			// alert(	event.title + " was moved " + dayDelta + " days and " + minuteDelta + " minutes.");
			// if (!confirm("Are you sure about this change?")) { revertFunc(); }
		 	// 	if (allDay) { alert("Event is now all-day"); }else{ alert("Event has a time-of-day"); }

			if(event.allDay == true) { var allday = 1; } else { var allday = 0;	}

			var url = plgFcRoot + "/events/update?id="+event.id+"&start="+startyear+"-"+startmonth+"-"+startday+" "+starthour+":"+startminute+":00&end="+endyear+"-"+endmonth+"-"+endday+" "+endhour+":"+endminute+":00&allday="+allday;

	        $.post(url, function( data ) {
	        	if (data.sansa == 0) {
	        		$("#modall").removeClass("alert-success").addClass("alert-danger");
	        		$("#modall p").empty().append( data.name );
   					$('#modall').show();
	        		revertFunc();
	        	} else {
	        		$("#modall").removeClass("alert-danger").addClass("alert-success");
					$("#modall p").empty().append( data.name );
   					$('#modall').show();
   				}
			}, "json");

		$(".qtip").hide();

		},




		eventResizeStart: function(event) {
			$(this).qtip("destroy");
		},
		eventResize: function(event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
			$(this).qtip("destroy");

			var startdate = new Date(event.start);
			var startyear = startdate.getFullYear();
			var startday = startdate.getDate();
			if (startday<10) {startday = "0" + startday};
			var startmonth = startdate.getMonth()+1;
			if (startmonth<10) {startmonth = "0" + startmonth};
			var starthour = startdate.getHours();
			if (starthour<10) {starthour = "0" + starthour};
			var startminute = startdate.getMinutes();
			if (startminute<10) {startminute = "0" + startminute};
			var enddate = new Date(event.end);
			var endyear = enddate.getFullYear();
			var endday = enddate.getDate();
			if (endday<10) {endday = "0" + endday};
			var endmonth = enddate.getMonth()+1;
			if (endmonth<10) {endmonth = "0" + endmonth};
			var endhour = enddate.getHours();
			if (endhour<10) {endhour = "0" + endhour};
			var endminute = enddate.getMinutes();
			if (endminute<10) {endminute = "0" + endminute};


			// alert(	event.title + " was moved " + dayDelta + " days and " + minuteDelta + " minutes.");
			// if (!confirm("Are you sure about this change?")) { revertFunc(); }
		 	// 	if (allDay) { alert("Event is now all-day"); }else{ alert("Event has a time-of-day"); }

			// if(event.allDay == true) { var allday = 1; } else { var allday = 0;	}

			var url = plgFcRoot + "/events/update?id="+event.id+"&start="+startyear+"-"+startmonth+"-"+startday+" "+starthour+":"+startminute+":00&end="+endyear+"-"+endmonth+"-"+endday+" "+endhour+":"+endminute+":00";

	        $.post(url, function( data ) {
	        	if (data.sansa == 0) {
	        		$("#modall").removeClass("alert-success").addClass("alert-danger");
	        		$("#modall p").empty().append( data.name );
   					$('#modall').show();
	        		revertFunc();
	        	} else {
	        		$("#modall").removeClass("alert-danger").addClass("alert-success");
					$("#modall p").empty().append( data.name );
   					$('#modall').show();
   				}
			}, "json");

		$(".qtip").hide();

		},


		dayClick: function(ev) {
			var dd = new Date(ev);
			// console.log(dd);
              dateClick = dd.getFullYear()+'/'+(dd.getMonth()+1)+'/'+dd.getDate();
              localStorage.setItem('data', dateClick);
              console.log(localStorage.getItem('data'));
			  $(location).attr('href',plgFcRoot + "/events/add");


		},
		viewDisplay: function(view) {
       //alert(view.name)
            if(view.name != 'month')
            {
                $('#calendar').fullCalendar('option', 'contentHeight', 2000);
            }else{
                $('#calendar').fullCalendar('option', 'contentHeight', 700);
   }
 }
    })


});
