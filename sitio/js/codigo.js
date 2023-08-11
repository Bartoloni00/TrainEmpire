const ojo = document.getElementById('ojo');
const inputPassword = document.querySelector('input[ id="password"]');
ojo.addEventListener('click',()=>{
    if (inputPassword.type === 'password') {
        inputPassword.type = 'text';
    } else {
        inputPassword.type = 'password'
    }
})