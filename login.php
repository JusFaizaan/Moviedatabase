<?php
///check if working, if not take from v_11

//add php to include header
include 'header.php';

$login['password'] = "";
$login['username'] = "";
$username_errors= "";
$password_errors= "";

echo "<h3> <b> Login </b> </h3>";


if (isset($_SESSION['loggedIn']))
{

    header("location: index.php");

}
elseif (isset($_POST['username']))
{
    // user has just tried to log in

    // connect directly to our database (notice 4th argument):
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // if the connection fails, we need to know, so allow this exit:
    if (!$connection)
    {
        die("Connection failed: " . $mysqli_connect_error);
    }



    // take copies of the credentials the user submitted:
    $username = $_POST['username'];
    $password = $_POST['password'];


   
    if ($_POST["username"] != null && $_POST["password"] != null){
        
        // check for a row in our users table with a matching username and password:
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

         // this query can return data ($result is an identifier):
         $result = mysqli_query($connection, $query);

         // how many rows came back? (can only be 1 or 0 because usernames are the primary key in our table):
         $n = mysqli_num_rows($result);
        
            if($n > 0){

            $row = mysqli_fetch_assoc($result);

            // set a session variable to record that this user has successfully logged in:
            $_SESSION['loggedIn'] = true;

            
            //if admin logs in,  session admin make this for better sessions
            if($row["ID"] === '1'){
            $_SESSION['admin'] = true;
            }

            // and copy their username and userid into the session data for use by our other scripts:
            $_SESSION['username'] = $username;
            
            ///save userid here as a session for later...
            $_SESSION['ID'] = $row["ID"];

            header("location: index.php");
            
            }
            else{

           // show an unsuccessful signin message:
           echo "<p> <b> Login details not found </b></p>";  
           }
    }
    else{
    // Extra protection, if nothing was entered:
    echo "<p> <b> Please Enter Details! </b></p>"; 
    }


//to put into this form if user makes mistake
if (isset($_POST["password"])) {
    $login['password']=$_POST["password"];
}
if(isset($_POST["username"])){
    $login['username']=$_POST["username"];
}
 // we're finished with the database, close the connection:
 mysqli_close($connection);
}




// show the form that allows users to log in
// Note we use an HTTP POST request to avoid their password appearing in the URL:

echo <<<_END
<form action= "login.php" method="post">
<label for="username">Username: </label>
<input type="text" id="username" name="username" minlength="1" maxlength="32" value="{$login['username']}" required> <b> $username_errors</b> <br> 
<label for="password">Password: </label>
<input type="password" id="password" name="password" minlength="3" maxlength="64" value="{$login['password']}" required> <b> $password_errors</b> 
<button type="button" class="btn btn-outline-dark btn-sm" onclick="showPassword()"> Show Password</button> <br>
<input type="submit" value="Login">
</form>
_END;


include 'footer.php';
?>