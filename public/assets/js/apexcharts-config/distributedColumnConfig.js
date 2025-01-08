export function getDistributedColumnConfig(chartDataUrl, callback) {
	fetch(chartDataUrl, {
		method: 'GET',
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		}
	})
		.then((response) => response.json())
		.then((data) => {
			if (!data.studentsIndustryByMajor || Object.keys(data.studentsIndustryByMajor).length === 0) {
				document.getElementById("distributed-column").innerHTML = "<p class='text-center text-2xl text-light-text dark:text-dark-text'>Tidak ada data yang ditemukan.</p>";
				return;
			}
			const categories = Object.keys(data.studentsIndustryByMajor);
			const totals = Object.values(data.studentsIndustryByMajor);
			const colors = ["#ff147f", "#00E396", "#775DD0", "#FEB019"];

			var optionsDistributedColumns = {
				series: [
					{
						data: totals,
					},
				],
				chart: {
					height: '350px',
					type: "bar",
				},
				colors: colors,
				plotOptions: {
					bar: {
						columnWidth: "45%",
						distributed: true,
						borderRadius: 10,
					},
				},
				dataLabels: {
					enabled: false,
				},
				legend: {
					show: false,
				},
				xaxis: {
					categories: categories,
					title: {
						text: "Jurusan",
					},
				},
				yaxis: {
					title: {
						text: "Jumlah Siswa Industri",
					},
				},
				tooltip: {
					enabled: true,
					y: {
						title: {
							formatter: function (value) {
								return value + " siswa";
							},
						},
					},
				},
			};

			callback(optionsDistributedColumns);
		})
		.catch((error) => {
			console.error("Error fetching data:", error);
			document.getElementById("distributed-column").innerHTML = "<p class='text-center text-2xl text-light-text dark:text-dark-text'>Terjadi kesalahan saat memuat data.</p>";
		});
}
