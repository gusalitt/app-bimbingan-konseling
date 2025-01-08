document.addEventListener("DOMContentLoaded", function () {
	// Displays profile data in the right content section of the navbar
	const profileImg = document.getElementById('profileImg');
	const profileData = document.getElementById('profileData');

	profileImg.addEventListener('click', (e) => {
		e.stopPropagation();

		if (profileData.classList.contains('hidden')) {
			profileData.classList.remove('hidden');
		} else {
			profileData.classList.add('hidden');
		}
	});

	document.addEventListener('click', function(e)  {
		if (!profileData.contains(e.target)) {
			if (!profileData.classList.contains('hidden')) {
				profileData.classList.add('hidden');
			}
		}
	});




	// Handle when the show and sort features on student, teacher and violation data are active
	const showSelects = document.querySelectorAll(".show-select");
	const sortSelects = document.querySelectorAll(".sort-select");
	const currentParams = new URLSearchParams(window.location.search);

	function updateParams(param, value) {
		if (value) {
			currentParams.set(param, value);
		} else {
			currentParams.delete(param);
		}

		const newUrl = window.location.pathname + "?" + currentParams.toString();
		if (window.location.href !== newUrl) {
			window.location.href = newUrl;
		}
	}

	if (showSelects.length > 0) {
		showSelects.forEach((select) => {
			select.addEventListener("change", () => {
				updateParams("show", select.value);
			});
		});
	}

	if (sortSelects.length > 0) {
		sortSelects.forEach((select) => {
			select.addEventListener("change", () => {
				updateParams("sort", select.value);
			});
		});
	}




	// Light & Dark Mode toggle
	const lightToggle = document.getElementById('light-toggle');
	const darkToggle = document.getElementById('dark-toggle');
	const modeToggle = document.getElementById('mode-toggle');
	const html = document.documentElement;

	if (localStorage.getItem('mode') === 'darkMode') {
		applyDarkMode();
	} else {
		applyLightMode();
	}
	
	function applyDarkMode() {
		html.classList.add('dark');
		lightToggle.classList.replace('block', 'hidden');
		darkToggle.classList.replace('hidden', 'block');

		localStorage.setItem('mode', 'darkMode');
	}

	function applyLightMode() {
		html.classList.remove('dark');
		lightToggle.classList.replace('hidden', 'block');
		darkToggle.classList.replace('block', 'hidden');

		localStorage.setItem('mode', 'lightMode');
	}

	function switchMode() {
		if (!html.classList.contains('dark')) {
			applyDarkMode();
		} else {
			applyLightMode();
		}
	}

	if (modeToggle) {
		modeToggle.addEventListener('click', () => {
			switchMode();
		})
	}
});
