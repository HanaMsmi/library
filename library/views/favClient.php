<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آی بوک</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    
    <?php include("views/header.php") ?>

    <div class="main">

        <div class="books borrow__holder">
            <h3 class="books__header">لیست علاقه مندی</h3>
            <div class="books__holder">
                
                <?php
                    $query = "SELECT * FROM books WHERE id IN (SELECT bookid FROM favorites WHERE userid=".$_SESSION['id'].")";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
            
                <div class="card">
                    <img src="<?php echo $row['image1']?>" class="card__img">
                    <h3 class="card__header"><?php echo $row['name']?></h3>
                    <p class="card__p">ناشر :</p>
                    <p class="card__p"><?php echo $row['publisher']?></p>
                    <br>
                    <p class="card__p">نوع کتاب :</p>
                    <p class="card__p"><?php echo $row['type']?></p>
                    <br>
                    <p class="card__p">نویسنده :</p>
                    <p class="card__p"><?php echo $row['author']?></p>
                    <br>
                    <p class="card__p">کد :</p>
                    <p class="card__p"><?php echo $row['code']?></p>
                    <br>
                    <div class="btn__holder">
                        <form action="actions.php?action=del_fav" method="post">
                            <input name="pk" value="<?php echo $row['id'] ?>" type="text" class="opnion__inp" style="display:none;">
                            <input name="user" value="<?php echo $_SESSION['id'] ?>" type="text" class="opnion__inp" style="display:none;">
                            <button type="submit" class="btn admin__btn btn__holder__brw" id="btn-remove">حذف</button>
                        </form>
                    </div>
                </div>
                
                <?php } ?>

            </div>

        </div>
    </div>

    <script src="js/fav.js"></script>
</body>

</html>