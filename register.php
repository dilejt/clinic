<?php
session_start();

if(array_key_exists('register', $_POST) && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['telefon']) && isset($_POST['ulica']) 
&& isset($_POST['nrDomu']) && isset($_POST['pesel']) && isset($_POST['nrMieszkania']) && !isset($_SESSION['userid'])) {

    $name = $_POST['imie'];
    $surrname = $_POST['nazwisko'];
    $phone = $_POST['telefon'];
    $street = $_POST['ulica'];
    $house = $_POST['nrDomu'];
    $pesel = $_POST['pesel'];
    $flat = $_POST['nrMieszkania'];

    require_once('connect.php'); // $host $user $password $dbname
    $dsn = 'mysql:host='.$host.'; dbname='.$dbname;
    $pdo = new PDO($dsn, $user, $password);

    $sql = 'insert into pacjent(imie,nazwisko,nr_telefonu,ulica,nr_domu,pesel,nr_mieszkania) values(:b,:c,:d,:e,:f,:g,:h)';
    $stmt = $pdo->prepare($sql);
    if ( $stmt->execute(['b' => $_POST['imie'],'c' => $_POST['nazwisko'],'d' => $_POST['telefon'],'e' => $_POST['ulica'],'f' => $_POST['nrDomu'],'g' => $_POST['pesel'],'h' => $_POST['nrMieszkania']]) ){
        $url = "register.php";
        header("Location: $url");
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
    <body class="bg-light register">
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

        <section class="d-flex justify-content-center formContainer">
            <div class="registerCard">
                <div class="d-flex justify-content-center">
                    <div class="registerFormLogoContainer">
                        <img src="./img/doctor.png" class="registerFormLogo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center formContainer">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group mb-3">
                            <label for="imie">Podaj imie:</label>
                            <input type="text" name="imie" class="form-control input" id="imie" placeholder="Imie" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nazwisko">Podaj nazwisko:</label>
                            <input type="text" name="nazwisko" class="form-control input" id="nazwisko" placeholder="Nazwisko" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="telefon">Podaj numer telefonu:</label>
                            <input type="text" name="telefon" class="form-control input" id="telefon" placeholder="xxxxxxxxx" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ulica">Podaj ulice:</label>
                            <input type="text" name="ulica" class="form-control input" id="ulica" placeholder="Ulica" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nrDomu">Podaj numer domu:</label>
                            <input type="text" name="nrDomu" class="form-control input" id="nrDomu" placeholder="Numer domu" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="pesel">Podaj pesel:</label>
                            <input type="text" name="pesel" class="form-control input" id="pesel" placeholder="xxxxxxxxxxx" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="nrMieszkania">Podaj numer mieszkania:</label>
                            <input type="text" name="nrMieszkania" class="form-control input" id="nrMieszkania" placeholder="Numer mieszkania" required>
                        </div>
                        <div class="d-flex justify-content-center mt-3 registerBtnContainer">
                            <input type="submit" name="register" class="btn registerBtn" value="Zarejestruj"></input>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <footer class="container-fluid py-5 text-dark footer">
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