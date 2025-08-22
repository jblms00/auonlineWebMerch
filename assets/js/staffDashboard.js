$(document).ready(function () {
	getDashboardCardsData();
	getDashboardChartsData();
});

function getDashboardCardsData() {
	$.ajax({
		url: "../../phpscripts/get-dashboard-cards-data.php",
		type: "GET",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				var formattedProfit =
					"₱" +
					parseFloat(response.totalProfit).toLocaleString("en", {
						minimumFractionDigits: 2,
						maximumFractionDigits: 2,
					});
				var formattedSales =
					"₱" +
					parseFloat(response.totalSales).toLocaleString("en", {
						minimumFractionDigits: 2,
						maximumFractionDigits: 2,
					});
				var formattedBookings = parseFloat(
					response.totalOrders
				).toLocaleString("en");

				$("#profitCounts").text(formattedProfit);
				$("#todaySalesAmount").text(formattedSales);
				$("#totalOrders").text(formattedBookings);
				$("#totalUsers").text(response.totalUsers);

				console.log(response.totalUsers);
			} else {
				console.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			console.error("An error occurred: " + error);
		},
	});
}

function getDashboardChartsData() {
	$.ajax({
		url: "../../phpscripts/get-dashboard-charts-data.php",
		type: "GET",
		dataType: "json",
		success: function (response) {
			if (response.status === "success") {
				// Orders Chart - Bar Graph
				var ordersOptions = {
					chart: {
						type: "bar",
						height: 350,
						width: "100%",
						toolbar: {
							show: false,
						},
					},
					series: [
						{
							name: "Orders",
							data: response.ordersData,
						},
					],
					xaxis: {
						categories: response.months,
						title: {
							text: "Months",
						},
					},
					yaxis: {
						title: {
							text: "Number of Orders",
						},
					},
					title: {
						text: "Monthly Orders",
						align: "center",
					},
					responsive: [
						{
							breakpoint: 480,
							options: {
								chart: {
									height: 250,
								},
								xaxis: {
									labels: {
										show: true,
									},
								},
								yaxis: {
									labels: {
										show: true,
									},
								},
							},
						},
					],
				};

				var ordersChart = new ApexCharts(
					document.querySelector("#ordersChart"),
					ordersOptions
				);
				ordersChart.render();

				// Revenue Chart - Line Graph
				var revenueOptions = {
					chart: {
						type: "line",
						height: 350,
						width: "100%",
						toolbar: {
							show: false,
						},
					},
					series: [
						{
							name: "Revenue",
							data: response.revenueData,
						},
					],
					xaxis: {
						categories: response.months,
						title: {
							text: "Months",
						},
					},
					yaxis: {
						title: {
							text: "Total Revenue (₱)",
						},
					},
					title: {
						text: "Monthly Revenue",
						align: "center",
					},
					responsive: [
						{
							breakpoint: 480,
							options: {
								chart: {
									height: 250,
								},
								xaxis: {
									labels: {
										show: true,
									},
								},
								yaxis: {
									labels: {
										show: true,
									},
								},
							},
						},
					],
				};

				var revenueChart = new ApexCharts(
					document.querySelector("#revenueChart"),
					revenueOptions
				);
				revenueChart.render();
			} else {
				console.error(response.message);
			}
		},
		error: function (xhr, status, error) {
			console.error("An error occurred: " + error);
		},
	});
}
