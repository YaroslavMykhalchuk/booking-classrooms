document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.edit-room-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.roomId;
            const name = this.dataset.roomName;

            document.getElementById('edit-room-id').value = id;
            document.getElementById('edit-room-name').value = name;
        });
    });

    const deleteModal = document.getElementById('deleteRoomModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const roomId = button.getAttribute('data-room-id');
        document.getElementById('delete-room-id').value = roomId;
    });
});