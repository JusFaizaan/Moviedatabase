<?php
ob_start();

//add php to include header
include 'header.php';

$sign_up['username'] = $sign_up['password'] =  $sign_up['Firstname'] = $sign_up['Lastname'] =  "";
$username_errors= "";
$password_errors= "";
$fn_errors= "";
$ln_errors= "";





echo "<h3> <b> Sign Up </b> </h3>";

if (isset($_SESSION['loggedIn']))
{
    header("location: index.php");

}

if (isset($_POST['username']))
{
    // connect directly to the database:
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // if the connection fails, allow this exit:
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }
    
    // user just tried to sign up, try and insert these new details:

    // take copies of the credentials the user submitted:
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['Firstname'];
    $last_name = $_POST['Lastname'];
 
    //sanitisation
    $username = sanitise($username, $connection);
    $password = sanitise($password, $connection);
    $first_name = sanitise($first_name, $connection);
    $last_name = sanitise($last_name, $connection);


    $username_errors= validateString($username,1 ,64);
    $password_errors= validateString($password,1 ,64);
    $fn_errors= validateString($first_name,1 ,100);
    $ln_errors= validateString($last_name,1 ,100);

    $errors= $username_errors . $password_errors . $fn_errors . $ln_errors; 
 
    if($errors == ""){


    // try to insert the new details:
    $query = "INSERT INTO users (username, password, firstname, lastname) 
    values ('$username', '$password', '$first_name', '$last_name')";
    
    $result = mysqli_query($connection, $query);

    // test for true(success)/false(failure):
    if ($result)
    {
        header("location: login.php");
    }
    else
    {
        // show an unsuccessful signup message:
        echo "<p><b>Sign up failed, please try again</b></p>";
    }

}
else { 

    echo "<br>validation</br>";
}
   
   
    
   

        // the following ifs means any erroneous entries show up so they can be amended when SS validation occurs
        if (isset($_POST["username"])) {
            $sign_up['username']=$_POST["username"];
        }

        if (isset($_POST["password"])) {
            $sign_up['password']=$_POST["password"];
        }
        if (isset($_POST["Firstname"])) {
            $sign_up['Firstname']=$_POST["Firstname"];
        }
        if (isset($_POST["Lastname"])) {
            $sign_up['Lastname']=$_POST["Lastname"];
        }

        // finished with the database, close the connection:



        mysqli_close($connection);
}




    echo <<<_END
<form action="signup.php" method="post">
  Username: <input type="text" name="username"  minlength="1" maxlength="64" value= "{$sign_up['username']}" required> <b> $username_errors</b>
  <br>
  Password: <input type="text" name="password"  minlength="1" maxlength="64"  id="password"" value= "{$sign_up['password']}" required> <b> $password_errors</b>
  <br>
  Firstname: <input type="text" name="Firstname"  minlength="1" maxlength="100"  value= "{$sign_up['Firstname']}" required> <b> $fn_errors</b>
  <br>
  Lastname: <input type="text" name="Lastname"  minlength="1" maxlength="100"  value= "{$sign_up['Lastname']}" required> <b> $ln_errors</b>
  <br>
  <br><input type="submit" value="Submit">
</form>	
_END;

include 'footer.php';
?>