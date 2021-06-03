<?php
session_start();

if(array_key_exists('register', $_POST)){
    if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
        $url = "panel.php";
        header("Location: $url");
    }else{
        $url = "register.php";
        header("Location: $url");
    }
}

?>
<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title></title>
    </head>
    <body class="bg-light login">
    
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
            <a class="navbar-brand font-weight-bold" href="index.php">e<span class="text-primary">W</span>izyta</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo02">
                <?php 
                if(!empty($_SESSION['userid']) && isset($_SESSION['userid'])){
                    echo "
                    <ul class='navbar-nav'>
                        <li class='nav-item'>
                            <a class='nav-link active' href='panel.php'>Zalogowany jako: ".$_SESSION['userid']."</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link active' href='logout.php'>Wyloguj</a>
                        </li>
                    </ul>
                    ";
                }else{
                    echo "
                    <ul class='navbar-nav'>
                        <li class='nav-item'><a class='nav-link active' href='login.php'>Logowanie</a></li>
                        <li class='nav-item'><a class='nav-link active' href='register.php'>Rejestracja</a></li>
                    </ul>
                    ";
                }
                ?>
            </div>
        </nav>

        <section class="h-100" id="banner">
            <div class="container-fluid" id="bannerInfo">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <h2>Zarejestruj się już teraz!</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <input type="submit" name="register" class="btn bannerBtn" value="Zarejestruj"></input>
                        </form>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </section>

        <footer id="footer" class="container-fluid py-5 text-dark footer">
            <div class="row">
                <div class="col-1 col-md-1"></div>
                <div class="col-6 col-md-6">
                <h5 class="font-weight-bold">e<span class="text-primary">W</span>izyta</h5>
                    <small class="d-block mb-3 text-muted">&copy; 2020</small>
                </div>
                <div class="col-5 col-md-5"></div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html>