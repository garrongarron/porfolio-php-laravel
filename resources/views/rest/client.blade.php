<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client RestFul API</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="module">
        let authenticated = () => {
            document.querySelector('h2').style.color = '#080'
            document.querySelector('h2').innerText = 'Autenticated'
            document.querySelector('.login').classList.add('hide')
            document.querySelector('.register').classList.add('hide')
            document.querySelector('small.logout').innerText = 'Logout'
        }
        let isAuthenticated = () => {
            return localStorage.getItem('access_token') || null
        }
        if (isAuthenticated()) {
            authenticated()
        }
        document.querySelector('.register button')
            .addEventListener('click', () => {
                let status = null
                fetch('/api/register', {
                        method: 'POST',
                        body: JSON.stringify({
                            name: document.querySelector('.register #name').value,
                            email: document.querySelector('.register #email').value,
                            password: document.querySelector('.register #password').value,
                            password_confirmation: document.querySelector('.register #password_confirmation').value
                        }),
                        headers: {
                            "Content-type": "application/json; charset=UTF-8",
                            "Accept": "application/json"
                        }
                    })
                    .then(response => {
                        status = response.status
                        return response.json()
                    })
                    .then(json => {
                        console.log(json)
                        if(status == 201){
                            authenticated()
                            localStorage.setItem('access_token', json.access_token)
                        }
                        document.querySelector('.msg > span').innerText = json.message
                    })
            })

        

        document.querySelectorAll('.toggle').forEach(element => {
            element.addEventListener('click', () => {
                document.querySelector('.login').classList.toggle('hide')
                document.querySelector('.register').classList.toggle('hide')
            })
        });
        document.querySelector('.login button').addEventListener('click', () => {
            let status = null
            fetch('/api/login', {
                    method: 'POST',
                    body: JSON.stringify({
                        email: document.querySelector('.login #email-login').value,
                        password: document.querySelector('.login #password-login').value
                    }),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        "Accept": "application/json"
                    }
                })
                .then(response => {
                    status = response.status
                    return response.json()
                })
                .then(json => {
                    console.log(json)
                    if (status == 200) {
                        authenticated()
                        localStorage.setItem('access_token', json.access_token)
                    } else {
                        document.querySelector('h2').style.color = '#c00'
                    }
                    document.querySelector('.msg > span').innerText = json.message

                })
        })
        document.querySelector('small.logout').addEventListener('click',()=>{
            let status
            fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        "Accept": "application/json",
                        'Authorization': 'Bearer ' + localStorage.getItem('access_token'),
                    }
                })
                .then(response => {
                    status = response.status
                    return response.json()
                })
                .then(json => {
                    console.log(json)
                    if (status == 200) {
                        document.querySelector('h2').style.color = '#c00'
                        document.querySelector('h2').innerText = 'Logged out!'
                        document.querySelector('small.logout').innerText = ''
                    } 
                    localStorage.removeItem('access_token')
                    document.querySelector('.msg > span').innerText = json.message
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                }).catch(e=>{
                    localStorage.removeItem('access_token')
                    console.error(e);
                })
        })
    </script>
</head>

<body>
    <div class="rest-client-container">
        <h1>Client Rest</h1>
        <h2>Autentication</h2>
        

        <div class="register hide">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="text" name="email" id="email" placeholder="name@domain.com">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
            <div>
                <span class="toggle">Login</span>
                <button>Register</button>
            </div>
        </div>
        <div class="login">
            <input type="text" name="email" id="email-login" placeholder="name@domain.com">
            <input type="password" name="password" id="password-login" placeholder="Password">
            <div>
                <span class="toggle">Register</span>
                <button>Login</button>
            </div>

        </div>
        <div class="msg"> Message: <span>...</span></div>
        <div class="result">

        </div>
        <small class="logout"></small>
    </div>

</body>

</html>