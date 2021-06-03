<?php
session_start();

if(array_key_exists('submit', $_POST) && isset($_POST['login']) && isset($_POST['password']) && !isset($_SESSION['userid'])) {

    $login = $_POST['login'];
    $pass = $_POST['password'];
    if( $login == 'admin' & $pass == 'admin'){
        $_SESSION['userid']='Admin';
    }else{
        require_once('connect.php'); // $host $user $password $dbname
        $dsn = 'mysql:host='.$host.'; dbname='.$dbname;
        $pdo = new PDO($dsn, $user, $password);
        $sql = 'select * from pacjent where imie=:i and nazwisko=:n';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['i' => $login, 'n' => $pass]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){ //problem with no distinct imie and nazwisko
            $_SESSION['userid']=$row['imie'].' '.$row['nazwisko'];
            $_SESSION['id']=$row['id_pacjent'];
        }
    }
}
if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){
    $url = "panel.php";
    header("Location: $url");
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

        <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
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

        <section class="d-flex justify-content-center h-100">
            <div class="loginCard">
                <div class="d-flex justify-content-center">
                    <div class="loginFormLogoContainer">
                        <img src="./img/doctor.png" class="loginFormLogo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center formContainer">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" name="login" class="form-control input" placeholder="login">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/>
                                        <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/>
                                    </svg>
                                </span>
                            </div>
                            <input type="password" name="password" class="form-control input" placeholder="hasło">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Zapamiętaj mnie</label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 loginBtnContainer">
                            <input type="submit" name="submit" class="btn loginBtn" value="Zaloguj"></input>
                        </div>
                    </form>
                </div>
        
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Nie masz konta? <a href="register.php" class="ml-2">Zarejestruj się</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#">Zapomniałeś/aś hasła?</a>
                    </div>
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