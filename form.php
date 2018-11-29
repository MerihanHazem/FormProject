<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Project</title>

    <style>
        *{
            margin: 0px;
            padding: 0px;
            outline: none;
        }
        .formBorder{
            margin: auto;
            border:solid;
            border-color: blue;
            border-radius: 6px;
            width: 410px;
            height: 410px;
            margin-top: 50px;
        }
        .formInput{
            margin-top: 10px;
            text-align: center;
        }
        .formInput b{
            font-family: "Times New Roman", Times, serif;
            font-size: 2em;
            color: blue;
        }
        .formInput form{
            text-align: left;
            margin-left: 10px;
            margin-top: 20px;
        }
        .formInput form p{
            padding: 8px;
            margin-left: -7px;
            font-family: "Times New Roman", Times, serif;
            color: blue;
        }
        form input{
            border: solid;
            border-radius: 4px;
            border-color: limegreen;
        }
        .button{
            margin: auto;
            text-align: center;
        }
        .button .submit{
            cursor: pointer;
            font-family: "Times New Roman", Times, serif;
            font-size: 1em;
            color: red;
            width: 70px;
            border-radius: 6px;
            border:solid;
            border-color: yellow;
            background-color: yellow;
        }
        .error{
            color: red;
            margin-left: 20px;
        }
        .SuccessfulRecord{
            margin: auto;
            margin-top: 5px;
            border-color: lime;
            background-color: lime;
            width: 210.5px;
        }
        .RightRecord{
            margin: auto;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 1em;

        }
        .ErrorRecord{
            margin-top: 10px;
        }
        .WrongRecord{
            font-family: "Times New Roman", Times, serif;
            font-size: 1em;
            color: red;

        }
        @media only screen and (max-width: 1500px) {
            *{
                margin: 0px;
                padding: 0px;
            }
            form input{
                border-color: yellow;
            }
            .button{
                text-align: left;
            }
            .ErrorRecord{
                margin-top: 5px;
                text-align: center;
            }
        }
        @media only screen and (max-width: 1000px) {
            *{
                margin: 0px;
                padding: 0px;
            }
            form input{
                border-color: red;
            }
            .button{
                text-align: center;
            }
        }
    </style>
</head>

<?php

$name_error = $surname_error = $email_error = $phone_error = $password_error = "";
$name = $surname = $email = $phonenumber = $Password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["name"])){
        $name_error = "*Name is required*";
    }
    else {
        $name = $_POST["name"];
        if (!preg_match("/^[a-zA-Z ]*$/",$name)){
            $name_error = "*Only Letters are required*";
        }
    }

    if (empty($_POST["surname"])){
        $surname_error = "*Surname is required*";
    }
    else {
        $surname = $_POST["surname"];
        if (!preg_match("/^[a-zA-Z ]*$/",$surname)){
            $surname_error = "*Only Letters are required*";
        }
    }

    if (empty($_POST["Email"])){
        $email_error = "*Email is required*";
    }
    else {
        $email = $_POST["Email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_error = "*Invalid email*";
        }
    }

    if (empty($_POST["phoneNumber"])){
        $phone_error = "*Phone Number is required*";
    }
    else {
        $phonenumber = $_POST["phoneNumber"];
        if (!preg_match("/^[1-9][0-9]{0,8}$/",$phonenumber)){
            $phone_error = "*Only Numbers are required*";
        }
    }

    if (empty($_POST["password"])){
        $password_error = "*Password is required*";
    }
    else {
        $Password = $_POST["password"];
    }
}

$servername = "localhost";
$username = "root";
$password = "MerihanHazem#1997";

$connection = mysqli_connect($servername, $username, $password);
if (!$connection){
    die("Connection Failed" .mysqli_connect_error());
}

if (!empty($name && $surname && $email && $phonenumber && $Password) &&
    !$name_error && !$surname_error && !$email_error && !$phone_error && !$password_error){

    $sql = "INSERT INTO sys.form_project (Name, Surname, Email, PhoneNumber, Password)
    VALUES ('$name', '$surname', '$email', '$phonenumber', sha1('$Password'))";
    if (mysqli_query($connection, $sql)){
        $SuccessfulRecord = "New record Successfully created";
    }
    else{
        $ErrorRecord = "Error creating record" . " " . $sql . "<br>" . mysqli_error($connection);
    }
}

mysqli_close($connection);

?>

<body>
<div class="formBorder">
    <div class="formInput">
    <b>Registration</b>
        <form method="post" action="">
                <p>Name:</p><input type="text" name="name"><span class="error"><?php echo $name_error; ?></span>
                <p>Surname:</p><input type="text" name="surname"><span class="error"><?php echo $surname_error; ?></span>
                <p>E-mail:</p><input type="text" name="Email"><span class="error"><?php echo $email_error; ?></span>
                <p>Phone number:</p><input type="text" name="phoneNumber"><span class="error"><?php echo $phone_error; ?></span>
                <p>Password:</p><input type="password" name="password"><span class="error"><?php echo $password_error; ?></span>
            <br><br>
            <div class="button"><input class="submit" type="submit" name="Submit"></div>
        </form>
    </div>
    <div class="SuccessfulRecord"><span class="RightRecord"><?php echo $SuccessfulRecord; ?></span></div>
</div>
<div class="ErrorRecord"><span class="WrongRecord"><?php echo $ErrorRecord; ?></span></div>


</body>
</html>

