<?php
session_start();

if(isset($_POST['logOut'])){
    $_SESSION['acclogin'] = null;
}
?>
<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Logowanie</title>
        <meta name="description" content="Ogloszenia">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="styles/forms.css">
        <link rel="stylesheet" href="styles/login.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="filler" style="height: 10%; width: 100%"></div>
            <div class="strip">
                <div class="site-logo"><a href="strona_glowna.php"><p>Ogłoszenia<span style="color:#D9C296;">4</span><span style="color:#AF9C7B;">8</span></p></a></div>
                <div class="login-form">
                    <form action="login.php" method="post">
                        <input type="text" name="login" placeholder="Podaj login"><br>
                        <input type="password" name="password" placeholder="Podaj hasło"><br><br>

                        <input type="submit" value="Zaloguj" name="loginSub">
                        <p style="margin: 0px; padding: 0px; color: red;">
                        <?php
                        function loginCheck(){
                            //Pobranie danych z inputów
                            @$login = $_POST['login'];
                            @$password = $_POST['password'];

                            $loggedIn = false;

                            $connect = new mysqli('localhost','root','','ogloszenia48');

                            //Sprawdzenie, czy połączenie z bazą danych zakończyło się powodzeniem
                            if (mysqli_connect_errno())
                            {

                                echo "Błąd w połączeniu do bazy danych";

                            }

                            $sql = "Select * from dane_uzytkownika";
                            $zap = mysqli_query($connect,$sql);

                            while($wiersz = mysqli_fetch_array($zap)) 
                            {
                                if($wiersz['login'] == $login && $wiersz['haslo'] == $password) 
                                {
                                    $loggedIn = true;
                                    $_SESSION["plec"] = $wiersz['plec'];
                                    header("Location: strona_glowna.php");
                                }
                            }

                            if($loggedIn) 
                            {
                                echo "Udało się zalogować!";
                                $_SESSION["acclogin"] = $login;
                            }
                            else 
                            {
                                echo "Nie udało się zalogować";
                            }

                            mysqli_close($connect);
                        }

                        if(isset($_POST['loginSub'])) loginCheck();
                        ?>
                        </p>
                    </form>
                    <p>Nie masz jeszcze konta? <a href="register.php">Zarejestruj się tu!</a></p>
                </div>
            </div>
        </div>
    </body>
</html>