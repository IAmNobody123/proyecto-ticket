document.querySelectorAll('.toggle-password').forEach(toggle => {
    toggle.addEventListener('click', () => {
        const passwordInput = toggle.previousElementSibling;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggle.querySelector('i').classList.remove('fa-eye');
            toggle.querySelector('i').classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggle.querySelector('i').classList.remove('fa-eye-slash');
            toggle.querySelector('i').classList.add('fa-eye');
        }
    });
});