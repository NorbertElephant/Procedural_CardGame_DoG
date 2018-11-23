<?php 
define("CARD_MAX_BOARD", 7);
define("CARD_MAX_HAND", 10);
define("MANA_MAX", 10);
define("GAIN_MANA_TURN", 1);
define("EARLY_NUM_CARD", 3);

/***************************************************************************************************** */
                                            // Functions  FIN DE PARTIE // 
/***************************************************************************************************** */
/**
 * Fin De La Partie........................... Condition de Victoire pour la fain de la partie 
 *
 * @param int $HP_Player1..................... Point de Vie Joueur_1
 * @param array $Hand_Player1................. Cartes en Mains Joueur_1
 * @param array $Board_Player1................ Cartes sur le Board Joueur_1
 * @param int $HP_Player2..................... Point de Vie Joueur_2
 * @param array $Hand_Player2................. Cartes en Mains Joueur_2
 * @param array $Board_Player2................ Cartes sur le Board Joueur_2
 * @return string $Win ....................... Texte de Victoire
 */
function End_Of_Game ( int $HP_Player1, array $Hand_Player1 , array $Board_Player1, int $HP_Player2, array $Hand_Player2 , array $Board_Player2) {
    if($HP_Player1 <= 0 ){
        return $win = 'Le Joueur 2 a gagné la Partie';
    }elseif (empty($Hand_Player1) && empty($Board_Player1) ) {
        return $win = 'Le Joueur 2 a gagné la Partie';
    }

    if($HP_Player2 <= 0 ){
        return $win = 'Le Joueur 1 a gagné la Partie';
    }elseif (empty($Hand_Player2) && empty($Board_Player2) ) {
        return $win = 'Le Joueur 1 a gagné la Partie';
    }
    return  false;
}

/**
 * Surrend................................. Qui abandonne 
 *
 * @param string $Player_Surrend........... Nom du Joueur qui Abandonne
 * @return string $gagner.................. Message de Victoire
 */
function Surrend ( string $Player_Surrend) {
    if($Player_Surrend == 'Joueur_1') {
        return $gagner ='Joueur 2 a gagné par abandon du Joueur 1';
    }
    if($Player_Surrend == 'Joueur_2') {
        return $gagner ='Joueur 1 a gagné par abandon du Joueur 2';
    }
}




/*********************************************************************************************** */
                                            // Functions  DEBUT DE LA PARTIE  // 
/************************************************************************************************ */
/**
 * First_Player......................... Connaitre le premier Joueur 
 *
 * @param boolean $Player1...............  Si c'est au Tour du Joueur 1
 * @param boolean $Player2................ Conséquence du Tour du Joueur 1
 * @return string
 */
function First_Player (bool $Player1, bool $Player2) {
    if ($Player1 == true) {
         return $Player2 == false; 
    } else {
        return $Player2 == true;
    }
}
/**
 * Random_Player..................... Choisir Aléatoirement si le Joueur 1 doit jouer en Premier ou non.
 *
 * @param boolean $Player1........... Connaitre si le joueur doit jouer ou non
 * @return bool $Player1............. Oui / Non
 */
function Random_Player (bool &$Player1) {
    $Player1 = (bool) mt_rand(0,1);
    boolval($Player1);
    return $Player1;
}

/*********************************************************************************************** */
                                            // Functions  SWAP  // 
/************************************************************************************************ */

/**********************Functions SWAP ********************************************/

/**
 * Swap............................. Fonction de début de jeu permettant de choisir 0 a 3 cartes de la main pour les remettres dans le deck et en repiocher le nombres remis dans le decks
 *
 * @param array $Deck.................................. Deck du Joueur
 * @param array $Cards_In_Hand......................... Main du Joueur
 * @param array $Selection............................. La ou les cartes selectionées 
 * @param I/O boolean $Swap ........................... Possibilité de faire que un Swap par game
 * @return boolean $Swap .............................. Changement de la variable swap pour ne pas refaire la fonction
 */
function Swap( array &$Deck, array &$Cards_In_Hand, array $Selection, bool &$Swap ){

    $number = count($Selection);

    #Remettre les cartes dans le Deck et unset de la main
    foreach ($Selection as $key => $element) {
        foreach ($Cards_In_Hand as $key_Carte => $carte) { 
            $verif = in_array( $element,$carte);
            if ($verif == true ){ /// Quand BDD prendre la Clé Id Carte
                array_push($Deck,$Cards_In_Hand[$key_Carte] ); 
                unset($Cards_In_Hand[$key_Carte]);
            }
        }
    }

    shuffle($Cards_In_Hand);
    #Re-piocher le nombre de cartes défausser 
    for ($i=0; $i < $number ; $i++) { 
        Draw($Cards_In_Hand, $Deck);
    }

    return $Swap = false;
}



