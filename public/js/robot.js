document.addEventListener("DOMContentLoaded", () => {

    /* ============================================================
       INISIALISASI SELECT2
    ============================================================ */
    $('.feature-select').select2({
        width: '100%',
        placeholder: "Pilih fitur...",
        dropdownParent: $('#popupForm')
    });

    const popup      = document.getElementById("popupForm");
    const openPopup  = document.getElementById("openPopup");
    const closePopup = document.getElementById("closePopup");
    const btnSubmit  = document.getElementById("btnSubmit");
    const errorBox   = document.getElementById("featureError");


    /* ============================================================
       VALIDASI FITUR
    ============================================================ */
    function validateFeatures() {
        let total = 0;

        // Hitung total fitur
        $('.feature-select').each(function () {
            const selected = $(this).val();
            if (selected) total += selected.length;
        });

        // Validasi kategori wajib
        const nav = ($('.kategori-navigasi').val() || []).length;
        const env = ($('.kategori-lingkungan').val() || []).length;
        const cam = ($('.kategori-kamera').val() || []).length;

        let errors = [];

        if (!nav) errors.push("Navigasi");
        if (!env) errors.push("Sensor Lingkungan");
        if (!cam) errors.push("Sistem Kamera");

        // Output pesan error
        if (errors.length > 0 || total < 3) {
            btnSubmit.disabled = true;

            if (errors.length > 0) {
                errorBox.textContent = errors.join(", ") + " wajib dipilih minimal 1 fitur.";
            } else {
                errorBox.textContent = "Minimal pilih total 3 fitur.";
            }
        } 
        else {
            btnSubmit.disabled = false;
            errorBox.textContent = "";
        }
    }


    /* ============================================================
       EVENT CHANGE SELECT2
    ============================================================ */
    $(document).on("change", ".feature-select", validateFeatures);


    /* ============================================================
       POPUP OPEN
    ============================================================ */
    openPopup.addEventListener("click", () => {
        popup.style.display = "flex";
        validateFeatures();
    });


    /* ============================================================
       POPUP CLOSE
    ============================================================ */
    closePopup.addEventListener("click", () => {
        popup.style.display = "none";
    });

});
