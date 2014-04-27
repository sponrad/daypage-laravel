/*hDatepicker 
  Conrad Frame*/

daysInMonth = function(year, month) {
    return new Date(year, month, 0).getDate();
};

var monthNames = [ "January", "February", "March", "April", "May", "June",
		   "July", "August", "September", "October", "November", "December" ];

var weekday = new Array(7);
weekday[0]="Sunday";
weekday[1]="Monday";
weekday[2]="Tuesday";
weekday[3]="Wednesday";
weekday[4]="Thursday";
weekday[5]="Friday";
weekday[6]="Saturday";

drawMonthRow = function(selectedDate, viewDate){

    monthRow = "<div id='monthRow' >";

    //display the year in its own h2
    monthRow += "<h2 id='hDateYear'>" + viewDate.getFullYear() + "</h2>";

    //left arrow
    monthRow += '<button type="button" class="btn changeMonth" data-inc=-1><span class="glyphicon glyphicon-chevron-left"></span></button>';
    //right arrow
    monthRow += '<button type="button" class="btn changeMonth" data-inc=1><span class="glyphicon glyphicon-chevron-right"></span></button>';

    //display the currently viewed month
    monthRow += "<h2 id='monthName'>" + monthNames[ viewDate.getMonth() ] + "</h2>";

    
    monthRow += "</div>";


    hDiv.append( monthRow);
}


drawDays = function(selectedDate, viewDate){
    numberOfDays = daysInMonth(viewDate.getYear(), viewDate.getMonth());

    today = new Date().getDate();

    
    //for each day in the viewed month print the day
    for (var i=1; i<numberOfDays+1; i++){

	dayType = "weekday";
	tempDate = new Date(viewDate.getFullYear(), viewDate.getMonth(), i);
	if (tempDate.getDay() == 0 || tempDate.getDay() == 6){
	    //its a weekend
	    dayType = "weekend";
	}

	today = "";
	t = new Date();
	if ( t.getFullYear() == viewDate.getFullYear() &&
	     t.getMonth() == viewDate.getMonth() &&
	     t.getDate() == i
	   ){
	    today = "today";
	}

	selected = "";
	if ( viewDate.getFullYear() == selectedDate.getFullYear() &&
	     viewDate.getMonth() == selectedDate.getMonth() &&
	     i == selectedDate.getDate() ){
	    selected = "selected";
	}
	
	hDiv.append("<button class='dateButton "+dayType+" "+today+" "+selected+"' data-day="+i+" title="+weekday[tempDate.getDay()]+">"+i+"</button>");

    }
}

//$(document).ready( function(){
hDatepicker = function(target, options){

    onDateSelect = options.onDateSelect;

    //find the div
    hDiv = target;

    selectedDate = new Date();
    viewDate = new Date();

    hDiv.attr('unselectable', 'on')
        .css('user-select', 'none')
        .on('selectstart', false);
    hDiv.bind("dblclick", function(e){
	e.preventDefault();
    });
    drawMonthRow(selectedDate, viewDate);
    drawDays(selectedDate, viewDate);
    hDiv.on("click", ".changeMonth", function(){
	viewDate.setMonth(viewDate.getMonth() + parseInt(this.getAttribute("data-inc")));
	hDiv.html("");
	drawMonthRow(selectedDate, viewDate);
	drawDays(selectedDate, viewDate);
    });
    
    hDiv.on("click", ".dateButton", function(){
	d = new Date(viewDate.getFullYear(), viewDate.getMonth(), parseInt(this.getAttribute("data-day")));
	selectedDate = d;
	hDiv.html("");
	drawMonthRow(selectedDate, viewDate);
	drawDays(selectedDate, viewDate);
	onDateSelect(d);

    });
}
