<?php
require('users.php');
class Database extends User_utilisateurs {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    protected $conn;

    public function __construct() {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'users';
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
            return null; // ici on gere les erreurs
        }
    }
    function verification_numero_email( $email ,$numero) {
            $recup=$this->conn->prepare("SELECT * FROM clients WHERE email=:email AND numero=:numero");
            $recup->bindParam(':email',$email);
            $recup->bindParam(':numero',$numero);
            $recup->execute();
           return  $users =$recup->fetchAll(PDO::FETCH_ASSOC); 
    }
    function manger( $email,$mot_de_passe) {
        $recup=$this->conn->prepare("SELECT * FROM clients WHERE email=:email AND mot_de_passe=:mot_de_passe");
        $recup->bindParam(':email',$email);
        $recup->bindParam(':mot_de_passe',$mot_de_passe);
        $recup->execute();
       return  $users =$recup->fetchAll(PDO::FETCH_ASSOC); 
}
    function insertion (User_utilisateurs $aicha){
        $sql = "INSERT INTO clients (nom, prenom, email,numero, mot_de_passe) VALUES (?, ?, ?, ?, ?)";
        $requete = $this->conn->prepare($sql);
        if ($requete->execute([
            $aicha->nom,
            $aicha->prenom,
            $aicha->email,
            $aicha->numero,
            $aicha->mot_de_passe
        ])) {
            echo "Inscription réussie";
        } else {
            echo "Échec de l'inscription";
        
    }

} 
function affiche_liste(){
    $recup=$this->conn->prepare("SELECT * FROM clients");
    $recup->execute();
    return $recup-> fetchAll();

}
}
// verifions et recuperons


    if (isset($_POST["inscrire"])) {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $erreur = [];
        // var_dump($_POST['numero']);

        // Les validations pour l'inscription 

        if (!preg_match('/^[A-Za-z]{2,}$/', $prenom)) {
          
            $erreur[] = "Veuillez entrer un prénom valide. ";
        }

        if (!preg_match('/^[A-Za-z]{2,}$/', $nom)) {
       
            $erreur[] = "Veuillez entrer un nom valide. ";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     
            $erreur[] = "Veuillez entrer une adresse email valide. ";
        }

        if (!preg_match('/^[0-9]{1,9}$/', $numero)) {

            $erreur[] = "Veuillez entrer un numéro de téléphone valide. ";
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $mot_de_passe)) {

            $erreur[] = "Veuillez entrer un mot de passe valide. ";
        }
        // if(verification_numero_email($email,$numero)){  //on appel ici la fonction 
        //     $erreur[]="adresse email ou numero de telephone existe deja";
        //  }
        // Si toutes les validations sont ok on insert les donnes dans la bd.
        if (!empty($erreur)) {
            print_r($erreur);
        }else{
         $user_utilisateurs1=new User_utilisateurs($nom,$prenom,$email,$numero,$mot_de_passe);
         $Database=new Database();
         $Database->insertion($user_utilisateurs1);
         

           }
        
    } //partie connexion
    
    else if (isset($_POST["connexion"])) {
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $erreur= [];
        
        // Les validations pour la connexion 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              
            $erreur[] = "Veuillez entrer un Adresse email valide. ";
        } 

        if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $mot_de_passe)) {
               
            $erreur[] = "Veuillez entrer un Mot de passe valide. ";
        }

        if (!empty($erreur)) {
           print_r($erreur);
        }else{
            echo "k";
            $Database=new Database();
           
            if ( $Database->manger($email , $mot_de_passe)) {
               
                header('location:affiche.php');

            } else {
                echo "Échec de la connexion";
            }
        }
    }

    // manger( 'email' ,'mot_de_passe');
    

?>

