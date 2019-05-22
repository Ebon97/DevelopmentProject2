

var chart = new CanvasJS.Chart("employeechart", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Employee Sales"
	},
	axisY: {
		title: "Sales ($)"
	},
	data: [{        
		type: "column",  
		//showInLegend: true, 
		//legendMarkerColor: "grey",
		//legendText: "MMbbl = one million barrels",
		dataPoints: [      
			{ y: 3800, label: "Jones" },
			{ y: 2665,  label: "Mary" },
			{ y: 1709,  label: "William" },
			{ y: 1400,  label: "Adam" },
			{ y: 1503,  label: "Alex" },
			{ y: 1500, label: "Stephen" },
			{ y: 900,  label: "Roy" },
			{ y: 4900,  label: "Mike" }
		]
	}]
});
chart.render();

