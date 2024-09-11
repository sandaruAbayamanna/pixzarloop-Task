<?php

class UserManager
{

    //establish connection
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //adding user
    public function addUser($user)
    {
        $sql = "INSERT INTO users (name, email, role) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $user['name'], $user['email'], $user['role']);

        if ($stmt->execute()) {
            echo "User added successfully";
        } else {
            echo "Error adding user: " . $stmt->error;
        }

        $stmt->close();
    }

    //delete user
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "User deleted successfully";
        } else {
            echo "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    }


    //update the user
    public function updateUser($user)
    {
        $sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $user['name'], $user['email'], $user['role'], $user['id']);

        if ($stmt->execute()) {
            echo "User updated successfully";
        } else {
            echo "Error updating user: " . $stmt->error;
        }

        $stmt->close();
    }

    //list-down users
    public function listUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . " - Role: " . $row["role"] . "<br>";
            }
        } else {
            echo "No users found";
        }
    }


    //routes
    public function handleUserOperation($user, $operation)
    {
        switch ($operation) {
            case 'add':
                $this->addUser($user);
                break;
            case 'delete':
                $this->deleteUser($user['id']);
                break;
            case 'update':
                $this->updateUser($user);
                break;
            case 'list':
                $this->listUsers();
                break;
            default:
                echo "Invalid operation";
        }
    }
}


//handle connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//close the connection
$conn->close();

?>
