<?php
class User
{
    // DB stuff

    private $conn;
    private $table = 'User';




    // Post Properties

    public $IdUser;
    public $nom;
    public $prenom;
    public $mail;
    public $mdp;


    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }



    // Get Posts
    public function read()
    {
        // Create query
        $query = 'SELECT u.IdUser , u.nom, u.prenom u.mail, u.mdp FROM ' . $this->table  . 'u';



        echo 'coucou';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }



    public function read_single()
    {
        // Create query
        $query = 'SELECT u.IdUser , u.nom, u.prenom u.mail, u.mdp FROM ' . $this->table  . 'u where u.IdUser = ? limit 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->IdUser);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->mail = $row['mail'];
        $this->mdp = $row['mdp'];
    }

    // Create Post
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET nom =:nom, prenom =:prenom, mail =:mail, mdp =:mdp';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->mdp = htmlspecialchars(strip_tags($this->mdp));

        // Bind data
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':mdp', $this->mdp);


        echo $this->mdp;

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Post
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                          SET nom = :nom, prenom = :prenom, mail = :mail, mdp = :mdp
                          WHERE IdUser = :IdUser';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->mdp = htmlspecialchars(strip_tags($this->mdp));
        $this->IdUser = htmlspecialchars(strip_tags($this->IdUser));

        // Bind data
        $stmt->bindParam(':title', $this->nom);
        $stmt->bindParam(':body', $this->prenom);
        $stmt->bindParam(':author', $this->mail);
        $stmt->bindParam(':category_id', $this->mdp);
        $stmt->bindParam(':id', $this->IdUser);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Post
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->IdUser = htmlspecialchars(strip_tags($this->IdUser));

        // Bind data
        $stmt->bindParam(':id', $this->IdUser);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
