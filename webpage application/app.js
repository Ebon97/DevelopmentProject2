$(document).ready(function(){
	$.ajax({
		url: "http://localhost/DevelopmentProject2/webpage application/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var staffm = [];
			var sales = [];

			for(var i in data) {
				staffm.push(data[i].staff);
				sales.push(data[i].sales);
			}

			var chartdata = {
				labels: staffm,
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

			

			var barGraph = new Chart(employeesales,  {
                
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});