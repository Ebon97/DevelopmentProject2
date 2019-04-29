window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
    height: 500,
	animationEnabled: true,
	title: {
		text: "Sales Percentages per Service of the Last Month"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: 51.08, label: "Dye Hair" },
			{ y: 27.34, label: "Cutting" },
			{ y: 10.62, label: "Washing" },

		]
	}]
});
chart.render();

}