<?php 
session_start();
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
                        <div class="main-wrapper">
                        <?php
                        function clear($data){
                            if($data == ''){
                                return 'nie podano';
                            }
                            else{
                                return $data;
                            }
                        }
                        function loadPost($article_data){
                            $nr_tel = $article_data['nr_tel'];
                            $email = $article_data['e_mail'];
                            $adres = $article_data['adres'];
                            $nr_tel = clear($nr_tel);
                            $email = clear($email);
                            $adres = clear($adres);
                            echo '
                            <div class="article">
                                        <div class="title">
                                            <h2>'.$article_data['tytul'].'</h2>
                                            <h4>'.$article_data['kategoria'].'</h4>
                                        </div>
                                        <div class="image">
                                            <img src="images/'.$article_data['obraz'].'">
                                        </div>
                                        <div class="info">
                                            <p>'.$article_data['data_utworzenia'].', '.$article_data['czas_utworzenia'].'</p>
                                        </div>
                                        <div class="user">
                                            <p>Dodał: '.$article_data['autor'].'</p>
                                        </div>
                                        <div class="dot-case">
                                            <div class="dot"></div>
                                        </div>
                                        <div class="text">
                                            <h3>Ogłoszenie</h3>
                                            <p style="width: inherit; word-wrap: break-word;">'.$article_data['tekst'].'</p>
                                        </div>
                                        <div class="dot-case">
                                            <div class="dot"></div>
                                        </div>
                                        <div class="contact">
                                            <h3>Kontakt</h3>
                                            <p>Telefon: '.$nr_tel.'</p>
                                            <p>E-mail: '.$email.'</p>
                                            <p>Adres: '.$adres.'</p>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        $connect = new mysqli('localhost','root','','ogloszenia48');
            
                        $sql = "Select * from dane_ogloszen where id_ogloszenia =".$_GET['articleId'];
                        $zap = mysqli_query($connect,$sql);
                        $wiersz = mysqli_fetch_array($zap);

                        loadPost($wiersz);
                        
                        mysqli_close($connect);
                        ?>
                    </div>
                </main>
                <footer>
                    <p>&copy;2022 Ekipa ZS3</p>
                </footer>
            </div>
        </div>
        <?php
        function addPost(){

            $title = $_POST["title"];
            $art_image = $_POST["art-image-link"];
            if($art_image == ""){
                $art_image = $_POST["art-image-site"];
            }
            $art_text = $_POST["art-text"];
            $date = date('d-m-y');
            $time = date('H:i');
            $author = $_SESSION["acclogin"];

            $connect = new mysqli('localhost','root','','ogloszenia48');
            //Sprawdzenie, czy połączenie z bazą danych zakończyło się powodzeniem
            if (mysqli_connect_errno())
            {
                echo "Połączenie z bazą danych zakończone niepowodzeniem";
            }

            $sql = "Insert into dane_ogloszen (autor, tytul, obraz, tekst, data_umieszczenia, godzina_umieszczenia) values ('$author','$title','$art_image','$art_text','$date','$time')";

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