<?php

    include("functions.php");
    
    $isadmin = false;
    
    if (isset($_SESSION['id'])){
        $query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' AND isadmin=1 LIMIT 1";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) { 
            $isadmin = true;
        }
    }
    
    if (!isset($_GET['page'])) {
        include("views/welcome.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'signin'){
        include("views/signin.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'signup'){
        include("views/signup.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'client' && isset($_SESSION['id'])){
        include("views/client.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'admin' && $isadmin){
        include("views/admin.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'admindep' && $isadmin){
        include("views/adminBorrow.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'dep' && isset($_SESSION['id'])){
        include("views/borrowClient.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'bookClient' && isset($_SESSION['id'])){
        include("views/bookClient.php");
    }
    else if (isset($_GET['page']) && $_GET['page'] == 'favClient' && isset($_SESSION['id'])){
        include("views/favClient.php");
    }
    else{
        include("views/welcome.php");
    } 
    
    // include("views/footer.php");
?>