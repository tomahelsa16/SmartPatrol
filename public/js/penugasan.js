document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi tabel penugasan
    const table = document.getElementById('penugasanTable');
    
    // Menambahkan aksi mulai/batalkan jika diperlukan
    const actionButtons = table.querySelectorAll('.btn');
    
    actionButtons.forEach(button => {
        button.addEventListener('click', function () {
            const action = this.innerText;
            if (action === 'Mulai') {
                // Logika untuk memulai penugasan
                alert('Penugasan Dimulai');
            } else if (action === 'Batalkan') {
                // Logika untuk membatalkan penugasan
                alert('Penugasan Dibatalkan');
            }
        });
    });
});