/*************************************************************************************************** */
                                            // Functions  PIOCHE // 
/*************************************************************************************************** */
/**
 * Pioche_early_game.............................. Permet de Piocher Selon l'ordre de Jeux des Joueurs
 *
 * @param boolean $First_Player................... Connaitre si c'est le premier joueur
 * @param I/O array $Cards_In_Hand................ La main du joueur
 * @param I/O array $Deck......................... Le deck du juoeur
 * @return void
 */
function Draw_Early_Game(bool $First_Player, array &$Cards_In_Hand, array &$Deck ){
    if($First_Player== true){
        for ($i=0; $i < EARLY_NUM_CARD ; $i++) { 
            Draw($Cards_In_Hand,$Deck);
        }
    } else {
        for ($i=0; $i < (EARLY_NUM_CARD + 1) ; $i++) { 
            Draw($Cards_In_Hand,$Deck);
        }
    }
}

/** Draw................................ Permet de Piocher une carte à la fois 
 * 
 * @param I/O array $Cards_In_Hand........ Main du Joueur
 * @param I/O array $Deck................. Deck du Joueur
 * @return void
 */

function Draw(array &$Cards_In_Hand, array &$Deck){
    if(count($Deck) > 0 ){
        shuffle($Deck);
        if (count($Cards_In_Hand) < CARD_MAX_HAND && count($Deck) > 0 ) {
            array_push($Cards_In_Hand,$Deck[0]);
            unset($Deck[0]);
        } else {
            unset($Deck[0]);
        }
    }
}

/***************************************************************************************************** */
                                            // Functions  MONTRER IMAGE CARTE // 
/***************************************************************************************************** */

/**
 * Show_card_image_Swap........................ Montrer le visuel de la carte pour la Fonction Swap (changer des cartes au début de la game) 
 *
 * @param array $Cards_In_Hand................. Main du Joueur
 * @param string $Player_Name.................. Nom du Joueur
 * @return string $str......................... Retourne le HTML pour afficher les cartes pour le Swap
 */
function Show_card_image_Swap(array $Cards_In_Hand, string $Player_Name){
    $str ='<div style="flex-direction:row; background:#F5F5DC"> <h2> Phase de Changement de Carte <br> vous pouvez selectionner les cartes que vous voulez changer </h2> </div>';
    if(count($Cards_In_Hand) > 0 ){
        foreach ($Cards_In_Hand as  $key => $carte) {
           $str .=  '<div style="flex-direction:row; background:#F5F5DC">
                    <input type="checkbox" name="' . $Player_Name .'[]" id="'.$Player_Name.$key .'" value='.$carte['NomCarte'] . '>
                    <label for="'. $Player_Name.$key .'"><img src="'.$carte['URL'].'"/> </label> </div>  ';
        }
    } 
    $str .= '<div class="content-btn" >
                <button name="Swap'.$Player_Name.'" type="submit" class="btn btn-primary">
                    Valider 
                </button> 
            </div>' ;
    return $str;  
}

/**
 * Show_card_image...........................Montrer le visuel des cartes en Main
 *
 * @param array $Cards_In_Hand.............. Main du Joueur
 * @param string $Player_Name............... Nom du Joueur
 * @return string $str...................... Retourne le HTML pour afficher les cartes dans la Main
 */
function Show_card_image(array $Cards_In_Hand, string $Player_Name){
    $str ='';
    if(count($Cards_In_Hand) > 0 ){
        foreach ($Cards_In_Hand as  $key => $carte) {
           $str .=  '<div style="flex-direction:row">
                    <input type="radio" name="JouerCarte" id="'.$Player_Name.$key .'" value='.$Player_Name.$key . '>
                    <label for="'. $Player_Name.$key .'"><img src="'.$carte['URL'].'"/> </label> </div>  ';
        }
    } 
    return $str;  
}

/**
 * Show_card_image_Board...................  Montrer le visuel d'une carte Sur le Board
 *
 * @param array $Card_In_Board.............. Board du Joueur
 * @param string $Player_Name............... Nom du Joueur
 * @return string $str...................... Retourne le HTML pour afficher les cartes sur le Board
 */
