<?php

// Exemple de Joueur pour faire des Test 
$Tab_Joueur = array(
    'NomJoueur' => 'Joueur_1',
    'PV' => 20,
    'CartesMain' => array(),
    'ManaMax' => 8,
    'Mana' => 8, 
    'Deck' => array(  
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_1',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_2',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => true),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_3',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array (    'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_4',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                 array (     'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_5',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array (     'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_6',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),          
                array (    'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_7',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array (     'URL' =>'./asset/image_jeu/HS.png',
                                'NomCarte' => 'NomDeLaCarte_8',
                                'TypeDeCarte' => 'Creature',
                                'PV' => 3,
                                'PA' => 3,
                                'CoutMana' =>5,
                                'Etat' =>false,
                                'Bouclier' => false),
                array (     'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_9',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false), 
                array (    'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_10',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array (     'URL' =>'./asset/image_jeu/HS-special.png',
                                'NomCarte' => 'NomDeLaCarte_11',
                                'TypeDeCarte' => 'Special',
                                'PV' => 3,
                                'PA' => 3,
                                'CoutMana' =>5,
                                'Etat' =>false,
                                'Bouclier' => false),
                array (     'URL' =>'./asset/image_jeu/HS-sort.png',
                                'NomCarte' => 'NomDeLaCarte_15',
                                'TypeDeCarte' => 'Sort',
                                'Effet' => 'Zone' ,
                                'PA' => 3,
                                'CoutMana' =>5,
                                'Bouclier' => false ), 
                array (    'URL' =>'./asset/image_jeu/HS-sort.png',
                                'NomCarte' => 'NomDeLaCarte_12',
                                'TypeDeCarte' => 'Sort',
                                'Effet' => 'Zone' ,
                                'PA' => 3,
                                'CoutMana' =>5,
                                'Bouclier' => false),
                array (     'URL' =>'./asset/image_jeu/HS-sort.png',
                                'NomCarte' => 'NomDeLaCarte_13',
                                'TypeDeCarte' => 'Sort',
                                'Effet' => 'Zone' ,
                                'PA' => 3,
                                'CoutMana' =>5,
                                'Bouclier' => false ),
                array (     'URL' =>'./asset/image_jeu/HS-sort.png',
                                'NomCarte' => 'NomDeLaCarte_14',
                                'TypeDeCarte' => 'Sort',
                                'Effet' => 'Zone' ,
                                'PA' => 3,
                                'CoutMana' =>5,
                                'Bouclier' => false), 
                ), 




    'Board' => array(),
    'Jouer' => true,
    'Swap' => true,
);


$Tab_Joueur_2 = array(
    'NomJoueur' => 'Joueur_2',
    'PV' => 20,
    'CartesMain' => array(),
'ManaMax' => 8,
'Mana' => 8, 
'Deck' => array(  
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_1',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_2',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => true),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_3',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
        
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_4',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_5',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_6',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),          
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_7',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_8',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_9',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false), 
                array ( 'URL' =>'./asset/image_jeu/HS.png',
                        'NomCarte' => 'NomDeLaCarte_10',
                        'TypeDeCarte' => 'Creature',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS-special.png',
                        'NomCarte' => 'NomDeLaCarte_11',
                        'TypeDeCarte' => 'Special',
                        'PV' => 3,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Etat' =>false,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS-sort.png',
                        'NomCarte' => 'NomDeLaCarte_15',
                        'TypeDeCarte' => 'Sort',
                        'Effet' => 'Zone' ,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Bouclier' => false ), 
                array ( 'URL' =>'./asset/image_jeu/HS-sort.png',
                        'NomCarte' => 'NomDeLaCarte_12',
                        'TypeDeCarte' => 'Sort',
                        'Effet' => 'Zone' ,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Bouclier' => false),
                array ( 'URL' =>'./asset/image_jeu/HS-sort.png',
                        'NomCarte' => 'NomDeLaCarte_13',
                        'TypeDeCarte' => 'Sort',
                        'Effet' => 'Zone' ,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Bouclier' => false ),
                array ( 'URL' =>'./asset/image_jeu/HS-sort.png',
                        'NomCarte' => 'NomDeLaCarte_14',
                        'TypeDeCarte' => 'Sort',
                        'Effet' => 'Zone' ,
                        'PA' => 3,
                        'CoutMana' =>5,
                        'Bouclier' => false), 
                ), 

    'Board' => array(),
    'Jouer' => true,
    'Swap' => true,
);