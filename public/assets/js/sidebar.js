document.addEventListener('DOMContentLoaded', function() {
	// Handle the sidebar will be minimized or expanded.
	const sidebarStatus = localStorage.getItem("sidebarStatus") ?? "";
	const hamburgerBtn = document.getElementById("hamburger");
	const sidebar = document.getElementById("sidebar");
	const contentContainer = document.getElementById("content-container");

	if (window.innerWidth < 768) {
		contentContainer.classList.replace("w-calc-100-250", "w-full");
	} else if (window.innerWidth == 768) {
		contentContainer.classList.replace("w-calc-100-250", "w-calc-100-70");
	}

	if (sidebarStatus == 'minimized') {
		minimizeSidebar(false);
	}

	hamburgerBtn.addEventListener("click", function () {
		minimizeSidebar(true);
	});

	document.addEventListener('keydown', function(e) {
		if (e.ctrlKey && (e.key == 'b' || e.key == 'B')) {
			minimizeSidebar(true);
		}
	});

	window.addEventListener('resize', function() {
		handleResize();
	});

	function minimizeSidebar(applyTransition = true) {
		if (!applyTransition) {
			sidebar.style.transitionDuration = '0ms';
			contentContainer.style.transitionDuration = '0ms';
		} else {
			sidebar.style.transitionDuration = '';
			contentContainer.style.transitionDuration = '';
		}

		if (!sidebar.classList.contains("active")) {
			if (window.innerWidth < 768) {
				contentContainer.classList.replace("w-calc-100-70", "w-full");
				contentContainer.classList.replace("w-calc-100-250", "w-full");
			} else {
				contentContainer.classList.replace("w-calc-100-250", "w-calc-100-70");
			}
			localStorage.setItem("sidebarStatus", "minimized");
		} else {
			if (window.innerWidth < 768) {
				contentContainer.classList.replace("w-calc-100-70", "w-full");
				contentContainer.classList.replace("w-calc-100-250", "w-full");
			} else {
				contentContainer.classList.replace("w-calc-100-70", "w-calc-100-250");
			}
			localStorage.setItem("sidebarStatus", "expanded");
		}

		sidebar.classList.toggle("active");
	}

	function handleResize() {
		const isSidebarActive = sidebar.classList.contains('active');
		const sidebarStatus = localStorage.getItem("sidebarStatus") ?? "";

		if (window.innerWidth < 768) {
				contentContainer.classList.replace("w-calc-100-70", "w-full");
				contentContainer.classList.replace("w-calc-100-250", "w-full");
		} else {
			if (sidebarStatus == 'minimized' || isSidebarActive) {
				contentContainer.classList.replace("w-full", "w-calc-100-70");
			} else if (sidebarStatus == 'expanded' || !isSidebarActive) {
				contentContainer.classList.replace("w-full", "w-calc-100-250");
			}
		}
	}




	// Handle dropdown on the sidebar menu.
	const listSidebar = Array.from(document.querySelectorAll("li.list-sidebar"));
	const dropdownSidebar = Array.from(document.querySelectorAll("ul.dropdown-sidebar"));

	dropdownSidebar.forEach(dropdown => {
		if (dropdown.classList.contains('show')) {
			dropdown.classList.replace('duration-300', 'duration-0');
			dropdown.style.height = dropdown.scrollHeight + 'px';

			setTimeout(() => {
				dropdown.classList.replace('duration-0', 'duration-300');
			}, 50);
		} else {
			dropdown.style.height = '0px';
		}
	});

	listSidebar.forEach((item) => {
		item.addEventListener("click", function (e) {
			const dropdown = item.querySelector("ul.dropdown-sidebar");

			if (!dropdown.contains(e.target)) {
				dropdownSidebar.forEach((currContent) => {
					if (currContent != dropdown) {
						currContent.classList.remove("show");
						currContent.style.height = "0px";
					}
				});

				const isShown = dropdown.classList.contains("show");
				dropdown.classList.toggle("show", !isShown);
				dropdown.style.height = isShown ? "0px" : dropdown.scrollHeight + "px";
			}
		});
	});




	// Handle when the Sidebar button is clicked. (title)
	const sidebarBtns = Array.from(document.querySelectorAll(".sidebar-btn"));
	sidebarBtns.forEach((item) => {
		item.addEventListener("click", function () {
			handleWhenClicked(sidebarBtns, item);
		});
	});




	// Handle when the Sidebar button is clicked. (list-subtitle)
	const subTitles = Array.from(document.querySelectorAll("a.list-subtitles"));
	subTitles.forEach((item) => {
		item.parentElement.addEventListener("click", function () {
			handleWhenClicked(subTitles, item);
		});
	});

	function handleWhenClicked(parent, item) {
		parent.forEach((itm) => itm.classList.remove("active"));
		item.classList.add("active");
	}
});