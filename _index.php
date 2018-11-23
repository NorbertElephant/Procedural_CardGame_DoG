<?php
session_start();

// Suppression de la Session
if(isset($_SESSION['Game'] ) ) {
    if(isset($_GET['del'] ) ) {
        unset($_SESSION['Game']);
        header('location:_index.php');
        exit;
    }
}
require('functions.php'); 
require('ini.php'); 
$MessageJouerCarte_Joueur1 ='';
$MessageJouerCarte_Joueur2 ='';

/*************************************************************************************************************************** */
        // ALGO DEBUT DE PARITE - Montrer Carte avec choix de jouer carte -  
/*************************************************************************************************************************** */

if(!isset($_SESSION['Game'])) {

    $_SESSION['Game']['Joueur1']= $Tab_Joueur;

    $_SESSION['Game']['Joueur2']= $Tab_Joueur_2;

    $_SESSION['Game']['SWAP'] = true;

    $_SESSION['Game']['Joueur1']['Jouer'] = Random_Player($_SESSION['Game']['Joueur1']['Jouer']);
    $_SESSION['Game']['Joueur2']['Jouer'] = First_Player($_SESSION['Game']['Joueur1']['Jouer'],$_SESSION['Game']['Joueur2']['Jouer']);

    Draw_early_game($_SESSION['Game']['Joueur1']['Jouer'],$_SESSION['Game']['Joueur1']['CartesMain'],$_SESSION['Game']['Joueur1']['Deck']);
    Draw_early_game($_SESSION['Game']['Joueur2']['Jouer'],$_SESSION['Game']['Joueur2']['CartesMain'],$_SESSION['Game']['Joueur2']['Deck']);

} 

if( isset($_POST['SwapJoueur_1'])) {
    if (isset($_POST['Joueur_1'])) {
        if($_SESSION['Game']['Joueur1']['Swap'] == true ){
            Swap ($_SESSION['Game']['Joueur1']['Deck'],$_SESSION['Game']['Joueur1']['CartesMain'],$_POST['Joueur_1'],$_SESSION['Game']['Joueur1']['Swap']);
        } 
    } else {
        $_SESSION['Game']['Joueur1']['Swap'] = false;
    }
}
if( isset($_POST['SwapJoueur_2'])) {
    if (isset($_POST['Joueur_2']) ) {
        if($_SESSION['Game']['Joueur2']['Swap'] == true ){
        Swap ($_SESSION['Game']['Joueur2']['Deck'],$_SESSION['Game']['Joueur2']['CartesMain'],$_POST['Joueur_2'],$_SESSION['Game']['Joueur2']['Swap']);
        }
    }else {
        $_SESSION['Game']['Joueur2']['Swap'] = false;
    }
}


/*************************************************************************************************************************** */
                                           // Algo FIN DE LA PARTIE  // 
/*************************************************************************************************************************** */
if( $_SESSION['Game']['Joueur2']['PV'] == 0 || $_SESSION['Game']['Joueur1']['PV'] == 0 ) {
    echo End_Of_Game($_SESSION['Game']['Joueur1']['PV'],$_SESSION['Game']['Joueur1']['CartesMain'],$_SESSION['Game']['Joueur1']['Board'], $_SESSION['Game']['Joueur2']['PV'],$_SESSION['Game']['Joueur2']['CartesMain'],$_SESSION['Game']['Joueur2']['Board']);
}
if (isset($_POST['Abandonner_J1'])) {
    echo Surrend($_SESSION['Game']['Joueur1']['NomJoueur'], $_POST['Abandonner_J1']);
}
if (isset($_POST['Abandonner_J2'])) {
    echo Surrend($_SESSION['Game']['Joueur2']['NomJoueur'],$_POST['Abandonner_J2']);
}


/*************************************************************************************************************************** */
                                            // Algo JOUER CARTES // 
