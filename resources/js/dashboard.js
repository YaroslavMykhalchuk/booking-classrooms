document.addEventListener("DOMContentLoaded", function () {
    const editRoomButtons = document.querySelectorAll('.edit-room-btn');
    if (editRoomButtons.length) {
        editRoomButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.roomId;
                const name = this.dataset.roomName;

                const inputId = document.getElementById('edit-room-id');
                const inputName = document.getElementById('edit-room-name');
                if (inputId && inputName) {
                    inputId.value = id;
                    inputName.value = name;
                }
            });
        });
    }

    const deleteModal = document.getElementById('deleteRoomModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const roomId = button?.getAttribute('data-room-id');
            const input = document.getElementById('delete-room-id');
            if (input && roomId) {
                input.value = roomId;
            }
        });
    }

    const editUserButtons = document.querySelectorAll('.btn-warning[data-bs-target="#editUserModal"]');
    if (editUserButtons.length) {
        editUserButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.dataset.userId;
                const userName = this.dataset.userName;

                const inputId = document.getElementById('edit-user-id');
                const inputName = document.getElementById('edit-user-name');
                if (inputId && inputName) {
                    inputId.value = userId;
                    inputName.value = userName;
                }
            });
        });
    }

    const deleteUserModal = document.getElementById('deleteUserModal');
    if (deleteUserModal) {
        deleteUserModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button?.getAttribute('data-user-id');
            const input = document.getElementById('delete-user-id');
            if (input && userId) {
                input.value = userId;
            }
        });
    }

    const confirmModal = document.getElementById('confirmUserModal');
    if (confirmModal) {
        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');

            const input = document.getElementById('confirm-user-id');
            if (input) {
                input.value = userId;
            }
        });
    }
});