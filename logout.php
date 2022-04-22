<?php

include "header.php";

if (!isset($_SESSION['loggedIn']))
{
    // user isn't logged in, display a message saying they must be:
    echo "<p><b>You must be logged in to view this page.</b></p>";
}
else
{
    // user just clicked to logout, so destroy the session data:
    // first clear the session superglobal array:
    $_SESSION = array();
    // then the cookie that holds the session ID:
    setcookie(session_name(), "", time() - 2592000, '/');
    // then the session data on the server:
    session_destroy();

    header("location: index.php");
}


include "footer.php";

?>