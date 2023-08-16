<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
    <div class="logo"><a href="homepage.php">LOGO</a></div>

    <section>


        <form action="register2.php" method="post">

            <div class="title">Signup</div>
            <div class="error">
                <p id="error"></p>

                <?php

                if (isset($_GET["error"])) {
                    echo "<td>";
                    echo "<span style='color:red'>error! please try again.<span>";
                    echo "</td>";
                }

                if (isset($_GET["taken"])) {
                    echo "<td>";
                    echo "<span style='color:red'>username is already taken!.<span>";
                    echo "</td>";
                }



                ?>

            </div>


            <ul>
                <li><input type="text" name="fname" placeholder="  First Name" required></li>
                <li><input type="text" name="lname" placeholder="  Last Name" required></li>
                <input class="date " type="date" name="date" placeholder="  Date of Birth" required></li>
                <li><input type="text" name="username" placeholder="  Username" required></li>
                <li><input type="password" name="password" id="pass" placeholder="  Password" onblur="verifypass()"
                        required></li>
                <li><input type="password" name="passwrd" id="cpass" placeholder=" Confirm Password"
                        onblur="checkpass()" required></li>
                <li class="radio">
                    <span class="p">Student</span>
                    <input type="radio" name="role" value="2" required>
                    <span class="p">Male</span>
                    <input type="radio" name="gender" value="male" required>


                </li>
                <li class="radio">
                <span class="p">Teacher</span>
                    <input type="radio" name="role" value="1" required> 
                    
                    <span class="p">Female</span>
                    <input type="radio" name="gender" value="female" required>
                </li>
                <li><button id='button' onclick="checkpass()verifypass()">Signup</button></li>
                <li><a href="login.php">Already have an account? Signin now!</a></li>
            </ul>
        </form>

        <script>

            //check confirm password

            function checkpass() {
                let pass = document.getElementById("pass").value
                let cpass = document.getElementById("cpass").value
                let msg = document.getElementById("error")
                if (pass != cpass) {
                    msg.innerHTML = "Password don't match!"
                    return false
                }
                else {
                    msg.innerHTML = ""
                    return true
                }

            }
            //verify password pattern
            function verifypass() {
                let pass = document.getElementById("pass").value
                let pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/
                let msg = document.getElementById("error")
                msg.innerHTML = ""
                if (pass.match(pattern)) {
                    msg.innerHTML = ""
                    return true
                }
                else {
                    msg.innerHTML = "Password should be: (8+)character , 1+ (A),1+(a),1+(@), 1+(1)"
                    return false
                }
            }
             
            if(!verifypass()||!checkpass()){
                document.getElementById("button").disabled=true;
            }
            else
            document.getElementById("button").disabled=false;
        </script>

    </section>
</body>

</html>