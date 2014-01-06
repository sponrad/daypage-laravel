/*hDatepicker 
Conrad Frame*/

//get the days in the month
daysInMonth = function(year, month) {
    var s = new Date(year, month, 1),
    e = new Date(year, month + 1, 1),
    days = parseInt((e - s) / (1000 * 60 * 60 * 24), 10);
    return days;
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

drawMonthRow = function(selectedDate){
    //left arrow
    monthRow = '<h2><button class="changeMonth" data-inc=-1><</button>';


    //display the currently selected month
    monthRow += monthNames[ selectedDate.getMonth() ] + " " + selectedDate.getFullYear();


    //right arrow
    monthRow += '<button class="changeMonth" data-inc=1>></button></h2>';



    hDiv.append( monthRow);
}


drawDays = function(selectedDate){
    numberOfDays = daysInMonth(selectedDate.getYear(), selectedDate.getMonth());

    today = new Date().getDate();

    
    //for each day in the selected month print the day
    for (var i=1; i<numberOfDays+1; i++){

	dayType = "weekday";
	tempDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), i);
	if (tempDate.getDay() == 0 || tempDate.getDay() == 6){
	    //its a weekend
	    dayType = "weekend";
	}

	today = "";
	t = new Date();
	if ( t.getFullYear() == selectedDate.getFullYear() &&
	     t.getMonth() == selectedDate.getMonth() &&
	     t.getDate() == i
	){
	    today = "today";
	}

	selected = "";
	if ( i == selectedDate.getDate() ){
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

    hDiv.attr('unselectable', 'on')
        .css('user-select', 'none')
        .on('selectstart', false);
    hDiv.bind("dblclick", function(e){
	e.preventDefault();
    });
    drawMonthRow(selectedDate);
    drawDays(selectedDate);
    hDiv.on("click", ".changeMonth", function(){
	selectedDate.setMonth(selectedDate.getMonth() + parseInt(this.getAttribute("data-inc")));
	hDiv.html("");
	drawMonthRow(selectedDate);
	drawDays(selectedDate);
    });
    
    hDiv.on("click", ".dateButton", function(){
	d = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), parseInt(this.getAttribute("data-day")));
	console.log("clicked: " + d);
	selectedDate = d;
	hDiv.html("");
	drawMonthRow(selectedDate);
	drawDays(selectedDate);
	onDateSelect(d);

	//get the information for this day?, or show it for this month.. need something to make sure we have the data for the adjacent months
    });
//});
}
