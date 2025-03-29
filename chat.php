<?php
function clearCookies()
{
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 3600, '/');
            setcookie($name, '', time() - 3600);
        }
    }
}

if (isset($_POST["logout"])) {
    clearCookies();
    echo "<script>window.location='login.php';</script>";
    exit;
}

if (isset($_COOKIE["usrlogin"])) {
    $dbuser = $_COOKIE["usrlogin"];
} else {
    echo "<script>window.location='login.php';</script>";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim'])) {
    $msgs = explode("\n", $_POST['msg']);
    $msg = implode("<br>", $msgs);
    if (!empty($msg)) {
        $dbuser = $_COOKIE["usrlogin"];
        $file = fopen("datachat.txt", "a");
        $data = "$dbuser|$msg\n";
        fwrite($file, $data);
        fclose($file);
    } else {
        echo "<script>alert ('Pesan yang anda kirim kosong');</script>";
    }
    echo "<script>window.location='chat.php';</script>";
    exit;
}

?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
div[style*="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;"] {
    display: none !important;
}

img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
    display: none !important;
}

a[href*="https://www.000webhost.com/?utm_source=000webhostapp&utm_campaign=000_logo&utm_medium=website&utm_content=footer_img"] {
    display: none !important;
}
        @font-face {
            font-family: 'Oppo';
            src: url(Source/OPPOSansRegular.ttf);
        }

        body {
            font-family: 'Oppo';
            user-select: none;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Oppo';
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }



        #dock {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 10%;

        }

        #ngisichat {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        #msg {
            width: calc(100% - 55px);
            height: 45px;
            padding: 12px 16px 11px 16px;
            font-size: 17px;
            background-color: #f5f5f5;
            border-radius: 100px;
            resize: none;
            overflow: hidden;
        }

        #ngisichat input[type="submit"] {
            width: 45px;
            aspect-ratio: 1/1;
            background-color: #1D83C3;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 24 24'%3E%3Cpath fill='white' d='M12 21a9 9 0 1 1 9-9a9 9 0 0 1-9 9m0-16.5a7.5 7.5 0 1 0 7.5 7.5A7.5 7.5 0 0 0 12 4.5'%3E%3C/path%3E%3Cpath fill='white' d='M10 16.75a.74.74 0 0 1-.53-.22a.75.75 0 0 1 0-1.06L12.94 12L9.47 8.53a.75.75 0 0 1 1.06-1.06l4 4a.75.75 0 0 1 0 1.06l-4 4a.74.74 0 0 1-.53.22'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #ngisichat input[type="submit"]:hover {
            background-color: red;
        }
    </style>
</head>

<body>
    <center>
        <h1>Formas Global Chat</h1>
    </center>
    <form action="" method="post">
        <input type="hidden" name="logout" value="1">
        <input type="submit" value="Logout">
    </form>
    <div id="dock">
        <form id="ngisichat" action="" method="POST">
            <textarea id="msg" name="msg" rows="2" cols="100" placeholder="Ketik Pesan"></textarea><br><input type="submit" value="" name="kirim">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody id="mahasiswa-body">
        </tbody>
    </table>
    <script>
        function handleData(event) {
            var data = JSON.parse(event.data);
            // console.log('Data received:', data);
            var mahasiswaBody = document.getElementById('mahasiswa-body');
            mahasiswaBody.innerHTML = '';
            data.forEach(function(item) {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item[0]}</td>
                    <td>${item[1]}</td>
                `;
                mahasiswaBody.appendChild(row);
            });
        }

        // SSE connection
        var eventSource = new EventSource('sse_server.php');
        eventSource.onmessage = handleData;
    </script>
</body>

</html>