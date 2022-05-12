<?php
session_start();
?>
<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rejestracja</title>
        <meta name="description" content="Ogloszenia">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/login.css">
        <link rel="stylesheet" href="styles/register.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="strip">
                <div class="site-logo"><a href="strona_glowna.php"><p>Ogłoszenia<span style="color:#D9C296;">4</span><span style="color:#AF9C7B;">8</span></p></a></div>
                    <div class="login-form">
                        <form action="register.php" method="post">
                            <input type="text" name="login" maxlength="15" placeholder="Podaj login" required><br>
                            <input type="password" name="password" placeholder="Podaj hasło" required><br>
                            <input type="tel" pattern="[0-9]{9}" name="phone" placeholder="Podaj numer telefonu"><br>
                            <input type="email" name="email" placeholder="Podaj adres e-mail" required><br>
                            <input type="text" name="name" placeholder="Imię" class="half-row" required>
                            <input type="text" name="surname" placeholder="Nazwisko" class="half-row" required><br><br>
                            <label>Płeć:</label>
                            <input type="radio" name="sex" value="Male" checked>Mężczyzna
                            <input type="radio" name="sex" value="Female" >Kobieta
                            <input type="radio" name="sex" value="Other">Inna<br><br>
                            Data urodzenia  <input type="date" name="birth" placeholder="Data urodzenia" required>  <br><br>
                            <p style="margin: 0px; padding: 0px; color: red;">
                            <?php
                            function registerCheck(){
                                //Pobranie danych z inputów
                                @$login = $_POST['login'];
                                @$password = $_POST['password'];
                                @$phone_number = $_POST['phone'];
                                @$email = $_POST['email'];
                                @$name = $_POST['name'];
                                @$surname = $_POST['surname'];
                                @$data_ur = $_POST['birth'];
                                @$_SESSION['plec'] = $_POST['sex'];
                                $plec = $_SESSION['plec'];

                                $connect = new mysqli('localhost','root','','ogloszenia48');
                                
                                //Sprawdzenie, czy połączenie z bazą danych zakończyło się powodzeniem
                                if (mysqli_connect_errno())
                                {
                                    echo "Failed to connect to MySQL: ";
                                }

                                $sql = "Select * from dane_uzytkownika";
                                $zap = mysqli_query($connect,$sql);
                                
                                $took = false;
                                //Sprawdzenie, czy nazwa użytkownika jest zajęta, bądź wystąpiły inne komplikacje
                                while($wiersz = mysqli_fetch_array($zap)) 
                                {
                                    if($wiersz['login'] == $login) 
                                    {
                                        //Nazwa użytkownika zajęta, dodanie rekordu niemożliwe
                                        echo "Nazwa użytkownika zajęta";
                                        $took = true;
                                    }
                                    else if($wiersz['email'] == $email) 
                                    {
                                        //Nazwa użytkownika zajęta, dodanie rekordu niemożliwe
                                        echo "Adres e-mail zajęty";
                                        $took = true;
                                    }
                                }
                                //Dodanie rekordu do tabeli, gdy nazwa nie jest zajęta
                                if(!$took) 
                                {
                                    $sql = "Insert into dane_uzytkownika (login, haslo, nr_tel, email, imie, nazwisko, data_ur, plec) values ('$login','$password','$phone_number','$email','$name','$surname','$data_ur','$plec')";

                                    //Wykonanie zapytania i sprawdzenie jego poprawności
                                    if ($connect->query($sql) === true) 
                                    {
                                        echo "Konto utworzone z powodzeniem";
                                        header("Location: login.php");
                                    } 
                                    else 
                                    {
                                        echo "Wystąpił błąd, proszę spróbować później";
                                    }

                                }
                                //Zamknięcie połączenia z bazą danych
                                mysqli_close($connect);
                            }

                            //Przypisanie funkcji do przcisku sumbit (name="loginSub")
                            if(isset($_POST['loginSub'])) registerCheck();
                            ?>
                            </p><br>
                            <input type="submit" value="Załóż konto" name="loginSub"><br><br>
                        </form>

                        <p>Masz już konto? <a href="login.php">Zaloguj się tu!</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="script.js" async defer></script>
    </body>