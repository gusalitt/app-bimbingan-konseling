<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Variable Modal Form Add & Edit data.
        const openModal = Array.from(document.querySelectorAll(".open-modal"));
        const modal = Array.from(document.querySelectorAll(".modal"));
        const modalContent = Array.from(document.querySelectorAll(".modal-content"));
        const closeFormModal = Array.from(document.querySelectorAll(".close-modal"));

        // Variable Modal message success.
        const successModal = document.getElementById("successModal");
        const successModalContent = document.getElementById("successModalContent");
        const closeSuccessModal = document.getElementById("closeSuccessModal");


        // Add Data
        if (openModal[0]) {
            openModal[0].onclick = function(event) {
                showModal(modal[0], modalContent[0], event);
            };
        }
        closeModal(modal[0], modalContent[0], closeFormModal[0]);



        // Check whether there is a query params key before the url is reset
        const urlParams = new URLSearchParams(window.location.search);
        let keyword = '';
        let sort = '';

        if (urlParams.has('key')) {
            keyword = '?key=' + urlParams.get('key');
        }

        if (urlParams.has('sort') && urlParams.has('order')) {
            sort = `sort=${urlParams.get('sort')}&order=${urlParams.get('order')}`;
        }



        // Validation Add data input
        <?php if (isset($ModalAddActive) && $ModalAddActive) : ?>
            window.onload = function() {
                showModal(modal[0], modalContent[0]);
                closeModal(modal[0], modalContent[0], closeFormModal[0]);

                // Change to new url after form is submitted. 
                clearUrl(keyword, sort);
            }
        <?php endif; ?>



        // Edit Data
        <?php if (isset($ModalEditActive) && $ModalEditActive) : ?>
            window.onload = function() {
                showModal(modal[1], modalContent[1]);
                closeModal(modal[1], modalContent[1], closeFormModal[1]);

                // Change to new url after form is submitted. 
                clearUrl(keyword, sort);
            }
        <?php endif; ?>



        // Message Success.
        <?php if (session()->getFlashdata('modalMessage')) : ?>
            window.onload = function() {
                showModal(successModal, successModalContent);
                closeModal(successModal, successModalContent, closeSuccessModal);
            }
        <?php endif ?>



        function clearUrl(keyword = '', sort = '') {
            let url = "/<?= $title ?? ''; ?>";
            
            if (keyword && sort) url += keyword + '&' + sort;

            if (!keyword && !sort) url += '';

            if (!keyword && sort) url += '?' + sort;

            if (keyword && !sort) url += keyword;

            window.history.replaceState(null, null, url);
        }

    });
</script>