/*************************************************************************************************************************** */
if(isset($_POST['JouerCarte_Joueur1']))  { 
    if( isset($_POST['JouerCarte'])) {
        Playing_Card( $_SESSION['Game']['Joueur1']['CartesMain'], $_SESSION['Game']['Joueur1']['NomJoueur'], $_SESSION['Game']['Joueur1']['Mana'], $_SESSION['Game']['Joueur1']['Board'], $MessageJouerCarte_Joueur1, $_POST['JouerCarte'],$_SESSION['Game']['Joueur2']['Board']);
    } else{
        echo 'Veuillez Sélectionner une Carte';
    }
}

if (isset($_POST['JouerCarte_Joueur2'])) {
    if( isset($_POST['JouerCarte']) ) {
        Playing_Card( $_SESSION['Game']['Joueur2']['CartesMain'], $_SESSION['Game']['Joueur2']['NomJoueur'], $_SESSION['Game']['Joueur2']['Mana'], $_SESSION['Game']['Joueur2']['Board'], $MessageJouerCarte_Joueur2, $_POST['JouerCarte'],$_SESSION['Game']['Joueur1']['Board']);
    } else{
        echo 'Veuillez Sélectionner une Carte';
    }
}


/*************************************************************************************************************************** */
                                           // Algo FIN DE TOUR  // 
/*************************************************************************************************************************** */

if(isset($_POST['FinDeTour'])) {
    if ($_SESSION['Game']['Joueur1']['Jouer'] == false) {
        End_Of_Turn( $_SESSION['Game']['Joueur1']['Jouer'],$_SESSION['Game']['Joueur1']['ManaMax'],$_SESSION['Game']['Joueur1']['Mana'], $_SESSION['Game']['Joueur1']['CartesMain'],$_SESSION['Game']['Joueur1']['Deck'],  $_SESSION['Game']['Joueur2']['Board'],$_SESSION['Game']['Joueur2']['Jouer']);
    } else {
        End_Of_Turn( $_SESSION['Game']['Joueur2']['Jouer'],$_SESSION['Game']['Joueur2']['ManaMax'],$_SESSION['Game']['Joueur2']['Mana'], $_SESSION['Game']['Joueur2']['CartesMain'], $_SESSION['Game']['Joueur2']['Deck'], $_SESSION['Game']['Joueur1']['Board'],$_SESSION['Game']['Joueur1']['Jouer']);
    }
} 


/*************************************************************************************************************************** */
                                           // Algo ATTAQUE // 
/*************************************************************************************************************************** */


if(isset($_POST['Attaque_Joueur1']) && isset($_POST['Board']))  { 
        Attack( $_SESSION['Game']['Joueur1']['NomJoueur'], $_SESSION['Game']['Joueur1']['Jouer'] ,$_SESSION['Game']['Joueur1']['Board'], $_POST['Board'], $_POST['Attaque'], $_SESSION['Game']['Joueur2']['PV'], $_SESSION['Game']['Joueur2']['Board']);
    } 

if (isset($_POST['Attaque_Joueur2']) && isset($_POST['Board'])) {
        Attack( $_SESSION['Game']['Joueur2']['NomJoueur'], $_SESSION['Game']['Joueur2']['Jouer'] ,$_SESSION['Game']['Joueur2']['Board'], $_POST['Board'], $_POST['Attaque'], $_SESSION['Game']['Joueur1']['PV'], $_SESSION['Game']['Joueur1']['Board']);
    } 



?> 
<!-- /*************************************************************************************************************************** */ !--> 
<!-- /*************************************************************************************************************************** */ !--> 
<!-- /*************************************************************************************************************************** */ !--> 
                                           <!-- Algo Principal avec Affichage ! --> 
<!-- /*************************************************************************************************************************** */ !--> 
               
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="./asset/css/main.css" rel="stylesheet">
        <title>Duel Of Giants | Cut The Cook </title>
    </head>

    <body>
           
    <form method="POST" action=""> 

