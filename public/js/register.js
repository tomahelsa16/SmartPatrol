// Fungsi untuk memvalidasi password
function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password_confirmation").value;
    var passwordPattern = /^(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9]{8,10}$/;

    // Cek apakah password memenuhi syarat
    if (!passwordPattern.test(password)) {
        document.getElementById("password-error").innerHTML = "Password tidak valid";
        document.getElementById("password-error").style.display = "block";
        return false; // Mencegah form disubmit
    } else {
        document.getElementById("password-error").style.display = "none";
    }

    // Cek apakah password dan konfirmasi password cocok
    if (password !== confirmPassword) {
        document.getElementById("confirm-password-error").innerHTML = "Password dan konfirmasi password tidak cocok.";
        document.getElementById("confirm-password-error").style.display = "block";
        return false; // Mencegah form disubmit
    } else {
        document.getElementById("confirm-password-error").style.display = "none";
    }

    return true; // Form dapat disubmit jika validasi berhasil
}

// Fungsi untuk melihat dan menyembunyikan password
function togglePassword() {
    var passwordField = document.getElementById("password");
    // Toggle the type attribute
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

// Fungsi untuk melihat dan menyembunyikan konfirmasi password
function toggleConfirmPassword() {
    var confirmPasswordField = document.getElementById("password_confirmation");
    // Toggle the type attribute
    if (confirmPasswordField.type === "password") {
        confirmPasswordField.type = "text";
    } else {
        confirmPasswordField.type = "password";
    }
}
