function showModal(modal, modalContent, event = null) {
	modal.classList.add("show");
	modalContent.classList.replace("scale-0", "scale-90");

	if (event != null) event.stopPropagation();
}

function closeModal(modalBox, modalContent, modalClose) {
	if (modalClose) {
		document.addEventListener("keydown", function (e) {
			if (e.key == "Enter" && modalBox == successModal) {
				modalContent.classList.replace("scale-90", "scale-0");

				setTimeout(() => {
					modalBox.classList.remove("show");
				}, 100);
			}
		});

		modalClose.addEventListener("click", function () {
			modalContent.classList.replace("scale-90", "scale-0");

			setTimeout(() => {
				modalBox.classList.remove("show");
			}, 100);
		});

		document.addEventListener("click", function (e) {
			if (e.target === modalBox || e.target === modalClose) {
				modalContent.classList.replace("scale-90", "scale-0");

				setTimeout(() => {
					modalBox.classList.remove("show");
				}, 100);
			}
			return;
		});
	}
	return;
}
