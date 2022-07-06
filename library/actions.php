<?php

    include("functions.php");
    
    if (isset($_GET['action']) && $_GET['action'] == "signup") {
        $error = "";
        if (!$_POST['email']) {
            $error = "An email address is required.";
        } else if (!$_POST['password']) {
            $error = "A password is required";
        }else if (!$_POST['firstname']) {
            $error = "firstname is required";
        }else if (!$_POST['lastname']) {
            $error = "lastname is required";
        }
        else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $error = "Please enter a valid email address.";
        }
        if ($error != "") {
            header("Location: index.php?page=signup"); 
            exit();  
        }
        
        $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) $error = "That email address is already taken.";
        else {
            $query = "INSERT INTO users (`fname`, `lname`, `email`, `password`, `isadmin`) VALUES ('". mysqli_real_escape_string($link, $_POST['firstname'])."', '". mysqli_real_escape_string($link, $_POST['lastname'])."', '". mysqli_real_escape_string($link, $_POST['email'])."', '". mysqli_real_escape_string($link, $_POST['password'])."', 0)";
            if (mysqli_query($link, $query)) {
                $_SESSION['id'] = mysqli_insert_id($link);
                $query = "UPDATE users SET password = '". md5(md5($_SESSION['id']).$_POST['password']) ."' WHERE id = ".$_SESSION['id']." LIMIT 1";
                mysqli_query($link, $query);
            } else {
                $error = "Couldn't create user - please try again later";
            }
        }
        if ($error != "") {
            header("Location: index.php?page=signup");
        }else{
            header("Location: index.php?page=client");
        }
    }
    
    else if (isset($_GET['action']) && $_GET['action'] == "signin") {
        $error = "";
        if (!$_POST['email']) {
            $error = "An email address is required.";
        } else if (!$_POST['password']) {
            $error = "A password is required";
        }else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $error = "Please enter a valid email address.";
        }
        if ($error != "") {
            header("Location: index.php?page=signin"); 
            exit();  
        }
        
        $query = "SELECT * FROM users WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == md5(md5($row['id']).$_POST['password'])) {
            $_SESSION['id'] = $row['id'];
        } else {
            $error = "Could not find that email/password combination. Please try again.";
        }
        if ($error != "") {
            header("Location: index.php?page=signin");
        }else{
            header("Location: index.php?page=client");
        }
    }
    
    else if (isset($_GET['action']) && $_GET['action'] == "logout") {
        session_unset();
        header("Location: index.php?page=signin");
    }
    
    else if (isset($_GET['action']) && $_GET['action'] == "addbook") {
        $id = $_POST['id'];
        if ($id == "0"){
            $q = "INSERT INTO books (`name`, `author`, `publisher`, `type`, `description`, `image1`,`code`, `cost`, `stock`) VALUES (";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['name'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['author'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['publisher'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['type'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['description'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['image1'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['code'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['cost'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['stock'])."')";
            mysqli_query($link, $q);
            header("Location: index.php?page=admin");
        }
        else{
            $q = "UPDATE books SET ";
            $q = $q."name='".mysqli_real_escape_string($link, $_POST['name'])."', ";
            $q = $q."author='".mysqli_real_escape_string($link, $_POST['author'])."', ";
            $q = $q."publisher='".mysqli_real_escape_string($link, $_POST['publisher'])."', ";
            $q = $q."type='".mysqli_real_escape_string($link, $_POST['type'])."', ";
            $q = $q."description='".mysqli_real_escape_string($link, $_POST['description'])."', ";
            $q = $q."image1='".mysqli_real_escape_string($link, $_POST['image1'])."', ";
            $q = $q."code='".mysqli_real_escape_string($link, $_POST['code'])."', ";
            $q = $q."cost='".mysqli_real_escape_string($link, $_POST['cost'])."', ";
            $q = $q."stock='".mysqli_real_escape_string($link, $_POST['stock'])."' WHERE id=".mysqli_real_escape_string($link, $_POST['id']);
            mysqli_query($link, $q);
        }
        header("Location: index.php?page=admin");
    }
    else if (isset($_GET['action']) && $_GET['action'] == "removebook") {
        $query = "DELETE FROM books WHERE id='".mysqli_real_escape_string($link, $_POST['rid'])."'";
        mysqli_query($link, $query);
        header("Location: index.php?page=admin");
    
    }
    else if (isset($_GET['action']) && $_GET['action'] == "addcomment") {
            $q = "INSERT INTO comments (`bookid`, `userid`, `text`,`datetime`) VALUES (";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['pk'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['user'])."', ";
            $q = $q."'".mysqli_real_escape_string($link, $_POST['comment'])."', ";
            $q = $q."current_timestamp())";
            mysqli_query($link, $q);
            header("Location: index.php?page=bookClient&pk=".$_POST['pk']);
    }
    else if (isset($_GET['action']) && $_GET['action'] == "add_deposit") {
        $q = "INSERT INTO deposits (`bookid`, `userid`, `duration`,`start_date`) VALUES (";
        $q = $q."'".mysqli_real_escape_string($link, $_POST['pk'])."', ";
        $q = $q."'".mysqli_real_escape_string($link, $_POST['user'])."', ";
        $q = $q."'".mysqli_real_escape_string($link, $_POST['day'])."', ";
        $q = $q."current_timestamp())";
        mysqli_query($link, $q);
        header("Location: index.php?page=bookClient&pk=".$_POST['pk']);
    }
    else if (isset($_GET['action']) && $_GET['action'] == "add_fav") {
        $q = "INSERT INTO favorites (`bookid`, `userid`) VALUES (";
        $q = $q."'".mysqli_real_escape_string($link, $_POST['pk'])."', ";
        $q = $q."'".mysqli_real_escape_string($link, $_POST['user'])."') ";
        mysqli_query($link, $q);
        header("Location: index.php?page=client&pk=".$_POST['pk']);
    }
    else if (isset($_GET['action']) && $_GET['action'] == "del_fav") {
        $q = "DELETE FROM favorites WHERE bookid='".mysqli_real_escape_string($link, $_POST['pk'])."' AND userid='".mysqli_real_escape_string($link, $_POST['user'])."'";
        mysqli_query($link, $q);
        header("Location: index.php?page=favClient");
    }
    
?>