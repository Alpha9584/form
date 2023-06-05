document.addEventListener('DOMContentLoaded', function () {
    var loginModal = document.getElementById('loginModal');
    var registerModal = document.getElementById('registerModal');
    var loginBtn = document.getElementById('loginBtn');
    var registerBtn = document.getElementById('registerBtn');
    var closeBtns = document.getElementsByClassName('close');

    loginBtn.onclick = function () {
        loginModal.style.display = 'block';
    };

    registerBtn.onclick = function () {
        registerModal.style.display = 'block';
    };

    for (var i = 0; i < closeBtns.length; i++) {
        closeBtns[i].onclick = function () {
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        };
    }

    window.onclick = function (event) {
        if (event.target == loginModal || event.target == registerModal) {
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        }
    };
});
