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
                            <div class="text-sphere">
                                <div class="intro-sphere"><h1>Strona ogłoszeniowa </h1></div>
                                <div class="joined-sphere">
                                    <div class="description-sphere">
                                        <h2>
                                        Nasza strona to idealne miejsce do zamieszczenia ogłoszenia.<br> <span style="font-weight: 700">Rozbudowana społeczność strony</span> i 
                                        <span style="font-weight: 700">możliwość dostosowania do potrzeb</span> <br> to nasze znaki firmowe.
                                        </h2>
                                    </div>
                                    <div class="usable-sphere">
                                        <div class="usable-sphere-option">
                                            <p>Chcesz rozejrzeć się po wszystkich ogłoszeniach?</p>
                                            <a href="ogloszenia.php">
                                            <div class="usable-sphere-button">
                                                To nigdy nie było prostsze, kliknij tu!
                                            </div></a>
                                        </div>
                                        <div class="usable-sphere-option">
                                            <p>Chcesz dodać ogłoszenie?</p>
                                            <a href="dodawanie.php">
                                            <div class="usable-sphere-button">
                                                Zrób to tutaj!
                                            </div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-2">
                        <h4>Nasza oferta:</h4>
                    </div>
                    <div class="box-3">
                        <div class="flex-sphere">
                            <div class="flex-part">
                                <img class="flex-icon" src="images/user.png">
                                <p>Logowanie i rejestracja</p>
                            </div>
                            <div class="flex-part">
                                <img class="flex-icon" src="images/writing.png">
                                <p>Dodawanie ogłoszeń</p>
                            </div>
                            <div class="flex-part">
                                <img class="flex-icon" src="images/eye.png">
                                <p>Wyświetlanie ogłoszeń</p>
                            </div>
                            <div class="flex-part">
                                <img class="flex-icon" src="images/responsive.png">
                                <p>Responsywność strony</p>
                            </div>
                        </div>
                    </div>
                    <div class="box-2"></div>
                    <div class="box-4">
                        <div class="main-wrapper">
                            <h4>Na stronie znajdziesz ogloszenia z kategorii:</h4>
                            <div class="flex-sphere">
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/home.png">
                                    <p>Dom</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/work.png">
                                    <p>Praca</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/fashion.png">
                                    <p>Moda</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/sport.png">
                                    <p>Sport</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/animals.png">
                                    <p>Zwierzęta</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/electronic.png">
                                    <p>Elektronika</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/cultureandart.png">
                                    <p>Kultura i sztuka</p>
                                </div>
                                <div class="flex-part">
                                    <img class="flex-icon" src="images/categories/help.png">
                                    <p>Pomoc</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer>
                    <p>&copy;2022 Ekipa ZS3</p>
                </footer>
            </div>
        </div>
    </body>
</html>