/*
var chart = new CanvasJS.Chart("hourly", {
	animationEnabled: true,
	title: {
		text: "Hourly Average Appointments"
	},
	axisX: {
		title: "Time"
	},
	axisY: {
		title: "Number of Appointments",
		//suffix: "%"
	},
	data: [{
		type: "line",
		name: "hourly",
		connectNullData: true,
		//nullDataLineDashType: "solid",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM hh:mm TT",
		yValueFormatString: "#,##0.##\"%\"",
		dataPoints: [
			{ x: 1501048673000, y: 35.939 },
			{ x: 1501052273000, y: 40.896 },
			{ x: 1501055873000, y: 56.625 },
			{ x: 1501059473000, y: 26.003 },
			{ x: 1501063073000, y: 20.376 },
			{ x: 1501066673000, y: 19.774 },
			{ x: 1501070273000, y: 23.508 },
			{ x: 1501073873000, y: 18.577 },
			{ x: 1501077473000, y: 15.918 },

			{ x: 1501084673000, y: 10.314 },
			{ x: 1501088273000, y: 10.574 },
						{ x: 1501081073000, y: null }, // Null Data
			{ x: 1501091873000, y: 14.422 },
			{ x: 1501095473000, y: 18.576 },
			{ x: 1501099073000, y: 22.342 },
			{ x: 1501102673000, y: 22.836 },
			{ x: 1501106273000, y: 23.220 },
			{ x: 1501109873000, y: 23.594 },
			{ x: 1501113473000, y: 24.596 },
			{ x: 1501117073000, y: 31.947 },
			{ x: 1501120673000, y: 31.142 }
		]
	}]
});
chart.render();
 
      */

var chart = new CanvasJS.Chart("hourly", {
    animationEnabled: true,
    theme: "light2",
    title: {
        text: "Hourly Average Appointments"
    },
 axisX: {
        title: "Time of the day (24h)",
        
    },

    axisY: {
        title: "Number of Appointments",
        includeZero: false
    },
    data: [{
        type: "line",
        dataPoints: [
            {
                x: 8,
                y: 1
            },
            {
                x: 9,
                y: 2
            },
            {
                x: 10,
                y: 4
            },
            /*, indexLabel: "highest",markerColor: "red", markerType: "triangle" },*/
            {
                x: 11,
                y: 5
            },
            {
                x: 12,
                y: 4
            },
            {
                x: 13,
                y: 5
            },
            {
                x: 14,
                y: 4
            },
            {
                x: 15,
                y: 6
            },
            {
                x: 16,
                y: 4
            },
            /*indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" */
            {
                x: 17,
                y: 5
            },
            {
                x: 18,
                y: 4
            },
            {
                x: 19,
                y: 3
            },
            {
                x: 20,
                y: 2
            },
            {
                x: 21,
                y: 2
            },
            {
                x: 22,
                y: 1
            }
		]
	}]
});
chart.render();