<!--....................... Héro du player 1.................................... !--> 

    <div class='flex-center'>
        <div class='Hero' >  
            <img src="./asset/image_jeu/heros-maiev.png" alt="">
        </div>
        <div class='PV'> 
                <?php echo $_SESSION['Game']['Joueur1']['PV']; ?>
        </div>
    </div>
<!--....................... Carte De La Main Du Joueur 1.................................... !--> 
        <div>
            <hr>    
            <h2>Cartes en Main du Joueur 1  </h2>
            <hr>
        </div>
        <div style="display:flex; flex-direction: row">
            <?php 
                if ( $_SESSION['Game']['Joueur1']['Swap'] === true) {
                    echo Show_card_image_Swap($_SESSION['Game']['Joueur1']['CartesMain'],$_SESSION['Game']['Joueur1']['NomJoueur'] );
                } else {
                    echo Show_card_image($_SESSION['Game']['Joueur1']['CartesMain'],$_SESSION['Game']['Joueur1']['NomJoueur']); // Montrer les Cartes dans la Main 
                }
                 
            ?> 

            <hr>
        </div>
      

 <!--.................. Mana Restant Par Tour Chiffre Et Image Joueur n°1.................................... !--> 
        <div>
            <?php
                echo $_SESSION['Game']['Joueur1']['Mana'] ." / ". $_SESSION['Game']['Joueur1']['ManaMax'];
            ?>
        </div>
        <div>
            <?php
                Show_Mana_Image($_SESSION['Game']['Joueur1']['Mana'],$_SESSION['Game']['Joueur1']['ManaMax'])
            ?>
        </div>
        
<!--.................. Board Du Joueur n°1.................................... !--> 
    <div>
        <hr>
        <h2> Board du Joueur 1 </h2>
        <hr>
    </div>
    <div style="display:flex; flex-direction: row">
        <?php 
             echo Show_card_image_Board($_SESSION['Game']['Joueur1']['Board'],$_SESSION['Game']['Joueur1']['NomJoueur'],$_SESSION['Game']['Joueur1']['Jouer']); 
        ?> 

        <hr>
    </div>

