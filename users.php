<?php      
class User_utilisateurs{
    protected $nom;
    protected $prenom;
    protected $email;
    protected $numero;
    protected $mot_de_passe;


public function __construct($nom, $prenom, $email, $numero, $mot_de_passe){
    $this->nom=$nom;
    $this->prenom=$prenom;
    $this->email=$email;
    $this->numero=$numero;
    $this->mot_de_passe=$mot_de_passe;
}
}
// $user_utilisateurs1=new User_utilisateurs("gueye","adama","adama@gmail.com","774569875","adama123");

?>