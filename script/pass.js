$(document).ready(function () {
    // When the eye icon is clicked and held
    $('.icon').mousedown(function () {
        $('.password').attr('type', 'text');
    });

    // When the mouse is released or leaves the eye icon
    $('.icon').on('mouseup mouseleave', function () {
        $('.password').attr('type', 'password');
    });
});

// const togglePassword = document.querySelector('#togglePassword');
//   const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

// function password_show_hide() {
//     var x = document.getElementById("password");
//     var show_eye = document.getElementById("show_eye");
//     var hide_eye = document.getElementById("hide_eye");
//     hide_eye.classList.remove("d-none");
//     if (x.type === "password") {
//       x.type = "text";
//       show_eye.style.display = "none";
//       hide_eye.style.display = "block";
//     } else {
//       x.type = "password";
//       show_eye.style.display = "block";
//       hide_eye.style.display = "none";
//     }
//   }

  function password_show_hide() {
    const password = document.getElementById("password");
    const show_eye = document.getElementById("show_eye");
    const hide_eye = document.getElementById("hide_eye");

    if (password.type === "password") {
        password.type = "text";
        show_eye.classList.add("d-none");
        hide_eye.classList.remove("d-none");
    } else {
        password.type = "password";
        show_eye.classList.remove("d-none");
        hide_eye.classList.add("d-none");
    }
}
