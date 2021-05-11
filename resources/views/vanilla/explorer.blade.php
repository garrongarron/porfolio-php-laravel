<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Explorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="module">
        let column1 = document.querySelector('.column1 ul')
        let pre = document.querySelector('pre')
        let getFile = (id) => {
            fetch('/api/explorer?id=' + id)
                .then(response => response.text())
                .then(data => {
                    pre.innerText = data
                })
        }
        fetch('/api/getlist')
            .then(response => response.json())
            .then(json => {
                console.log(json);
                json.map((filename, index) => {
                    let li = document.createElement('li')
                    li.innerText = filename
                    li.addEventListener('click', () => {
                        getFile(index);
                    })
                    column1.appendChild(li)

                })
            })
    </script>
</head>

<body>
    <div class="explorer-container">
        <div class="table">
            <div class="column2">
                <pre></pre>
            </div>
            <div class="column1">
                <p>How to make an RestFul API with Vanilla PHP</p>
                <h2>Files</h2>
                <ul>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>