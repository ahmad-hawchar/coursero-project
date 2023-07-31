<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="logo">LOGO</div>
    <section>




        <form action="login2.php?tochat= $tochat" method="post">
            <div class="title">Signin</div>
            <div class="error">
                <?php
                if (isset($_GET['error'])) {
                    echo "<tr style='color:red'><td style='text-align:right'>we incountered an error while </td><td style='text-align:left'>logging you in!please try again</td></tr>";
                }
                ;
                if (isset($_GET['wrong'])) {
                    echo "<tr style='color:red'><td style='text-align:right'>the username/password </td><td style='text-align:left'>that you entered is wrong!</td></tr> ";
                }
                ;
                if (isset($_GET['registered'])) {
                    echo "<tr style='color:red'><td style='text-align:right'> we just created your account!login to </td><td style='text-align:left'> proceed into our homepage </td></tr> ";
                }
                ;



                ?>
            </div>
            <ul>
                <li><input type="text" name="username" placeholder="  Username" required
                        style="width: 200px; height: 35px;border-radius: 5px;"></li>
                <li><input type="password" name="password" placeholder="  Password" required
                        style="width: 200px; height: 35px; border-radius: 5px;"></li>
                <li><button style="width: 200px; height: 35px;border-radius: 5px;">Signin</button></li>
                <li><a href="register.php">Don't have an acccount? Signup now!</a></li>
            </ul>
        </form>
        </div>
        </div>


        </div>
    </section>
</body>

</html>