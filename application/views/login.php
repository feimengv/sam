<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="utf-8">
        <title>登录(Login)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="<?=base_url()?>static/login/css/style.css">



    </head>

    <body>

        <div class="page-container">
            <h1>后台登录(Login)</h1>
            <form action="<?=site_url('login/check')?>" method="post">
                <input name="action" value="truelogin" type="hidden">
                <input type="text" name="data[username]" class="username" placeholder="请输入您的用户名！" required>
                <input type="password" name="data[password]" class="password" placeholder="请输入您的密码！" required>
                <button type="submit" class="submit_button">登录</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>power SAM</p>
            </div>
        </div>

    </body>

</html>