<?php
if (isset($_COOKIE["usrlogin"])) {
    echo "<script>window.location='chat.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbusr = $_POST["username"];
    $dbpass = $_POST["password"];

    if ($dbpass == "Formas23") {
        $expiry = time() + 36000;
        if (isset($_POST["remember"])) {
            setcookie("usrlogin", $dbusr, $expiry, true);
        } else {
            setcookie("usrlogin", $dbusr, $expiry);
        }
        echo "<script>window.location='chat.php';</script>";
        exit;
    } else {
        echo "<script>alert ('Password tidak sesuai'); window.location='login.php';</script>";
    }
}
?>
<html>

<head>
    <style>
        @font-face {
            font-family: 'Oppo';
            src: url(Source/OPPOSansRegular.ttf);
        }

        body {
            font-family: 'Oppo';
            user-select: none;
            margin: 0;
        }

        #LoginCard {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            overflow: hidden;
        }

        #LoginCard1,
        #LoginCard2 {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        #LoginCard11 {
            width: 60%;
            aspect-ratio: 1/1;
            opacity: 0;
            position: relative;
            right: -100%;
        }

        #LoginCard21 {
            width: 250px;
            height: 40%;
            border-radius: 20px;
            opacity: 0;
            position: relative;
            left: 20%;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            padding: 0 10px 0 10px;
        }

        #username,
        #password,
        #submit {
            font-family: 'Oppo';
            background: #f5f5f5;
            border: none;
            padding: 0 5px 0 5px;
            margin-bottom: 15px;
            height: 30px;
            width: 100%;
            border-radius: 10px;
        }

        #submit {
            width: 70%;
            color: white;
            background: #1D83C3;
            font-weight: bold;
            margin-bottom: 0;
        }
    </style>

</head>

<body>
    <div id="Logincard">
        <div id="LoginCard1">
            <div id="LoginCard11">
                <img src="Source/LogoFormas.png" width="100%">
            </div>
        </div>
        <div id="LoginCard2">
            <div id="LoginCard21">
                <center>
                    <h2>LOGIN</h2>
                </center>
                <form id="form1" action="" method="post">
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" placeholder="Nama Anda">
                    <br>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" placeholder="Formas23">
                    <br>
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                    <br>
                    <br>
                    <center>
                        <input type="submit" id="submit" name="submit" value="Login">
                    </center>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <script>
        anime({
            targets: '#LoginCard21',
            opacity: 1,
            duration: 1000,
            easing: 'easeInOutQuad',
            delay: 500
        });
        anime({
            targets: '#LoginCard11',
            translateX: ['-100%'],
            opacity: 1,
            easing: 'easeOutCirc',
            duration: 800,
            delay: 1600
        });
    </script>
</body>

</html>