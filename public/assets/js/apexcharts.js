import ApexCharts from "apexcharts";
import { getDistributedColumnConfig } from "@public/distributedColumnConfig.js";
import { getDonutConfig } from "@public/donutConfig.js";
import { getSplineAreaConfig } from "@public/splineAreaConfig.js";

document.addEventListener("DOMContentLoaded", function () {

	const chartDataUrl = window.chartDataUrl;

	// Donut Chart
	getDonutConfig(chartDataUrl, (optionsDonut) => {
		var donut = new ApexCharts(document.getElementById("donut"), optionsDonut);
		donut.render();
	});



	// Distributed Column Chart
	getDistributedColumnConfig(chartDataUrl, (optionsDistributedColumn) => {
        var distributedColumn = new ApexCharts(document.getElementById("distributed-column"), optionsDistributedColumn);
        distributedColumn.render();
    });



	// Spline Area Chart
    getSplineAreaConfig(chartDataUrl, (optionsSplineArea) => {
        var splineArea = new ApexCharts(document.getElementById("spline-area"), optionsSplineArea);
        splineArea.render();
    });

});
