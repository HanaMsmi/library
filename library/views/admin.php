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
            <h3 class="books__header">مدیریت</h3>
            <div class="books__holder admin__books__holder">
                <!-- <div class="books__holder admin__books__holder"> -->
                <?php
                    $query = "SELECT * FROM books";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <img id="<?php echo "card_image1_".$row["id"]?>" src="<?php echo $row["image1"] ?>" class="card__img">
                    <h3 id="<?php echo "card_name_".$row["id"]?>" class="card__header"><?php echo $row["name"] ?></h3>
                    <p class="card__p">ناشر :</p>
                    <p id="<?php echo "card_publisher_".$row["id"]?>" class="card__p"><?php echo $row["publisher"] ?></p>
                    <br>
                    <p class="card__p">نوع کتاب :</p>
                    <p id="<?php echo "card_type_".$row["id"]?>" class="card__p"><?php echo $row["type"] ?></p>
                    <br>
                    <p class="card__p">نویسنده :</p>
                    <p id="<?php echo "card_author_".$row["id"]?>" class="card__p"><?php echo $row["author"] ?></p>
                    <br>
                    <p class="card__p">کد :</p>
                    <p id="<?php echo "card_code_".$row["id"]?>" class="card__p"><?php echo $row["code"] ?></p>
                    <br>
                    
                    <!-- none show -->
                    <p id="<?php echo "card_stock_".$row["id"]?>" class="card__p" style="display:none;"><?php echo $row["stock"] ?></p>
                    <p id="<?php echo "card_cost_".$row["id"]?>" class="card__p" style="display:none;"><?php echo $row["cost"] ?></p>
                    <p id="<?php echo "card_description_".$row["id"]?>" class="card__p" style="display:none;"><?php echo $row["description"] ?></p>
                    <!-- none show -->
                    
                    <!-- admin buttons -->
                    <div class="btn__holder">
                        <button class="btn admin__btn " onclick="edit(<?php echo $row['id'] ?>)">ویرایش</button>
                        <form action="actions.php?action=removebook" method="post">
                            <input value="<?php echo $row['id']?>" name="rid" id="rid" type="text" class="info_inp" style="display:none;">
                            <button type="submit" class="btn admin__btn">حذف</button>
                        </form>
                    </div>

                </div>
                
                <?php } ?>

                <button class="btn admin__btn__add header__logOut" onclick="add()">اضافه کردن</button>
            </div>


            <div class="" id="info">
                <div class="bluring"></div>
                <div class="admin__info__holder">
                    <div class="infooo__holder">
                        <form action="actions.php?action=addbook" method="post">
                            <p class="info_text" style="display:none;"></p>
                            <input name="id" id="info_id" type="text" class="info_inp" style="display:none;">
                            <p class="info_text">عنوان کتاب :</p>
                            <input id="info_name" name="name" type="text" class="info_inp">
                            <p class="info_text">نوع کتاب :</p>
                            <input id="info_type" name="type" type="text" class="info_inp">
                            <p class="info_text">ناشر :</p>
                            <input id="info_publisher" name="publisher" type="text" class="info_inp">
                            <p class="info_text">نویسنده :</p>
                            <input id="info_author" name="author" type="text" class="info_inp">
                            <p class="info_text">کد :</p>
                            <input id="info_code" name="code" type="text" class="info_inp">
                            <p class="info_text">تعداد موجود در انبار :</p>
                            <input id="info_stock" name="stock" type="text" class="info_inp">
                            <p class="info_text">بهای هر روز اجاره :</p>
                            <input id="info_cost" name="cost" type="text" class="info_inp">
                            <p class="info_text">توضیحات :</p>
                            <input id="info_description" name="description" type="text" class="info_inp">
                            <p class="info_text">عکس :</p>
                            <input id="info_image1" name="image1" type="text" class="info_inp">
                            <!-- <input id="info_image1" name="image" type="file" multiple> -->
                            <button type="submit" class="btn admin__btn__add header__logOut" id="add-info">اضافه کردن</button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="js/admin.js"></script>
</body>

</html>