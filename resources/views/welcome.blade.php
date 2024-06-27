<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
    <meta content="discription" content="dissss">
</head>

<body>
    <h1>Seo Testing</h1>
    <script>
        const url = 'http://127.0.0.1:8000/api/www.google.com/Contact';
        const head = document.head;

        async function fetchData() {
                const response = await fetch(url);
                const data = await response.text();
                head.innerHTML = data;
        }
        window.onload = fetchData;
    </script>
</body>

</html>
