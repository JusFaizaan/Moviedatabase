<?php

include 'header.php'; 



$user= $_SESSION["ID"]; 


$sql = "SELECT * FROM users WHERE ID = '.'$user'.';";
$stmt = $conn->prepare($sql);

$id = $user;  //UserID
$new_film_to_wishlist = $_GET['movieid'];  //Movie_ID
$stmt->bind_param("i", $id);

$stmt->execute();
$result = $stmt->get_result();


if($result->num_rows > 0){
    $new_wishlist = array();
    while ($row = $result->fetch_assoc()) {

        $current_wishlist = json_decode($row['Wishlist']);

        if(is_null($current_wishlist)){

            echo "No Wishlist";
            array_push($new_wishlist, $new_film_to_wishlist);
        }else{
            for($i = 0; $i < count($current_wishlist); $i++){
                array_push($new_wishlist, $current_wishlist[$i]);

            }
            array_push($new_wishlist, $new_film_to_wishlist);

        }
    }

}else{
  echo "Sorry! We couldn't find any films of that genre";
}

$sql = "UPDATE users SET Wishlist = ? WHERE ID = ?;";
$stmt = $conn->prepare($sql);

$new_wishlist = json_encode($new_wishlist);
echo($new_wishlist);

$stmt->bind_param("si", $new_wishlist, $id);

if($stmt->execute()){
    echo "Wishlist Added";
}else{
    echo "Error Adding Wishlist";
}


?>