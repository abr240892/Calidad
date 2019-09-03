


var MyDate = new Date();

var MyDateString;

var dias = 1;

var fecha;

MyDate.setDate(MyDate.getDate());
	 	 
MyDateString = MyDate.getFullYear()+'-'+('0' + (MyDate.getMonth()+1)).slice(-2)+'-'+('0' +MyDate.getDate()).slice(-2);

console.log(MyDateString);
/*	
var moment = moment().format(MyDateString,"YYYY-MM-DD");

console.log(moment);
*/