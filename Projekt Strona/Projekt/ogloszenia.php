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
        <link rel="stylesheet" href="styles/ogloszenia.css">
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
                    <div class="box-4">
                        <div class="main-wrapper">
                            <h4>Wybierz kategorię, lub przeglądaj wszystkie</h4>
                            <form action="ogloszenia.php" method="post">
                            <div class="flex-sphere">
                                <button name="filter" type="submit" value="Dom" class="flex-part">
                                    <img class="flex-icon" src="images/categories/home.png">
                                    <p>Dom</p>
                                </button>
                                <button name="filter" type="submit" value="Praca" class="flex-part">
                                    <img class="flex-icon" src="images/categories/work.png">
                                    <p>Praca</p>
                                </button>
                                <button name="filter" type="submit" value="Moda" class="flex-part"> 
                                    <img class="flex-icon" src="images/categories/fashion.png">
                                    <p>Moda</p>
                                </button>
                                <button name="filter" type="submit" value="Sport" class="flex-part">
                                    <img class="flex-icon" src="images/categories/sport.png">
                                    <p>Sport</p>
                                </button>
                                <button name="filter" type="submit" value="Zwierzęta" class="flex-part">
                                    <img class="flex-icon" src="images/categories/animals.png">
                                    <p>Zwierzęta</p>
                                </button>
                                <button name="filter" type="submit" value="Elektronika" class="flex-part">
                                    <img class="flex-icon" src="images/categories/electronic.png">
                                    <p>Elektronika</p>
                                </button>
                                <button name="filter" type="submit" value="Kultura i sztuka" class="flex-part">
                                    <img class="flex-icon" src="images/categories/cultureandart.png">
                                    <p>Kultura i sztuka</p>
                                </button>
                                <button name="filter" type="submit" value="Pomoc"class="flex-part">
                                    <img class="flex-icon" src="images/categories/help.png">
                                    <p>Pomoc</p>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-5">
                    <?php
                    function loadPost($article_data){
                        echo '
                        <article class="classic-post" id="article-'.$article_data["id_ogloszenia"].'">
                            <div class="left-section">
                                <div class="time-data">
                                    <p class="date">'.$article_data["data_utworzenia"].'</p>
                                    <p class="hour">'.$article_data["czas_utworzenia"].'</p>
                                </div>
                                <div class="username">
                                    <p>Dodane przez:</p> 
                                    <p>'.$article_data["autor"].'</p>
                                </div>
                            </div>
                            <div class="right-section">
                                <div class="upper-section">
                                    <div class="article-title">'.$article_data["tytul"].'</div>
                                    <div class="article-category">'.$article_data["kategoria"].'</div>
                                </div>
                                <div class="lower-section">
                                    <div class="article-text">
                                        <p>'.$article_data["tekst"].'...</p> 

                                        <form action="article.php" method="get">
                                            <button name="articleId" value='.$article_data["id_ogloszenia"].' type="submit">Czytaj dalej</button>
                                        </form>
                                    </div>
                                    <div class="article-image">
                                        <img src="images/'.$article_data["obraz"].'" alt="article image">
                                    </div>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </article>
                        ';
                    }
                    $connect = new mysqli('localhost','root','','ogloszenia48');
                    
                    $sql = "Select * from dane_ogloszen order by id_ogloszenia desc";
                    if(isset($_POST['filter'])){
                        $filtr = $_POST['filter'];
                        $sql = "Select * from dane_ogloszen where kategoria='".$filtr."' order by id_ogloszenia desc";
                        if(isset($_SESSION['ostatniFiltr'])){
                            if($filtr == $_SESSION['ostatniFiltr']){
                                $filtr = '';
                                $sql = "Select * from dane_ogloszen order by id_ogloszenia desc";
                            }
                        }
                        $_SESSION['ostatniFiltr'] = $filtr;
                    }

                    $zap = mysqli_query($connect,$sql);
        
                    while($wiersz = mysqli_fetch_array($zap)) 
                    {
                        loadPost($wiersz);
                    }
                    
                    mysqli_close($connect);
                    ?>
                    </div>
                </main>
                <footer>
                    <p>&copy;2022 Ekipa ZS3</p>
                </footer>
            </div>
        </div>
        <script>
            let clickedButton = '<?php echo $filtr;?>';

            let buttons = new Array();
            buttons = document.querySelectorAll('button[name="filter"]');
            
            buttons.forEach((element) => {
                if(element.value == clickedButton){
                    element.style.background = '#D9C296';
                }
                else{
                    if(element.style.background == '#D9C296'){
                        element.style.background == '#EDE5CE';
                    }
                }
            })

        </script>
    </body>
</html>