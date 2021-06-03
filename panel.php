<?php
session_start();
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
    <body class="bg-light">
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

        <section class="visitPanel ">
            <div class="container">
                <?php
                if(!empty($_SESSION['userid']) && isset($_SESSION['userid'])){
                    require_once('connect.php'); // $host $user $password $dbname
                    $dsn = 'mysql:host='.$host.'; dbname='.$dbname;
                    $pdo = new PDO($dsn, $user, $password);
                    if($_SESSION['userid']=='Admin'){ //admin
                        /* ----------------- patient ----------------- */

                        $sql = 'select * from pacjent';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        echo "<div class='table-responsive-md'>
                        <table class='table table-hover text-center'>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST' id='formPatient'>
                                <caption>Lista pacjentów</caption>
                                <thead>
                                <tr>
                                    <th scope='col'>Usuń</th>
                                    <th scope='col'>Id</th>
                                    <th scope='col'>Imie</th>
                                    <th scope='col'>Nazwisko</th>
                                    <th scope='col'>Numer telefonu</th>
                                    <th scope='col'>Ulica</th>
                                    <th scope='col'>Numer domu</th>
                                    <th scope='col'>Pesel</th>
                                    <th scope='col'>Numer mieszkania</th>
                                    <th scope='col'>Dodaj</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "
                            <tr>
                                <td>
                                    <div class='custom-control custom-checkbox '>
                                        <input class='custom-control-input' type='checkbox' id=pat'".$row['id_pacjent']."' name='patient[]' value='".$row['id_pacjent']."'>
                                        <label class='custom-control-label' for=pat'".$row['id_pacjent']."'></label>
                                    </div>
                                </td>
                                <td>".$row['id_pacjent']."</td>
                                <td>".$row['imie']."</td>
                                <td>".$row['nazwisko']."</td>
                                <td>".$row['nr_telefonu']."</td>
                                <td>".$row['ulica']."</td>
                                <td>".$row['nr_domu']."</td>
                                <td>".$row['pesel']."</td>
                                <td>".$row['nr_mieszkania']."</td>
                            </tr>
                            ";
                        }
                        echo "
                        <td>
                            <label for='deletePatient' class='btn'>
                                <svg width='2em' height='2em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                                </svg>
                            </label>
                            <input id='deletePatient' name='deletePatient' type='submit' class='d-none' >
                        </td>
                        <td>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='imiePatient' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='nazwiskoPatient' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='nrTelPatient' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='ulicaPatient' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='nrDomuPatient' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='peselPatient' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='nrMieszkaniaPatient' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <label for='addPatient' class='btn'>
                                <svg width='1.5em' height='1.5em' viewBox='0 0 16 16' class='bi bi-plus-circle-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z'/>
                                </svg>
                            </label>
                            <input id='addPatient' name='addPatient' type='submit' class='d-none' />
                        </td>
                        </tbody>
                        </form>
                        </table>
                        </div>
                        ";
                        //delete patient
                        if (array_key_exists('deletePatient', $_POST) && isset($_POST['deletePatient'])){ 
                            if (isset($_POST['patient'])){
                                foreach($_POST['patient'] as $i){
                                    $sql = 'delete from pacjent where id_pacjent=:i';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['i' => $i]);
                                }

                            }
                            echo "<script> window.location.replace('panel.php') </script>"; //prevent submit input after reload
                        }
                        //add patient
                        if (array_key_exists('addPatient', $_POST) && isset($_POST['addPatient'])){
                            if (isset($_POST['imiePatient']) && isset($_POST['nazwiskoPatient']) && isset($_POST['nrTelPatient'])
                            && isset($_POST['ulicaPatient']) && isset($_POST['nrDomuPatient']) && isset($_POST['peselPatient']) && isset($_POST['nrMieszkaniaPatient'])
                            && !empty($_POST['imiePatient']) && !empty($_POST['nazwiskoPatient']) && !empty($_POST['nrTelPatient'])
                            && !empty($_POST['ulicaPatient']) && !empty($_POST['nrDomuPatient']) && !empty($_POST['peselPatient']) && !empty($_POST['nrMieszkaniaPatient'])){
                                $sql = 'insert into pacjent(imie,nazwisko,nr_telefonu,ulica,nr_domu,pesel,nr_mieszkania) values(:b,:c,:d,:e,:f,:g,:h)';
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['b' => $_POST['imiePatient'],'c' => $_POST['nazwiskoPatient'],'d' => $_POST['nrTelPatient'],'e' => $_POST['ulicaPatient'],'f' => $_POST['nrDomuPatient'],'g' => $_POST['peselPatient'],'h' => $_POST['nrMieszkaniaPatient']]);
                            }
                            echo "<script> window.location.replace('panel.php') </script>"; //prevent submit input after reload
                        }

                        /* ----------------- doctor ----------------- */

                        $sql = 'select * from lekarz';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        echo "<div class='table-responsive-xl'>
                        <table class='table table-hover text-center'>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST' id='formDoctor'>
                                <caption>Lista lekarzy</caption>
                                <thead>
                                <tr>
                                    <th scope='col'>Usuń</th>
                                    <th scope='col'>Id</th>
                                    <th scope='col'>Imie</th>
                                    <th scope='col'>Nazwisko</th>
                                    <th scope='col'>Specjalizacja</th>
                                    <th scope='col'>Numer telefonu</th>
                                    <th scope='col'>Ulica</th>
                                    <th scope='col'>Numer domu</th>
                                    <th scope='col'>Pesel</th>
                                    <th scope='col'>Numer mieszkania</th>
                                    <th scope='col'>Dodaj</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "
                            <tr>
                                <td>
                                    <div class='custom-control custom-checkbox '>
                                        <input class='custom-control-input' type='checkbox' id=doc'".$row['id_lekarz']."' name='doctor[]' value='".$row['id_lekarz']."'>
                                        <label class='custom-control-label' for=doc'".$row['id_lekarz']."'></label>
                                    </div>
                                </td>
                                <td>".$row['id_lekarz']."</td>
                                <td>".$row['imie']."</td>
                                <td>".$row['nazwisko']."</td>
                                <td>".$row['specjalizacja']."</td>
                                <td>".$row['nr_telefonu']."</td>
                                <td>".$row['ulica']."</td>
                                <td>".$row['nr_domu']."</td>
                                <td>".$row['pesel']."</td>
                                <td>".$row['nr_mieszkania']."</td>
                            </tr>
                            ";
                        }
                        echo "
                        <td>
                            <label for='deleteDoctor' class='btn'>
                                <svg width='2em' height='2em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                                </svg>
                            </label>
                            <input id='deleteDoctor' name='deleteDoctor' type='submit' class='d-none' />
                        </td>
                        <td></td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='imieDoctor' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='nazwiskoDoctor' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='specjalizacjaDoctor' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='text' name='nrTelDoctor' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='ulicaDoctor' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='nrDomuDoctor' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='peselDoctor' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <input type='text' name='nrMieszkaniaDoctor' class='form-control input'>
                            </div>
                        </td>
                        <td>
                            <label for='addDoctor' class='btn'>
                                <svg width='1.5em' height='1.5em' viewBox='0 0 16 16' class='bi bi-plus-circle-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z'/>
                                </svg>
                            </label>
                            <input id='addDoctor' name='addDoctor' type='submit' class='d-none' />
                        </td>
                        </tbody>
                        </form>
                        </table>
                        </div>
                        ";
                        //delete doctor
                        if (array_key_exists('deleteDoctor', $_POST) && isset($_POST['deleteDoctor'])){
                            if (isset($_POST['doctor'])){
                                foreach($_POST['doctor'] as $i){
                                    $sql = 'delete from lekarz where id_lekarz=:i';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['i' => $i]);
                                }

                            }
                            echo "<script> window.location.replace('panel.php') </script>"; //prevent submit input after reload
                        }
                        //add doctor
                        if (array_key_exists('addDoctor', $_POST) && isset($_POST['addDoctor'])){
                            if (isset($_POST['imieDoctor']) && isset($_POST['nazwiskoDoctor']) && isset($_POST['specjalizacjaDoctor']) && isset($_POST['nrTelDoctor'])
                            && isset($_POST['ulicaDoctor']) && isset($_POST['nrDomuDoctor']) && isset($_POST['peselDoctor']) && isset($_POST['nrMieszkaniaDoctor'])
                            && !empty($_POST['imieDoctor']) && !empty($_POST['nazwiskoDoctor']) && !empty($_POST['specjalizacjaDoctor']) && !empty($_POST['nrTelDoctor'])
                            && !empty($_POST['ulicaDoctor']) && !empty($_POST['nrDomuDoctor']) && !empty($_POST['peselDoctor']) && !empty($_POST['nrMieszkaniaDoctor'])){
                                $sql = 'insert into lekarz(imie,nazwisko,specjalizacja,nr_telefonu,ulica,nr_domu,pesel,nr_mieszkania) values(:b,:c,:d,:e,:f,:g,:h,:i)';
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['b' => $_POST['imieDoctor'],'c' => $_POST['nazwiskoDoctor'],'d' => $_POST['specjalizacjaDoctor'],'e' => $_POST['nrTelDoctor'],'f' => $_POST['ulicaDoctor'],'g' => $_POST['nrDomuDoctor'],'h' => $_POST['peselDoctor'],'i' => $_POST['nrMieszkaniaDoctor']]);
                            }
                            echo "<script> window.location.replace('panel.php') </script>"; //prevent submit input after reload
                        }

                        /* ----------------- visit ----------------- */

                        $sql = 'select * from wizyta';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        echo "<div class='table-responsive-xl'>
                        <table class='table table-hover text-center'>
                            <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='POST' id='formVisit'>
                                <caption>Lista wizyt</caption>
                                <thead>
                                <tr>
                                    <th scope='col'>Usuń</th>
                                    <th scope='col'>Id</th>
                                    <th scope='col'>Pacjent</th>
                                    <th scope='col'>Lekarz</th>
                                    <th scope='col'>Data</th>
                                    <th scope='col'>Czy odbyta</th>
                                    <th scope='col'>Dodaj</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "
                            <tr>
                                <td>
                                    <div class='custom-control custom-checkbox '>
                                        <input class='custom-control-input' type='checkbox' id=vis'".$row['id_wizyta']."' name='visit[]' value='".$row['id_wizyta']."'>
                                        <label class='custom-control-label' for=vis'".$row['id_wizyta']."'></label>
                                    </div>
                                </td>
                                <td>".$row['id_wizyta']."</td>
                                <td>".$row['id_pacjent']."</td>
                                <td>".$row['id_lekarz']."</td>
                                <td>".substr($row['data'], 0, -3)."</td>
                                <td>".$row['odbyta']."</td>
                            </tr>
                            ";
                        }
                        echo "
                        <td>
                            <label for='deleteVisit' class='btn'>
                                <svg width='2em' height='2em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                                </svg>
                            </label>
                            <input id='deleteVisit' name='deleteVisit' type='submit' class='d-none' />
                        </td>
                        <td></td>
                        <td>
                            <div class='input-group'>
                                <select name='idPatientVisit' class='custom-select'>";
                                    $sql = 'select id_pacjent,imie,nazwisko from pacjent';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) echo "<option value='".$row['id_pacjent']."'>".$row['imie'].' '.$row['nazwisko']."</option>";
                                echo "</select>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <select name='idDoctorVisit' class='custom-select'>";
                                    $sql = 'select id_lekarz,imie,nazwisko from lekarz';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) echo "<option value='".$row['id_lekarz']."'>".$row['imie'].' '.$row['nazwisko']."</option>";
                                echo "</select>
                            </div>
                        </td>
                        <td>
                            <div class='input-group'>
                                <input type='datetime-local' name='dataVisit' class='form-control input'>
                            </div>
                        </td>
                            <td>
                            <div class='input-group'>
                                <select name='odbytaVisit' class='custom-select'>
                                    <option value='0' selected>0</option>
                                    <option value='1'>1</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <label for='addVisit' class='btn'>
                                <svg width='1.5em' height='1.5em' viewBox='0 0 16 16' class='bi bi-plus-circle-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z'/>
                                </svg>
                            </label>
                            <input id='addVisit' name='addVisit' type='submit' class='d-none' />
                        </td>
                        </tbody>
                        </form>
                        </table>
                        </div>
                        ";
                        //delete visit
                        if (array_key_exists('deleteVisit', $_POST) && isset($_POST['deleteVisit'])){
                            if (isset($_POST['visit'])){
                                foreach($_POST['visit'] as $i){
                                    $sql = 'delete from wizyta where id_wizyta=:i';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['i' => $i]);
                                }
                            }
                            echo "<script> window.location.replace('panel.php') </script>"; //prevent submit input after reload
                        }
                        //add visit
                        if (array_key_exists('addVisit', $_POST) && isset($_POST['addVisit'])){
                            if (isset($_POST['idPatientVisit']) && isset($_POST['idDoctorVisit']) && isset($_POST['dataVisit']) && isset($_POST['odbytaVisit'])
                            && !empty($_POST['idPatientVisit']) && !empty($_POST['idDoctorVisit']) && !empty($_POST['dataVisit']) && (!empty($_POST['odbytaVisit']) || $_POST['odbytaVisit']=='0') ){
                                $sqlCheckPatient = 'select id_pacjent from pacjent where id_pacjent=:a';
                                $stmtCheckPatient = $pdo->prepare($sqlCheckPatient);
                                $stmtCheckPatient->execute(['a' => $_POST['idPatientVisit']]);

                                $sqlCheckDoctor = 'select id_lekarz from lekarz where id_lekarz=:a';
                                $stmtCheckDoctor = $pdo->prepare($sqlCheckDoctor);
                                $stmtCheckDoctor->execute(['a' => $_POST['idDoctorVisit']]);

                                if ( ($_POST['odbytaVisit']=='1' || $_POST['odbytaVisit']=='0') && $stmtCheckPatient->fetch(PDO::FETCH_ASSOC) && $stmtCheckDoctor->fetch(PDO::FETCH_ASSOC) ){
                                    $sql = 'insert into wizyta(id_pacjent,id_lekarz,data,odbyta) values(:b,:c,:d,:e)';
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['b' => $_POST['idPatientVisit'],'c' => $_POST['idDoctorVisit'],'d' => $_POST['dataVisit'],'e' => $_POST['odbytaVisit']]);
                                }
                            }
                            echo "<script> window.location.replace('panel.php') </script>"; //prevent submit input after reload
                        }
                        
                    }else{ //user
                        
                        $pastVisitsCount = 0;
                        $i = 0;
                        $allVisitsCount = 0;

                        $sqlAllCount = 'select id_pacjent from wizyta where id_pacjent=:p';
                        $stmtAllCount = $pdo->prepare($sqlAllCount);
                        $stmtAllCount->execute(['p' => $_SESSION['id']]);
                        while($row = $stmtAllCount->fetch(PDO::FETCH_ASSOC)) $allVisitsCount++;

                        $sqlCount = 'select id_pacjent from wizyta where odbyta=:i and id_pacjent=:p';
                        $stmtCount = $pdo->prepare($sqlCount);
                        $stmtCount->execute(['i' => "1", 'p' => $_SESSION['id']]);
                        while($row = $stmtCount->fetch(PDO::FETCH_ASSOC)) $pastVisitsCount++;
                        
                        $sql = 'select l.imie as imie,l.nazwisko as nazwisko,l.specjalizacja as specjalizacja,w.id_wizyta as id_wizyta,w.data as data,w.odbyta as odbyta from wizyta w join lekarz l on w.id_lekarz = l.id_lekarz where w.id_pacjent=:i order by w.odbyta desc ,w.data asc';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['i' => $_SESSION['id']]);
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            if($row['odbyta']){
                                if ($i==0) echo "<h4 class='text-primary'>Odbyte</h4><hr><div class='row row-cols-1 row-cols-md-3'>";
                                echo "
                                <div class='col mb-4'>
                                    <div class='card border-primary mb-3'>
                                        <div class='text-primary card-header d-flex justify-content-between'><div><s>".substr($row['data'], 0, -3)."</s></div><div>Odbyta</div></div>
                                        <div class='card-body text-primary'>
                                            <h4 class='card-title'>dr ".$row['imie']." ".$row['nazwisko']."</h4>
                                            <h6 class='card-title font-weight-light'>".$row['specjalizacja']."</h6>
                                            <p class='card-text'>Wizyta nr ".$row['id_wizyta']."</p>
                                        </div>
                                    </div>
                                </div>
                                ";
                                $i++;
                                if($i == $pastVisitsCount) $i = 0;
                                
                            }else{
                                if ($i==0) echo "<h4 class='text-info'>Zaplanowane</h4><hr><div class='row row-cols-1 row-cols-md-3'>";
                                echo "
                                <div class='col mb-4'>
                                    <div class='card border-done mb-3'>
                                        <div class='text-done card-header d-flex justify-content-between'><div>".substr($row['data'], 0, -3)."</div><div>Zaplanowana</div></div>
                                        <div class='card-body text-done'>
                                            <h4 class='card-title'>dr ".$row['imie']." ".$row['nazwisko']."</h4>
                                            <h6 class='card-title font-weight-light'>".$row['specjalizacja']."</h6>
                                            <p class='card-text'>Wizyta nr ".$row['id_wizyta']."</p>
                                        </div>
                                    </div>
                                </div>
                                ";
                                $i++;
                                if($i == $allVisitsCount-$pastVisitsCount) $i = 0;
                            }
                            if ($pastVisitsCount!=0 && $i==0) echo "</div>";
                        }
                    }
                }
                ?>
                
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