function validateForm() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if (email === "" || password === "") {
        alert("Email dan Password tidak boleh kosong!");
        return false;
    }
    return true;
}