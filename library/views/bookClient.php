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

    <div class="book-holder">
        
        <?php
            $query = "SELECT * FROM books WHERE id=".$_GET['pk'];
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
            
            $dep_query = "SELECT COUNT(*) AS cnt FROM deposits WHERE bookid=".$_GET['pk']." AND DATE_ADD(start_date, interval duration day) > current_timestamp()";
            $dep_result = mysqli_query($link, $dep_query);
            $drow = mysqli_fetch_assoc($dep_result);
            
        ?>
    
        <div class="book-holder__imager">
            <img src="img/1.jpg" alt="" class="book-holder__img">

        </div>
        
        <div class="book-holder__info">
            <h2 class="book-holder__info__header"><?php echo $row['name'] ?></h2>
            <p class="book-holder__info__p">ناشر :</p>
            <p class="book-holder__info__p"><?php echo $row['publisher'] ?></p>
            <br>
            <p class="book-holder__info__p">نوع کتاب :</p>
            <p class="book-holder__info__p"><?php echo $row['type'] ?></p>
            <br>
            <p class="book-holder__info__p">نویسنده :</p>
            <p class="book-holder__info__p"><?php echo $row['author'] ?></p>
            <br>
            <p class="book-holder__info__p">کد :</p>
            <p class="book-holder__info__p"><?php echo $row['code'] ?></p>
            <br>
            <p class="book-holder__info__p">تعداد موجود در انبار :</p>
            <p class="book-holder__info__p"><?php echo $row['stock'] - $drow['cnt'] ?></p>
            <br>
            <p class="book-holder__info__p">توضیحات :</p>
            <p class="book-holder__info__p"><?php echo $row['description'] ?></p>
            <br>
        </div>
        <br>
        <?php
            
            if ($row['stock'] - $drow['cnt'] > 0){
                
        ?>
        <div class="book-holder__price">
            <p class="book-holder__info__p">بهای هر روز اجاره :</p>
            <p class="book-holder__info__p" id="price"><?php echo $row['cost'] ?></p>
            <p class="book-holder__info__p">هزار تومان</p>
            <br>
            <p class="book-holder__info__p">تعداد روز ها ی اجاره :</p>
            <p class="book-holder__info__p" id="day">5</p>
            <br>
            <input type="range" class="book-holder__price__range" min="1" max="10" value="1" id="dayRange">
            <br>
            <p class="book-holder__info__p">هزینه ی اجاره :</p>
            <p class="book-holder__info__p" id="cost">56</p>
            <form action="actions.php?action=add_deposit" method="post">
                <input id="form_day" name="day" value="1" type="text" class="opnion__inp" style="display:none;">
                <input name="pk" value="<?php echo $_GET['pk'] ?>" type="text" class="opnion__inp" style="display:none;">
                <input name="user" value="<?php echo $_SESSION['id'] ?>" type="text" class="opnion__inp" style="display:none;">
                <button type="submit" class="btn book-holder__price__btn">اجاره و پرداخت</button>
            </form>
        </div>
        <?php } ?>
        <div class="opnion">
            <p class="book-holder__info__p">نظرات :</p>
            
            <?php
                $query = "SELECT * , users.fname AS fname FROM comments INNER JOIN users ON comments.userid=users.id WHERE bookid=".$_GET['pk']." ORDER BY datetime DESC";
                $result = mysqli_query($link, $query);
                while ($brow = mysqli_fetch_assoc($result)) {
            ?>
            
            <div class="opnion--1">
                <p class="book-holder__info__p">نام کاربر : <?php echo $brow['fname']?></p>
                <br>
                <p class="book-holder__info__p"><?php echo $brow['text']?></p>
            </div>
            
            <?php } ?>
            <form action="actions.php?action=addcomment" method="post">
                <input name="pk" value="<?php echo $_GET['pk'] ?>" type="text" class="opnion__inp" style="display:none;">
                <input name="user" value="<?php echo $_SESSION['id'] ?>" type="text" class="opnion__inp" style="display:none;">
                <input name="comment" type="text" maxlength="500" class="opnion__inp" placeholder="نظر خود را بنویسید">
                <button type="submit" class="btn opnion__btn">ثبت نظر</button>
            </form>
        </div>
    </div>


    <script src="js/book.js"></script>
</body>

</html>