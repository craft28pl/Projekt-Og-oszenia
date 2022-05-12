<?php 
session_start();
if(!isset($_SESSION["acclogin"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ogłoszenia</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/forms.css">
        <link rel="stylesheet" href="styles/creator.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <header>
                    <div class="header-bar">
                        <div class="header-logo"><a href="strona_glowna.php"><p>Ogłoszenia<span style="color:#D9C296;">4</span><span style="color:#AF9C7B;">8</span></p></a></div>
                        <div class="header-nav">
                            <div class="nav-bar"><a href="#"><p>Szukaj</p></a></div>
                        </div>
                        <div class="header-profile">
                            <?php 
                            if(isset($_SESSION["acclogin"])){
                                if($_SESSION["acclogin"] == null ){
                                    echo '
                                        <div class="nav-bar"><a href="login.php"><p>Logowanie</p></a></div>
                                        <div class="nav-bar" style="margin-right:20px"><a href="register.php"><p>Rejestracja</p></a></div>
                                        <div class="nav-bar"><img src="images/profile-user.png"></div>
                                    ';
                                }
                                else{
                                    echo '
                                        <div class="nav-bar"><form action="login.php" method="post"><input type="submit" name="logOut" value="Wyloguj"></form></div>
                                        <div class="nav-bar"><p>'.$_SESSION["acclogin"].'</p></div>
                                    ';
                                    if(isset($_SESSION['plec'])){
                                        if ($_SESSION['plec'] == 'Male'){
                                            echo '<div class="nav-bar"><img src="images/profile-male.png"></div>';
                                        }
                                        else if($_SESSION['plec'] == 'Female'){
                                            echo '<div class="nav-bar"><img src="images/profile-female.png"></div>';
                                        }
                                        else{
                                            echo '<div class="nav-bar"><img src="images/profile-user.png"></div>';
                                        }
                                    }else{
                                        echo '<div class="nav-bar"><img src="images/profile-user.png"></div>';
                                    }
                                }
                            }
                            else{
                                echo '
                                <div class="nav-bar"><a href="login.php"><p>Logowanie</p></a></div>
                                <div class="nav-bar" style="margin-right:20px"><a href="register.php"><p>Rejestracja</p></a></div>
                                <div class="nav-bar"><img src="images/profile-user.png"></div>
                                ';
                            }
                            ?>

                        </div>
                    </div>
                </header>
                <main>
                    <div class="box-1">
                        <div class="intro">
                            <h1>Dodaj ogłoszenie</h1>
                        </div>
                        <div class="main-wrapper">
                            <div class="article">
                                <form action="dodawanie.php" method="post">
                                <div class="title">
                                    <input type="text" name="title" placeholder="Podaj tytul artykulu" required>
                                    <select name="category">
                                        <option value="Pomoc">--Wybierz kategorię--</option>
                                        <option value="Dom">Dom</option>
                                        <option value="Praca">Praca</option>
                                        <option value="Moda">Moda</option>
                                        <option value="Sport">Sport</option>
                                        <option value="Zwierzęta">Zwierzęta</option>
                                        <option value="Elektronika">Elektronika</option>
                                        <option value="Kultura i sztuka">Kultura i sztuka</option>
                                        <option value="Pomoc">Pomoc</option>
                                    </select>

                                </div>
                                <div class="image">
                                    <input type="radio" name="art-image" id="site-image" onclick="switchPhotoSource()" checked>Wybor obrazow
                                    <input type="radio" name="art-image" id="own-image" onclick="switchPhotoSource()" >Własny obraz
                                    <div class="art-image-own" style="display: none;">
                                        <input type="text" name="art-image-link" placeholder="Sciezka do obrazu">
                                    </div>
                                    <div class="art-image-site">
                                        <input type="radio" name="art-image-site"value="uslugi.png"><img src="images/uslugi.png" width="100" height="40">
                                        <input type="radio" name="art-image-site"value="tuba.png"><img src="images/tuba.png" width="100" height="40">
                                        <input type="radio" name="art-image-site"value="sprzedaż.png"><img src="images/sprzedaż.png" width="100" height="40">
                                    </div>
                                </div>
                                <div class="text">
                                    <textarea name="art-text" placeholder="Wprowadz treść ogłoszenia" required></textarea>
                                </div>
                                <div class="contact">
                                    <p>Telefon: <input type="tel" name="tel" placeholder="Wprowadz nr. telefonu" required><span style="visibility: hidden;">*Pole nie jest wymagane</span></p>
                                    <p>E-mail: <input type="email" name="e-mail" placeholder="Wprowadz adres e-mail"> <span style="visibility: hidden;">*Pole nie jest wymagane</span></p>
                                    <p>Adres: <input type="text" name="address" placeholder="Wprowadz adres zamieszkania"><span style="color: red;">*Pole nie jest wymagane</span></p>
                                </div><br><br>
                                
                                <input name="addPost" type="submit" value="Zamieść ogłoszenie">
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer>
                    <p>&copy;2022 Ekipa ZS3</p>
                </footer>
            </div>
        </div>
        <?php
        function addPost(){

            @$title = $_POST["title"];
            @$art_image = $_POST["art-image-link"];
            if($art_image == ""){
                $art_image = $_POST["art-image-site"];
            }
            @$art_text = $_POST["art-text"];
            @$date = date('y-m-d');
            @$time = date('H:i');
            @$author = $_SESSION["acclogin"];
            @$category = $_POST["category"];
            $nr_tel = $_POST['tel'];
            $email = $_POST['e-mail'];
            $adres = $_POST['address'];

            $connect = new mysqli('localhost','root','','ogloszenia48');
            //Sprawdzenie, czy połączenie z bazą danych zakończyło się powodzeniem
            if (mysqli_connect_errno())
            {
                echo "Połączenie z bazą danych zakończone niepowodzeniem";
            }

            $sql = "Insert into dane_ogloszen (autor, tytul, kategoria, obraz, tekst, data_utworzenia, czas_utworzenia, nr_tel, e_mail, adres) 
            values ('$author','$title','$category','$art_image','$art_text','$date','$time','$nr_tel','$email','$adres')";

            //Wykonanie zapytania i sprawdzenie jego poprawności
            if ($connect->query($sql) === true) 
            {
                echo "Artykul zamieszczony z powodzeniem";
            } 
            else 
            {
                echo "Wystąpił błąd, proszę spróbować później";
            }

            mysqli_close($connect);

        }

        if(isset($_POST["addPost"])) addPost();
        ?>
        <script>
            function switchPhotoSource(){
                if(document.querySelector("#own-image").checked == true){
                    document.querySelector(".art-image-own").style.display = "block";
                    document.querySelector(".art-image-site").style.display = "none";
                }
                else if(document.querySelector("#site-image").checked == true){
                    document.querySelector(".art-image-own").style.display = "none";
                    document.querySelector(".art-image-site").style.display = "block";
                }
            }
        </script>
    </body>
</html>