function Show_card_image_Board(array $Card_In_Board, string $Player_Name, bool $Play_Player_Turn){
    $str ='';
    if(count($Card_In_Board) > 0 ){
        foreach ($Card_In_Board as  $key => $carte) {
            $str .= '<div style="flex-direction:row">';

            if ($Card_In_Board[$key]['Etat'] == true && $Play_Player_Turn == true ){
                $str .=  '<input type="radio" name="Board" id="'.$Card_In_Board[$key]['NomCarte'].$key .'" value='.$Player_Name.$key . '>';
            } 
            
            $str .= '<label for="'. $Card_In_Board[$key]['NomCarte'].$key .'"><img src="'.$carte['URL'].'"/> </label> </div>  
                    <div>
                        <h3> PA : '. $Card_In_Board[$key]['PA'] .'</h3>
                        <h3> PV : '. $Card_In_Board[$key]['PV'] .'</h3>
                        <h3> Nom De la Carte : '. $Card_In_Board[$key]['NomCarte'] .'</h3>
                    </div>
                    ';
        }
    } 
    return $str;  
}

/**************************************************************************************************** */
                                            // Functions  MONTRER MANA  // 
/**************************************************************************************************** */
/**
 * Show_Mana_Image........................ Montrer les Mana restants (vide et pleins) en Image sur le Plateau
 *
 * @param integer $Mana................... Mana restant du Joueur
 * @param integer $Mana_Max............... Mana Max du Joueur
 * @return void
 */
function Show_Mana_Image(int $Mana, int $Mana_Max){
    if($Mana > 0 ){
        for ($i=1; $i <= $Mana ; $i++) { 
            echo'<img src="../projet_03w/image_jeu/mana-pleins.png" alt="Picto_Mana" />';
        }
    }
    $Mana_Vide = $Mana_Max - $Mana; 
    if($Mana_Vide > 0){
        for ($i=0; $i <  $Mana_Vide ; $i++) { 
            echo'<img style="opacity:0.5" src="../projet_03w/image_jeu/mana-pleins.png" />';
        }
    }
}



/*************************************************************************************************** */
                                            // Functions  JOUER CARTE // 
/*************************************************************************************************** */
/**
 * Playing_Card......................................... Jouer une carte créature ou Sort 
 *
 * @param I/O array $Cards_In_Hand...................... Carte en Main du Joueur
 * @param string $Player_Name........................... Nom du Joueur
 * @param I/O integer $Mana............................. Mana du Joueur
 * @param I/O array $Board_Player....................... Board du Joueur
 * @param string $Message_Play_Card..................... Message de confirmation s'il a jouer la carte ou non
 * @param sting $Check.................................. $Post de la carte pour vérification de la carte jouer
 * @param I/O array $Player_ADV_Board................... Board adverse utile pour la Carte sort
 * @return string $Message_Play_Card.................... Retour Message de confirmation s'il a jouer la carte ou non
 */
function Playing_Card (array &$Cards_In_Hand, string $Player_Name, int &$Mana, array &$Board_Player, string $Message_Play_Card,string $Check, array &$Player_ADV_Board){
    foreach ($Cards_In_Hand as $key =>$value) { // Arrivage du Nom de la Carte à Jouer comparaison pour savoir quel est la clé dans le tableau pour sortir la carte de a Main 
        // echo $Joueur['NomJoueur'].$key;
        if( ($Player_Name.$key) == $Check  ){
            // Lancer Un Sort  // 
            if($Cards_In_Hand[$key]['TypeDeCarte'] == 'Sort'){ // Lancer Un Sort 
                if (Play_Spell_Card($Cards_In_Hand[$key],$Mana) == true) {

                    Play_Spell_Attack_Area($Cards_In_Hand[$key], $Player_ADV_Board); // Sort De Dégats De Zone
                    #Si on veut faire plusieurs types de sort juste a faire un switch et envoyé sur la fonction désiré ! 
                    unset($Cards_In_Hand[$key]);

                   return $Message_Play_Card = 'Vous avez joué la carte !';
                    
                } else {
                    return $Message_Play_Card = 'Vous n\'avez pas assez de mana pour jouer cette carte ';
                }
            } else {
            // Jouer Une Carte Créature ou Spéciale //
                if (Play_Creature_Card($Cards_In_Hand[$key],$Mana,$Board_Player) == true) { 
                
                    unset($Cards_In_Hand[$key]);

                    return  $Message_Play_Card = 'Vous avez joué la carte !';
                } else {
                     return $Message_Play_Card = 'Vous n\'avez pas assez de mana pour jouer cette carte ';
                }
            }
        }
    }
};

