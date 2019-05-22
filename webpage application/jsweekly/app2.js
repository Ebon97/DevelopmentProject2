$(document).ready(function(){
	$.ajax({
		url: "http://localhost/DevelopmentProject2/webpage application/jsweekly/data2.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var dayname = [];
			var sales = [];

			for(var i in data) {
				dayname.push(data[i].day);
				sales.push(data[i].sales);
			}

			var chartdata = {
				labels: dayname,
				datasets : [
					{
						label: 'Employee Sales',
						backgroundColor: 'rgba(200, 200, 200, 1)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: sales
					}
				]
			};

			

			var barGraph = new Chart(columnchart1,  {
                
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});