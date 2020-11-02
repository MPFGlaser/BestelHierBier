function registerMode() {
    var rf = document.getElementById("registerForm");
    var lf = document.getElementById("loginForm");
    var cb = document.getElementById("registerCheckbox");
    if (cb.checked == true) {
        lf.style.display = 'none';
        rf.style.display = 'block';
    } else {
        lf.style.display = 'block';
        rf.style.display = 'none';
    }
}