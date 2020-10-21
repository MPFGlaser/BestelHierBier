<?php
    session_start();

    //For error viewing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('php/classes/userClass.php');
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
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                        echo "<form class='info' method='post'><button name='reset'>Logout</button></form>";
                        echo '<p class="info">Welkom '.$_SESSION["UserName"].'</p>';


                        if(isset($_POST['reset'])){
                            session_destroy();
                        }
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
                <?php
                    // //pakalles();
                    // $i = 0;
                    // while($i < 100){
                    //     echo '<div class="product">
                    //             <div class="productImage">
                    //                 <img src="images/tempProduct.png" alt="Temp Product"/>
                    //             </div>
                    //             <div class="productDescription">
                    //                 <p>Place lorem ipsum here...</p>
                    //             </div>
                    //             <div class="buttons">
                    //                 <button>Purchase</button>
                    //             </div>
                    //         </div>';
                    //     $i += 1;
                    // }

                    include('php/opendb.php');

                    try
                    {   
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM beers";
                        $sqlSent = $db->prepare($sql);
                        $sqlSent->execute();                 
                        $beers = $sqlSent->fetchAll(PDO::FETCH_ASSOC);

                        foreach($beers as $row)
                        {
                            $name = $row["name"];
                            $brewery = $row["brewery"];
                            $category = $row["category"];
                            $imgURL = $row["imageURL"];
                            $id = $row["id"];
    
                            ?>
                            <div class="product">
                            <div class="productImage">
                                <img src=/images/<?=$imgURL?> alt=<?=$name?>/>
                            </div>
                            <div class="productDescription">
                            <p><?=$name?></p><br>
                                <p><?=$category?> by <?=$brewery?></p>
                            </div>
                            <div class="buttons">
                                <button><a href="/product.php?id=<?=$id?>">Learn more</a></button>
                            </div>
                        </div>
                        <?php
                        }
                    
                    }
                    catch(PDOException $ex)
                    {
                        die("Error: ". $ex->getMessage());
                    }
                    
                ?>
            </div>
        </div>
    </body>
</html>