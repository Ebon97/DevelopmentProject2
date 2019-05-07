

var chart = new CanvasJS.Chart("columnchart1", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Sales of the Week"
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
			{ y: 3800, label: "Monday" },
			{ y: 2665,  label: "Tuesday" },
			{ y: 1709,  label: "Wednesday" },
			{ y: 1400,  label: "Thursday" },
			{ y: 1503,  label: "Friday" },
			{ y: 1500, label: "Saturday" },
			{ y: 900,  label: "Sunday" }
		]
	}]
});
chart.render();

