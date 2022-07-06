<header class="header">
    <!-- logo -->
    <nav>
        <a href="index.php?page=client" class="header__logo"><span class="welcome__logo--1"> آی</span><span class="welcome__logo--2">&nbsp;بوک </span></a>
    </nav>
    <!-- menu -->
    <ul class="header__menu">
        <li class="header__menu__item">
            <a href="index.php?page=favClient" class="header__menu__link">
                <span class="header__menu__link__design" data-menu="لیست علاقه مندی">لیست علاقه مندی</span>
            </a>
        </li>
        <li class="header__menu__item">
            <a href="index.php?page=client" class="header__menu__link">
                <span class="header__menu__link__design" data-menu="کتاب خانه">کتاب خانه</span>
            </a>
        </li>
        <li class="header__menu__item">
            <a href="index.php?page=dep" class="header__menu__link">
                <span class="header__menu__link__design" data-menu="امانات">امانات</span>
            </a>
        </li>
        <?php
            if (isset($_SESSION['id'])){
                $query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' AND isadmin=1 LIMIT 1";
                $result = mysqli_query($link, $query);
                if (mysqli_num_rows($result) > 0) {
        ?>
        <li class="header__menu__item">
            <a href="index.php?page=admin" class="header__menu__link">
                <span class="header__menu__link__design" data-menu="مدیریت">مدیریت</span>
            </a>
        </li>
        <li class="header__menu__item">
            <a href="index.php?page=admindep" class="header__menu__link">
                <span class="header__menu__link__design" data-menu="امانات ادمین"> امانات ادمین</span>
            </a>
        </li>
        <?php
                }
            }
        ?>
    </ul>
    <div class="header__button">
        <a href="actions.php?action=logout" class="header__logOut btn">خروج</a>
    </div>
</header>