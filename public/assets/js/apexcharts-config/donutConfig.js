export function getDonutConfig(chartDataUrl, callback) {
	fetch(chartDataUrl, {
		method: 'GET',
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		}
	})
		.then((response) => response.json())
		.then((data) => {
			if (!data.studentsByMajor || Object.keys(data.studentsByMajor).length === 0) {
				document.getElementById("donut").innerHTML = "<p class='text-center text-2xl text-light-text dark:text-dark-text'>Tidak ada data yang ditemukan.</p>";
				return;
			}
			const categories = Object.keys(data.studentsByMajor);
			const totals = Object.values(data.studentsByMajor);
			const colors = ["#ff147f", "#00E396", "#775DD0", "#FEB019"];

			var optionsDonut = {
				series: totals,
				chart: {
					type: "pie",
					height: "100%",
					width: "100%",
				},
				colors: colors,
				labels: categories,
				responsive: [
					{
						breakpoint: 480,
						options: {
							chart: {
								width: 400,
							},
							legend: {
								position: "bottom",
							},
						},
					},
				],
				legend: {
					position: "right",
				},
				xaxis: {
					title: {
						text: "Jumlah Siswa berdasarkan jurusan",
					},
					position: "top",
				},
				tooltip: {
					y: {
						formatter: function (value) {
							return value + " siswa";
						},
					},
				},
			};

			callback(optionsDonut);
		})
		.catch((error) => {
			console.error("Error fetching data:", error);
			document.getElementById("donut").innerHTML = "<p class='text-center text-2xl text-light-text dark:text-dark-text'>Terjadi kesalahan saat memuat data.</p>";
		});
}
