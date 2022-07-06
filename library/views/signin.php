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

    <div class="bgrc">
        <!-- design of circles------------------------------------------------------------ -->
        <div class="circle-1"></div>
        <div class="circle-2"></div>
        <div class="signIn">
            <!-- form ------------------------------------------------------------------------->
            <form action="actions.php?action=signin" class="form" method="post">
                <h3 class="form__title"><span class="welcome__logo--1"> آی</span><span class="welcome__logo--2">&nbsp;بوک </span></h3>
                <!-- username------------------------------------------------------------------------ -->

                <label for="email" class="form__user__for">ایمیل</label>
                <input type="text" class="form__user" placeholder="ایمیل خود را وارد کنید" id="email" name="email">
                <!-- password------------------------------------------------------------------------ -->

                <label for="password" class="form__user__for">رمز عبور</label>
                <input type="password" class="form__user" placeholder="رمز عبور خود را وارد کنید" id="password" name="password">

                <!-- button -->
                <input type="submit" class="btn signIn__btn" value="ورود">
            </form>
            <a href="index.php?page=signup" class="signIn__p">ثبت نام نکرده اید؟</a>
        </div>
    </div>

</body>

</html>