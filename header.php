<?php
// until we make one:
// require_once "credentials.php";

// start/restart the session
session_start();


require_once "credentials.php";
include 'helper.php';

echo <<<_END

<!DOCTYPE html>
<html lang="en-GB" dir="ltr">

<head>
<link rel="stylesheet" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css" integrity="sha384-zEpdAL7W11eTKeoBJK1g79kgl9qjP7g84KfK3AZsuonx38n8ad+f5ZgXtoSDxPOh" crossorigin="anonymous">
    <meta charset="utf-8">

    <title>Taskit</title>
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <meta name="description" content="movie database is an online database of information related to films, television series,
    home video games, and streaming content online
   including cast , production crew.">



</head>

<body>
  
    <header>
       
        <img> <!-- design a logo and interst here -->
        <h1></h1> <!-- get a title and interst here-->
_END;
if (isset($_SESSION['loggedIn'])){
    if (isset($_SESSION['admin'])){
        // THIS PERSON IS LOGGED IN
       // show the logged in menu options:
    echo <<<_END
    <nav aria-label="main menu" id="nav">
       <ul>
           <li><a href="index.php"> Home </a> </li>
           <li><a href="admin.php">Admin</a> </li>
           <li><a href="user.php">My Watchlist</a> </li>
           <li><a href="logout.php"> Log Out</a> </li>
       </ul>
    </nav>
    _END;
    }else{
            // THIS PERSON IS LOGGED IN
           // show the logged in menu options:
echo <<<_END
        <nav aria-label="main menu" id="nav">
           <ul>
               <li><a href="index.php"> Home </a> </li>
               <li><a href="user.php">My Watchlist</a> </li>
               <li><a href="logout.php"> Log Out</a> </li>
           </ul>
       </nav>
_END;
    }
}
else{
echo <<<_END

        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Movies</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.php">Sign Up</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>



_END;
}
echo <<<_END
    </header>
    <main>
_END;

//make an html head viewport, inlude viewport, stylesheets and a description
//header, inlude logo, title, nav
//in the nave, pages should include for now:
// home: index to see all movies
// film specific page (when clicked)
// sign in page
// only home page should be live for now...
?>