/**********************Functions JOUER CARTE CREATURE ET SORT ********************************************/

/**
 * Play_Creature_Card............ S'il est possible de Jouer la carte Creature ou non selon le Mana du Joueur
 *
 * @param I/O array $Card_Playing....................... La Carte Creature qui doit être Jouée
 * @param I/O integer $Mana_Player...................... Mana du Joueur
 * @param I/O array $Board_Player....................... Board du Joueur
 * @return bool......................................... Oui / Non
 */
function Play_Creature_Card( array &$Card_Playing, int &$Mana_Player, array &$Board_Player){
        if( $Mana_Player >= $Card_Playing['CoutMana']) {
            $Mana_Player -= $Card_Playing['CoutMana'];
            array_push($Board_Player, $Card_Playing); 
        
            return true;
        } 
    return false; 
}
/**
 * Play_Spell_Card.......................... S'il est possible de Jouer la carte Sort ou non selon le Mana du Joueur
 *
 * @param I/O array $Card_Playing....................... La Carte Sort qui doit être Jouée
 * @param I/O integer $Mana_Player...................... Mana du Joueur
 * @param I/O array $Board_Player....................... Board du Joueur
 * @return bool......................................... Oui / Non
 */
function Play_Spell_Card( array &$Card_Playing, int &$Mana_Player){
    if( $Mana_Player >= $Card_Playing['CoutMana'] ) {
        $Mana_Player -= $Card_Playing['CoutMana'];    
        return true;
    } 
return false; 
}




/***************************************************************************************************** */
                                            // Functions  FIN DE TOURS // 
/***************************************************************************************************** */

/**
 * End_Of_Turn............................................... Action lors de Fin De Tour Joueur
 *
 * @param I/O Bool $Play_Player_Turn............................. Son Tour de Jouer Oui/Non
 * @param I/O integer $Mana_Max_Player........................... Mana Max du Joueur pour l'incrémenter
 * @param I/O integer $Mana_Player............................... Mana Rénitialisé du Joueur
 * @param I/O array $Cards_In_Hand_Player........................ Main du Joueur
 * @param I/O array $Deck_Player................................. Deck du Joueur
 * @param I/O array $Board_Player................................ Board du Joueur pour "réveiller" les créatures
 * @param I/O Bool $Play_Player2_Turn............................ Dire que c'est a Joueur Adverse lors du prochain FIn de Tour
 * @return Bool $Play_Player2_Turn............................... Dire que c'est a Joueur Adverse lors du prochain FIn de Tour
 */
function End_Of_Turn (Bool &$Play_Player_Turn, int &$Mana_Max_Player,int &$Mana_Player, array &$Cards_In_Hand_Player, array &$Deck_Player, array &$Board_Player2, Bool &$Play_Player2_Turn) {

    if ($Play_Player2_Turn == true) {
        if( $Mana_Max_Player < MANA_MAX ){
            $Mana_Max_Player += GAIN_MANA_TURN; // +1 Mana Max
        }
    
        $Mana_Player = $Mana_Max_Player; // Reset Mana du Début de Tours
    
        echo  Draw($Cards_In_Hand_Player,$Deck_Player); // Fonction qui permet de Piocher une carte Si possible  

        Wake_Attack_Cards($Board_Player2); // Réveil des Créatures Lors Du Tour du Joueur

        $Play_Player_Turn = true;

        return $Play_Player2_Turn = false;

    } 
}


/***************************************************************************************************** */
                                            // Functions  ATTAQUE // 
/***************************************************************************************************** */
/**
 * Attack......................................................... Attack Soit Le Héro adverse soit une créature
 *
 * @param string $Player_Name_ATK................................. Nom du Joueur qui attaque
 * @param boolean $Player_play_ATK................................ Si c'est le tour du joueur qui attaque
 * @param I/O array $Board_Player_ATK............................. Board du joueur qui attque 
 * @param string $Check_Card_ATK.................................. $_POST --- Carte qui attaque 
 * @param string $Check_DFS....................................... $_POST --- Héro ou carte qui défends
 * @param I/O integer $HP_Player_DFS.............................. Point de Vie du Héro qui défends
 * @param I/O array $Board_Player_DFS............................. Board du joueur qui défends
 * @return void
 */
