document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll('.book-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
        document.getElementById('room_id').value = this.dataset.roomId;
        document.getElementById('day').value = this.dataset.day;
        document.getElementById('pair').value = this.dataset.pair;
        document.getElementById('group-name').value = '';
        });
    });
    document.querySelectorAll('[data-bs-target="#deleteModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.bookingId;
            document.getElementById('booking_id').value = id;
        });
    });

    document.getElementById('deleteForm').addEventListener('submit', function (event) {
        const id = document.getElementById('booking_id').value;
        this.action = `/booking/${id}`;
    });
});