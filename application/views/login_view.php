<?php


?>

<style>
    /* Bordered form */

    /* Add a hover effect for buttons */
    button:hover {
        opacity: 0.8;
    }

    /* Extra style for the cancel button (red) */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the avatar image inside this container */
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    /* Avatar image */
    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    /* The "Forgot password" text */
    span.psw {
        padding-top: 20px;
        padding-bottom: 30px;
    }

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }

        .cancelbtn {
            width: 100%;
        }
    }

</style>

<div style="margin: auto; width:35%;text-align: center;">
    <form action="http://theberry.us/clientes/drops/lms/login/index.php?authldap_skipntlmsso=1" method="post">
        <div class="imgcontainer">
            <img src="http://theberry.us/clientes/drops/assets/img/img_avatar2.png" alt="Avatar" class="avatar">
        </div>

        <div class="container" style="text-align: center;">
            <!--<label><b>Username</b></label>-->
            <input type="text" placeholder="Enter Username" name="username" required style="width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;">

            <!--<label><b>Password</b></label>-->
            <input type="password" placeholder="Enter Password" name="password" required style="width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;">

            <button type="submit" style=" background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;">Login
            </button>


        </div>

        <div class="container" style="margin: auto;text-align: center;">
            <span class="psw">Forgot <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/lms/login/forgot_password.php" target="_blank">password?</a></span>
        </div>
        <div class="container" style="margin: auto;text-align: center;">
            <span class="psw">Don't have an account? Click <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/clientes/drops/index.php/register/register/">here</a></span>
        </div><br>
     </form>
</div>