<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="mail-container">
    <div>
        <h1>Basic Mailing</h1>
        <ul>
            <li>Open a count on https://mailtrap.io/</li>
            <li>go to <b>Demo inbox</b></li>
            <li>copy the configuration </li>
            <li>paste the on .env file</li>
        </ul>
        <pre>
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=XXX
MAIL_PASSWORD=XXX
MAIL_ENCRYPTION=tls
</pre>
    </div>

    <form action="{{ url('/sendmail') }}" method="POST">
        <input type="text" name="mail" placeholder="name@mail.com">
        <input type="text" name="title" placeholder="The  title">
        @csrf
        <input type="submit" value="Submit" id="send-mail">
    </form>
</div>

<script>
    document.querySelector('#send-mail').addEventListener('click', () => {
        document.querySelector('h1').innerText = 'Sending...'
    })
</script>