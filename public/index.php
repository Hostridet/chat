<?php
$messages = json_decode(file_get_contents('../src/base.json'), true);
$user = [
    "lenya" => "poc",
    "Elisey" => "derevnya",
    "Sasha" => "devops",
    "Lesha" => "dadinside"
];
$isAuthorized = false;

if (!empty($_GET['login']) || !empty($_GET['password']))
{
    if (key_exists($_GET["login"], $user) && $user[$_GET["login"]] == $_GET["password"])
    {
        echo '<div class="alert alert-success" role="alert">
                Добро пожаловать!
                </div>';
        $isAuthorized = true;
    }
    else
    {
        echo '<div class="alert alert-danger" role="alert">
                Неверный логин или пароль
                </div>';
    }
}
date_default_timezone_set('Asia/Vladivostok');
if (isset($_POST['message'])) {
    $messages [] = [
        "login" => $_GET["login"],
        "message" => htmlspecialchars($_POST['message'], ENT_QUOTES)
    ];
    file_put_contents('../src/base.json', json_encode($messages));
}
?>

<html>
<head>
    <title>4атик</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../src/style.css"
</head>
<body>
<header>
    <div class="main_top">Chat</div>
</header>
<form class="main_block" action="" method="get">
    <div class="content">
    <label class="form-label">
        Логин <input class="form-control" type="text" name="login" placeholder="Login">
    </label>
    <br>
    <label class="form-label">
        Пароль <input class="form-control" type="password" name="password" placeholder="Password">
    </label>
    <br>
    <input class="btn btn-info" type="submit" value="Войти">
    </div>
</form>
<div class="chat">
<?php
    foreach ($messages as $message) { ?>
            <div class="avatars">
                <img src="../image/poc.jpg" alt="Avatar" style="width:90px">
                <p><span><a> <?php echo $message['login'] ?> </a></span></p>
                <p><?php echo $message['message'] ?></p>
            </div>

<?php } ?> </div> <?php
    if($isAuthorized)
    {
        echo '
        <form method="post">
        <div class="send_message"> 
            <input class="form-control" type="text" name="message" placeholder="Your message">
            <input class="btn btn-info" type="submit" value="Send">
        </div>
        </form>
        ';
    }
?>
</body>
</html>