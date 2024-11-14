<?php
require_once 'Database.php';

class Submission {
    private $conn;
    private $table_name = 'submissions';

    public $name;
    public $email;
    public $mobile;
    public $message;
    public $password;
    public $image_path;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, email=:email, mobile=:mobile, message=:message, password=:password, image_path=:image_path";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":mobile", $this->mobile);
        $stmt->bindParam(":message", $this->message);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":image_path", $this->image_path);

        return $stmt->execute();
    }

    
}




class User {
    private $conn;
    private $table_name = 'submissions'; // Adjust with your table name

    public $user_id;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Function to verify email and password
    public function verifyLogin() {
        // Prepare SQL query to fetch the user by email
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        // Check if a user with this email exists
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the password
            if (password_verify($this->password, $user['password'])) {
                // If password is correct, set user_id and return true
                $this->user_id = $user['user_id'];
                return true;
            }
        }
        return false; // If login fails
    }
}
?>
