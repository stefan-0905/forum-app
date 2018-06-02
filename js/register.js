function register() 
{
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;

    let data = {
        username: username,
        email: email,
        password: password,
        confirm_password: confirm_password
    }

    if(password == confirm_password)
        register_user(JSON.stringify(data));
}

function register_user(data)
{
    let request = new XMLHttpRequest();
    request.open('POST', 'admin/includes/api/user/create.php');
    request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    request.send(data);
    request.onreadystatechange = function() {
        if(request.readyState == 4) {
            if(request.status == 200){
               let message = JSON.parse(request.responseText).message;
               document.getElementById('errors').classList.add('d-block');
               document.getElementById('errors').innerText = message;
            }
        } else 
        console.log(request.status, request.statusText)
    };
}

document.getElementById('register').onclick = register;