export function getSplineAreaConfig(chartDataUrl, callback) {
	fetch(chartDataUrl, {
		method: 'GET',
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		}
	})
		.then((response) => response.json())
		.then((data) => {
			if (Object.keys(data.konseling).length === 0 &&
				Object.keys(data.pelanggaran).length === 0) {
				document.getElementById("spline-area").innerHTML = "<p class='text-center text-2xl text-light-text dark:text-dark-text'>Tidak ada data yang ditemukan.</p>";
				return;
			}

			const allDates = [...new Set([...Object.keys(data.konseling), ...Object.keys(data.pelanggaran)])].sort();
			const konselingSeries = allDates.map((date) => data.konseling[date] || 0);
			const pelanggaranSeries = allDates.map((date) => data.pelanggaran[date] || 0);

			var optionsSplineArea = {
				series: [
					{
						name: "Pelanggaran",
						data: pelanggaranSeries,
					},
					{
						name: "Konseling",
						data: konselingSeries,
					},
				],
				chart: {
					height: '350px',
					type: "area",
				},
				colors: ["#ff147f", "#00E396"],
				dataLabels: {
					enabled: false,
				},
				stroke: {
					curve: "smooth",
				},
				xaxis: {
					type: "datetime",
					categories: allDates,
				},
				tooltip: {
					x: {
						format: "dd-MM-yy",
					},
				},
			};

			callback(optionsSplineArea);
		})
		.catch((error) => {
			console.error("Error fetching data:", error);
			document.getElementById("spline-area").innerHTML = "<p class='text-center text-2xl text-light-text dark:text-dark-text'>Terjadi kesalahan saat memuat data.</p>";
		});
}