<!--.................. Bouton Pour Jouer Carte.................................... !--> 
    <?php 
        if($_SESSION['Game']['Joueur1']['Jouer'] == true) {
            
            echo '
            <div style="background:#C0C0C0">
                <h2> Boutons du Joueur 1 </h2>
                <div class="content-btn">
                    <button name="Abandonner_J1" type="submit" class="btn btn-primary red" >
                                    Abandonner La Partie
                    </button> 
                 </div> 
                <div class="content-btn">
                    <button name="JouerCarte_Joueur1" type="submit" class="btn btn-primary">
                        Jouer la carte 
                    </button> 
                </div>
                    ';
                if(count($_SESSION['Game']['Joueur2']['Board']) >0 && Card_Can_Attack($_SESSION['Game']['Joueur1']['Board']) == true){
                    echo  '
                    <select name ="Attaque">
                    '. Cards_To_Attack($_SESSION['Game']['Joueur2']['Board']) .'
                    </select> 
                    <div class="content-btn">
                        <button name="Attaque_Joueur1" type="submit" class="btn btn-primary">
                            Attaquer
                        </button>
                    </div>  
            </div>
                ';
            }
            echo'    
            
                <div> 
                    <?php 
                        echo $MessageJouerCarte_Joueur1;
                    ?>
                </div>
            </div> 
            ';}
        ?>


 <!--.................. Bouton Fin De Tour.................................... !--> 
        <div style='background: #ccc ;border: solid 3px #000; border-bottom:none;'>
            <div style='height:50px;'></div>
            <button  name="FinDeTour" type="submit" class="btn btn-primary" >
                    Fin De Tour 
            </button>
        </div>
            
    </form> 

 <!--......................................................................................... !--> 
        
        <div style="background: #ccc; vertical-align:center; border: solid 3px #000; border-top:none;">
            <h2 style="display: inline-block; padding-left:50%;">JE SUIS LA ZONE NEUTRE :O </h2>
        </div>

  <!--......................................................................................... !--> 

<!--.................. Bouton Pour Jouer Carte.................................... !--> 
    <form method="POST" action=""> 
        <?php 
            if($_SESSION['Game']['Joueur2']['Jouer'] == true) {
        
                echo '
                <div style="background:#C0C0C0">
                    <h2>  Boutons du Joueur 2  </h2>
                    <div class="content-btn">
                        <button name="Abandonner_J2" type="submit" class="btn btn-primary red" >
                                        Abandonner La Partie
                        </button> 
                    </div>  
                    <div style="display: inline-block">
                        <div class="content-btn" >
                            <button name="JouerCarte_Joueur2" type="submit" class="btn btn-primary">
                                Jouer la carte 
                            </button> 
                        </div>
                        ';
                    if(count($_SESSION['Game']['Joueur2']['Board']) >0 && Card_Can_Attack($_SESSION['Game']['Joueur2']['Board']) == true){
                        echo  '
                        <select name ="Attaque">
                            '. Cards_To_Attack($_SESSION['Game']['Joueur1']['Board']) .'
                        </select> 
                        <div class="content-btn" >
                            <button name="Attaque_Joueur2" type="submit" class="btn btn-primary">
                                Attaquer
                            </button>
                        </div>
                        ';
                    }
                    echo ' 
                    
                        <div> 
                            <?php 
                                echo $MessageJouerCarte_Joueur1;
                            ?>
                        </div>
                    </div> 
                </div>
                ';}
            ?>


<!--.................. Board Du Joueur n°2.................................... !--> 
   
        <div>
                <hr>
                <h2> Board du Joueur 2 </h2>
                <hr>
            </div>
            <div style="display:flex; flex-direction: row">
                <?php 
                    echo Show_card_image_Board($_SESSION['Game']['Joueur2']['Board'],$_SESSION['Game']['Joueur2']['NomJoueur'],$_SESSION['Game']['Joueur2']['Jouer']); 
                ?> 

                <hr>
            </div>
        <!--.................. Mana Restant Par Tour Chiffre Et Image Joueur n°2.................................... !--> 
            <div>
                <?php
                    echo $_SESSION['Game']['Joueur2']['Mana'] ." / ". $_SESSION['Game']['Joueur2']['ManaMax'];
                ?>
            </div>
            <div>
                <?php
                    Show_Mana_Image($_SESSION['Game']['Joueur2']['Mana'],$_SESSION['Game']['Joueur2']['ManaMax'])
                ?>
            </div>
        <!--....................... Carte De La Main Du Joueur n°2.................................... !--> 
        <div>
                    <hr>    
                    <h2>Cartes en Main du Joueur 2  </h2>
                    <hr>
                </div>
                <div style="display:flex; flex-direction: row">
                <?php 
                         if ( $_SESSION['Game']['Joueur2']['Swap'] === true) {
                            echo Show_card_image_Swap($_SESSION['Game']['Joueur2']['CartesMain'],$_SESSION['Game']['Joueur2']['NomJoueur']);
                        } else {
                            echo Show_card_image($_SESSION['Game']['Joueur2']['CartesMain'],$_SESSION['Game']['Joueur2']['NomJoueur']); // Montrer les Cartes dans la Main 
                        }
                    ?> 

                    <hr>
                </div>
        

        </form>

        <!--....................... Héro du player 2.................................... !--> 

        <div class='flex-center'>
            <div class='Hero' >  
                <img src="./asset/image_jeu/heros-maiev.png" alt="">
            </div>
            <div class='PV'> 
                <?php echo $_SESSION['Game']['Joueur2']['PV']; ?>
            </div>
        </div>
        
    





<?php 

// var_dump($_SESSION['Game']['Joueur1']);
// var_dump($_SESSION['Game']['Joueur2']);
    
    
    
    echo '<a href="?del">Delete Session</a>';
?>

    </body> 

</html>  