function Attack ( string $Player_Name_ATK, bool $Player_play_ATK,array &$Board_Player_ATK,string  $Check_Card_ATK,string $Check_DFS, int &$HP_Player_DFS , array &$Board_Player_DFS){

    for ($i=0; $i < CARD_MAX_BOARD  ; $i++) {  // CARTE_MAX_BOARD est une constante = 7
        if($Player_Name_ATK.$i == $Check_Card_ATK )  { // Connaitre la Carte qui attaque 
            if($Player_play_ATK == true){ // Si c'est bien au bon joueur de Jouer 

                if($Check_DFS == 'hero'){ // Attaque Sur Le Héro Adverse
                $HP_Player_DFS -= $Board_Player_ATK[$i]['PA'];
                $Board_Player_ATK[$i]['Etat'] = false ;

                } else { // Attaque Sur La Carte Adverse

                    foreach ($Board_Player_DFS as $key => $carte) {
                        if($carte['NomCarte'] .$key == $Check_DFS) {
        
                            $Board_Player_DFS[$key]['PV'] -= $Board_Player_ATK[$i]['PA']; 
        
                            $Board_Player_ATK[$i]['PV'] -= $Board_Player_DFS[$key]['PA'];
                            
                            $Board_Player_ATK[$i]['Etat'] = false ;

                            if($Board_Player_ATK[$i]['PV'] <= 0) {
                                unset($Board_Player_ATK[$i]); 
                            } 
                            if ($Board_Player_DFS[$key]['PV'] <= 0) {
                                unset($Board_Player_DFS[$key]); 
                            }                           
                        } 
                    }
                }
            }
        }
    }
}

/**
 * Play_Spell_Attack_Area........................................ Fonction pour les Cartes Sort qui ont un Effet sur TOUT le Board Adverse
 *
 * @param I/O array $Spell_Card.................................. Carte Sort qui est jouée
 * @param I/O array $Board_Player_DFS............................ Board du Joueur Adverse
 * @return void
 */
function Play_Spell_Attack_Area( array &$Spell_Card, array &$Board_Player_DFS ){
    
    foreach ($Board_Player_DFS as $key => $value) {

            $Board_Player_DFS[$key]['PV'] -= $Spell_Card['PA']; 

            if ($Board_Player_DFS[$key]['PV'] <= 0) {
                unset($Board_Player_DFS[$key]); 
        }
    }
}

/**********************Functions MONTRER CARTE A ATTAQUER ********************************************/


/**
 * Carte_A_Attaquer................................. Montre les cartes que le joueurs peut attaquer
 *
 * @param array $Board_Player_DFS................... Board Du Joueurs Adverse
 * @return void
 */
function Cards_To_Attack( array $Board_Player_DFS){
    $str = '';
    if (Taunt($Board_Player_DFS) != ''){
        return Taunt($Board_Player_DFS);
    } else {
        foreach ($Board_Player_DFS as $key => $value) {
        
            $str .= '
            <option value='.$Board_Player_DFS[$key]['NomCarte'] .$key .'> ' . $Board_Player_DFS[$key]['NomCarte'] . ' </option>
            ';
        }
    }
    $str .= '
    <option value="hero"> Héro </option>
    ';
    return $str;
}

/**
 * Taunt.......................................... Connaitre S'Il Y A Des Provocations Dans Les Créatures Sur le Board
 *
 * @param array $Board_Player_DFS................. Board Du Joueurs Adverse
 * @return void
 */
function Taunt(array $Board_Player_DFS) {
    $str ='';
    foreach ($Board_Player_DFS as $key => $value) {
        if ($Board_Player_DFS[$key]['Bouclier'] == true ) {
        $str .= '
        <option value='.$Board_Player_DFS[$key]['NomCarte'] .$key.'> ' . $Board_Player_DFS[$key]['NomCarte'] . ' </option>
        ';
        }
    }
    return $str;
}

/**********************Functions MONTRER CARTE QUI PEUT ATTAQUER  ********************************************/

/**
 * Wake_Attack_Cards........................... Reveiller les cartes attaques du Joueurs
 *
 * @param I/O array $Board_Player.............. Réveiller les Cartes du Board  
 * @return void
 */
function Wake_Attack_Cards(&$Board_Player) { 
    foreach ($Board_Player as $key=>$value) {
        $Board_Player[$key]['Etat'] = true ;
    }
}

/**
 * Card_Can_Attack.............................. Montrer le Bouton Attque que si une carte peut attaquer
 *
 * @param array $Board_Player................... Les cartes qui sont sur le Board pour attaquer
 * @return Boolean
 */
 function Card_Can_Attack(array $Board_Player) {
     foreach ($Board_Player as $key => $carte) {
        if($carte['Etat'] == true) {
            return true;
        }
     }
     return false;
 }

