<?php

// Définition de la classe Player représentant les joueurs du jeu
class Player {
    public $nom; 
    public $argent; 
    public $perdu;
    public $gain;
    public $scream_war;

    // Constructeur pour initialiser les propriétés de la classe
    public function __construct($nom, $argent, $perdu, $gain, $scream_war) {
        $this->nom = $nom;
        $this->argent = $argent; 
        $this->perdu = $perdu; 
        $this->gain = $gain;
        $this->scream_war = $scream_war;
    }
}

// Définition de la classe Adversaire représentant les adversaires du jeu
class Adversaire {
    public $nom; 
    public $argent; 
    public $age;

    // Constructeur pour initialiser les propriétés de la classe
    public function __construct($nom, $argent, $age) {
        $this->nom = $nom;
        $this->argent = $argent; 
        $this->age = $age;
    }
}

// Création des joueurs avec des caractéristiques différentes
$players = [
    new Player(" Seong Gi-hun", 15, 2, 1, "Perssone peut me battre !"),
    new Player("Kang Sae-byeok", 25, 1, 2, "Yeah!"),
    new Player("Cho Sang-woo", 35, 0, 3, "Je suis le meilleur !"),
];

// Création de 20 adversaires avec des caractéristiques aléatoires
$adversaires = [];
for ($i = 1; $i <= 20; $i++) {
    $adversaires[] = new Adversaire("Joueur " . $i, rand(1, 20), rand(18, 60));
}

// Choix aléatoire d'un joueur parmi la liste des joueurs
$chosenPlayer = $players[rand(0, count($players) - 1)];

// Définition des niveaux de difficulté
$difficultyLevels = ['Facile' => 5, 'Difficile' => 10, 'Impossible' => 20];

// Choix aléatoire d'un niveau de difficulté
$chosenDifficulty = array_rand($difficultyLevels);

// Nombre total de rounds basé sur le niveau de difficulté choisi
$totalRounds = $difficultyLevels[$chosenDifficulty];

// Affichage des informations initiales du jeu
echo "Bienvenue au jeu! Votre personnage choisi aléatoirement est " . $chosenPlayer->nom . " il y a  " . $chosenPlayer->argent . " billes.\n";
echo "le niveau de difficulté: " . $chosenDifficulty . " avec  " . $totalRounds . " niveaux.</br>\n\n";

// Déroulement du jeu
for ($round = 1; $round <= $totalRounds; $round++) {
    // Choix aléatoire d'un adversaire parmi la liste des adversaires
    $currentAdversaire = $adversaires[rand(0, count($adversaires) - 1)];
    
    // Affichage des informations de la rencontre actuelle
    echo "Rencontre " . $round . ": Vous avez " . $chosenPlayer->argent . " billes.\n";
    echo "Le joueur " . $currentAdversaire->nom . " a " . $currentAdversaire->argent . " billes dans sa main.\n</br>\n";

    // Choix aléatoire du nombre de billes pair ou impair
    $guess = rand(0, 1) == 0 ? 'pair' : 'impair';

    // Affichage du choix du joueur
    echo "Devinez si le joueur a un nombre de billes pair ou impair (pair/impair): " . $guess . "\n";

    // Vérification de la réponse
    if (($currentAdversaire->argent % 2 == 0 && $guess == 'pair') || ($currentAdversaire->argent % 2 != 0 && $guess == 'impair')) {
        // Victoire
        $chosenPlayer->argent += $currentAdversaire->argent + $chosenPlayer->gain;
        echo "Bravo! Vous avez gagné! " . $currentAdversaire->nom . " est éliminé. Vous avez maintenant " . $chosenPlayer->argent . " billes.\n";
        array_splice($adversaires, array_search($currentAdversaire, $adversaires), 1);
    } else {
        // Défaite
        $chosenPlayer->argent -= $currentAdversaire->argent + $chosenPlayer->perdu;
        echo "Dommage! Vous avez perdu! " . $currentAdversaire->nom . " vous a battu. Vous avez maintenant " . $chosenPlayer->argent . " billes.\n";
    }

    echo "\n";
}

// Résultat final
if ($chosenPlayer->argent >= 1) {
    echo "Félicitations! Vous avez terminé toutes les parties avec au moins une bille. Vous gagnez 45,6 milliards de Won sud-coréen!\n";
} else {
    echo "Dommage! Vous avez échoué. Essayez à nouveau pour gagner 45,6 milliards de Won sud-coréen.\n";
}

?>
