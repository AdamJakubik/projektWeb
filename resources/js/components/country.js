document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/country') {
        var modal = document.getElementById("myModal");
        var form = document.getElementById('deleteForm');
        var deleteButton = document.querySelector('.btn.btn-outline.btn-error');
        document.querySelector('.btn.btn-outline.btn-primary').addEventListener('click', closeModal);

        this.setFormAction = function(countryId) {
            form.action = '/country/delete/' + countryId;
            modal.classList.remove("hidden");
            deleteButton.dataset.id = countryId;
        };

        var modalHandler = {
            openModal: setFormAction
        };

        function closeModal() {
            modal.classList.add("hidden");
        }

        var btns = document.querySelectorAll('.btn.btn-outline.btn-error');
        btns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var countryId = this.dataset.id;
                modalHandler.openModal(countryId);
            });
        });
    }
});