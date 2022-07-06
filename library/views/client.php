<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>آی بوک</title>
    <link rel="stylesheet" href="css/main.css">
    
    <script>
        function applyfilter(){
            
            console.log(filters);
            author = [];
            type = [];
            publisher = [];
            
            for (let i=0; i < filters.length; i++){
                f = filters[i];
                f = f.split("=");
                if (f[0] == "type"){
                    type.push(f[1]); 
                }
                else if (f[0] == "author"){
                    author.push(f[1]); 
                }
                else if (f[0] == "publisher"){
                    publisher.push(f[1]); 
                }  
            }
            str = "type="+type.join(",")+"&author="+author.join(",")+"&publisher="+publisher.join(",");
            location.replace("index.php?page=client&"+str);
            
        }
    </script>
    
</head>

<body>
    <?php include("views/header.php") ?>
    
    <?php
        $query_type = "SELECT DISTINCT type from books";
        $result_type = mysqli_query($link, $query_type);
        
        $query_author = "SELECT DISTINCT author from books";
        $result_author = mysqli_query($link, $query_author);
        
        $query_publisher = "SELECT DISTINCT publisher from books";
        $result_publisher = mysqli_query($link, $query_publisher);
    ?>
    
    <div class="main">

        <div class="filter">
            <p class="filter__p">فیلترها</p>
            <ul class="filter__menu">
                <li class="filter__menu__item">نوع کتاب
                    <span class="filter__menu__item__arrow" id="kind">&gt;</span>
                    <!-- sub filter -->
                    <div class="filter__menu__item__sub">
                        <ul class="filter__menu__item__sub__menu">
                            
                            <?php 
                                $c = 0;
                                while ($row = mysqli_fetch_assoc($result_type)) { 
                                    $c += 1;
                            ?>
                                
                            <li class="filter__menu__item__sub__menu__item">
                                <p id="<?php echo 'filter_name_type_'.$c?>"> <?php echo $row["type"] ?> </p>

                                <input name="type" type="checkbox" id="<?php echo 'checkbox_type_'.$c?>" class="checkbox checkbox_filter">
                                <label class="checkbox__label" for="<?php echo 'checkbox_type_'.$c?>">
                                <div class="tick_mark"></div>
                                </label>
                            </li>
                            
                            <?php } ?>
                    
                        </ul>
                    </div>
                </li>
                
                
                <li class="filter__menu__item">نویسنده
                    <span class="filter__menu__item__arrow" id="writer">&gt;</span>
                    <!-- sub filter -->

                    <div class="filter__menu__item__sub">
                        <ul class="filter__menu__item__sub__menu">
                            
                            <?php 
                                $c = 0;
                                while ($row = mysqli_fetch_assoc($result_author)) { 
                                    $c += 1;
                            ?>
                                
                            <li class="filter__menu__item__sub__menu__item">
                                <p id="<?php echo 'filter_name_author_'.$c?>"> <?php echo $row["author"] ?> </p>
                                
                                <input name="author" type="checkbox" id="<?php echo 'checkbox_author_'.$c?>" class="checkbox checkbox_filter">
                                <label class="checkbox__label" for="<?php echo 'checkbox_author_'.$c?>">
                                <div class="tick_mark"></div>
                                </label>
                            </li>
                            <?php }?>
                        </ul>
                    </div>

                </li>
                
                
                <li class="filter__menu__item">ناشر
                    <span class="filter__menu__item__arrow" id="company">&gt;</span>
                    <!-- sub filter -->

                    <div class="filter__menu__item__sub">
                        <ul class="filter__menu__item__sub__menu">
                            
                            <?php 
                            $c = 0;
                            while ($row = mysqli_fetch_assoc($result_publisher)) { 
                                $c += 1;
                            ?>
                            
                            <li class="filter__menu__item__sub__menu__item">
                                <p id="<?php echo 'filter_name_publisher_'.$c?>"> <?php echo $row["publisher"] ?> </p>
                                <input name="publisher" type="checkbox" id="<?php echo 'checkbox_publisher_'.$c?>" class="checkbox checkbox_filter">
                                <label class="checkbox__label" for="<?php echo 'checkbox_publisher_'.$c?>">
                                <div class="tick_mark"></div>
                                </label>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </ul>
            <button type="submit" onclick="applyfilter()" class="btn filter__btn">اعمال فیلترها</button>
            
        </div>

        <div class="books">
            <h3 class="books__header">کتاب خانه</h3>
            <!-- <div class="alert__holder"> -->
            <!-- </div> -->
            <div class="books__holder">
                <?php 
                function myfunc($e){
                    global $link;
                    return mysqli_real_escape_string($link, $e);
                }
                $query = "SELECT * FROM books WHERE 1 ";
                    if (isset($_GET['type']) && $_GET["type"]){
                        $types = explode("," , $_GET["type"]);
                        $types = array_map('myfunc', $types);
                        $s = "('".implode("','", $types)."')";
                        $query = $query."AND type IN ".$s." ";
                    }
                    if (isset($_GET['author']) && $_GET["author"]){
                        $authors = explode("," , $_GET["author"]);
                        $authors = array_map('myfunc', $authors);
                        $s = "('".implode("','", $authors)."')";
                        $query = $query."AND author IN ".$s." ";
                    }
                    if (isset($_GET['publisher']) && $_GET["publisher"]){
                        $publishers = explode("," , $_GET["publisher"]);
                        $publishers = array_map('myfunc', $publishers);
                        $s = "('".implode("','", $publishers)."')";
                        $query = $query."AND publisher IN ".$s." ";
                    }
                    
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    
                ?>
                
                <div class="card">
                    <img src="<?php echo $row['image1'] ?>" class="card__img">
                    <h3 class="card__header"><?php echo $row['name'] ?></h3>
                    <p class="card__p">ناشر :</p>
                    <p class="card__p"><?php echo $row['publisher'] ?></p>
                    <br>
                    <p class="card__p">نوع کتاب :</p>
                    <p class="card__p"><?php echo $row['type'] ?></p>
                    <br>
                    <p class="card__p">نویسنده :</p>
                    <p class="card__p"><?php echo $row['author'] ?></p>
                    <br>
                    <p class="card__p">کد :</p>
                    <p class="card__p"><?php echo $row['code'] ?></p>
                    
                    <br>
                    <div class="btn-card-holder">
                        <a href="<?php echo 'index.php?page=bookClient&pk='.$row['id'] ?>" class="btn card__link">بیشتر</a>
                        <form action="actions.php?action=add_fav" method="post">
                            <input name="pk" value="<?php echo $row['id'] ?>" type="text" class="opnion__inp" style="display:none;">
                            <input name="user" value="<?php echo $_SESSION['id'] ?>" type="text" class="opnion__inp" style="display:none;">
                            <button id="fav" type="submit" class="btn card__link">مورد علاقه</button>
                        </form>
                    </div>
                </div>
                
                <?php } ?>
                
            </div>

        </div>
    </div>

    <script src="js/client.js"></script>
</body>

</html>
