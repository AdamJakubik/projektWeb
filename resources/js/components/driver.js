document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname === '/') {
        var modal = document.getElementById("myModal");
        var form = document.getElementById('deleteForm');
        var deleteButton = document.getElementById('deleteButton1');
        var cancelButton = document.getElementById('cancelButton');

        cancelButton.addEventListener('click', function() {
            modal.classList.add("hidden");
        });

        this.setFormAction = function(driverId) {
            form.action = '/driver/' + driverId;
            modal.classList.remove("hidden");
            deleteButton.dataset.id = driverId;
        };

        var modalHandler = {
            openModal: this.setFormAction
        };
        var btn = document.getElementById('deleteButton1');
        btn.addEventListener('click', function() {
            var driverId = this.dataset.id;
            modalHandler.openModal(driverId);
        });
    }
});