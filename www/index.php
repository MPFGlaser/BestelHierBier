<?php
    session_start();
    include('php/classes/user.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bestel Hier Bier</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
    </head>
    <body>
        <div class="grid-container-top">
            <div class="grid-item">
                <img src="images/tempLogo.png" alt="Temp Logo"/>
            </div>
            <div class="grid-item-top">
                <p id="title">Bestel Hier Bier</p>
            </div>
            <div class="grid-item-top">
                <?php
                    if($_SESSION['login'] === true){
                        // echo '<p class="info">Welkom '.$user->get_name().'</p>';
                        echo var_dump($GLOBALS);
                        echo '<p class="info">Welkom '.$_SESSION["UserName"].'</p>';
                    }else{
                        echo '<a href="/login.php" class="loginBtn">Login/Register</a>';
                    }
                ?>
            </div>
        </div>
        <div class="mobileLogo">
            <img src="images/tempLogo.png" alt="Temp Logo"/>
        </div>
        <br/>
        <div class="div-container-content">
            <div class="grid-item-content">
                <div class="filterMenu">
                    <input placeholder="Search"></input>
                    <button>Search</button>
                    </br>
                    <p>Price</p>
                    <input type="range" min="1" max="100" value="50">
                    </br>
                    <p>Score</p>
                    <input type="range" min="1" max="5" value="3">
                    </br>
                    <p>Category</p>
                    <input type="checkbox" name="Blond">
                    <label for="Blond">Blond</label></br>
                    <input type="checkbox" name="Dark">
                    <label for="Dark">Dark</label></br>
                    <input type="checkbox" name="Triple">
                    <label for="Triple">Triple</label></br>
                    <input type="checkbox" name="Quadruple">
                    <label for="Quadruple">Quadruple</label></br>
                    <input type="checkbox" name="IPA">
                    <label for="IPA">IPA</label></br>
                </div>
            </div>
            <div class="foundItems">
                <div class="product">
                    <div class="productImage">
                        <img src="images/tempProduct.png" alt="Temp Product"/>
                    </div>
                    <div class="productDescription">
                        <p>Place lorem ipsum here...</p>
                    </div>
                    <div class="buttons">
                        <button>Purchase</button>
                    </div>
                </div>
                <div class="product">
                    <div class="productImage">
                        <img src="images/tempProduct.png" alt="Temp Product"/>
                    </div>
                    <div class="productDescription">
                        <p>Place lorem ipsum here...</p>
                    </div>
                    <div class="buttons">
                        <button>Purchase</button>
                    </div>
                </div>
                <div class="product">
                    <div class="productImage">
                        <img src="images/tempProduct.png" alt="Temp Product"/>
                    </div>
                    <div class="productDescription">
                        <p>Place lorem ipsum here...</p>
                    </div>
                    <div class="buttons">
                        <button>Purchase</button>
                    </div>
                </div>
                <div class="product">
                    <div class="productImage">
                        <img src="images/tempProduct.png" alt="Temp Product"/>
                    </div>
                    <div class="productDescription">
                        <p>Place lorem ipsum here...</p>
                    </div>
                    <div class="buttons">
                        <button>Purchase</button>
                    </div>
                </div>
                <div class="product">
                    <div class="productImage">
                        <img src="images/tempProduct.png" alt="Temp Product"/>
                    </div>
                    <div class="productDescription">
                        <p>Place lorem ipsum here...</p>
                    </div>
                    <div class="buttons">
                        <button>Purchase</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        //Temp to test login/register
        echo "<form method='post'><button name='reset'>Reset Session</button></form>";
        if(isset($_POST['reset'])){
            session_destroy();
        }
        ?>
    </body>
</html>
