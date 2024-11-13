<?php
session_start();

// Function to parse the authentication text file
function parseAuthFile() {
    $users = [];
    $content = file_get_contents('../data/authenticate.txt');
    $entries = array_filter(explode("\n\n", $content));
    
    foreach ($entries as $entry) {
        $lines = explode("\n", trim($entry));
        $user = [];
        foreach ($lines as $line) {
            $parts = explode(': ', $line, 2);
            if (count($parts) == 2) {
                $user[trim($parts[0])] = trim($parts[1]);
            }
        }
        if (!empty($user)) {
            $users[] = $user;
        }
    }
    return $users;
}

// Function to verify user credentials
function verifyUser($username, $password, $role) {
    $users = parseAuthFile();
    
    foreach ($users as $user) {
        if ($user['Username'] === 'Username') continue;
        
        if ($user['Username'] === $username && 
            $user['Role'] === $role && 
            $user['Status'] === 'active') {
            
            // In production, use password_verify()
            if ($user['Password'] === $password) {
                return $user;
            }
        }
    }
    return false;
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    try {
        if (empty($username) || empty($password)) {
            throw new Exception("Please fill in all fields");
        }

        $user = verifyUser($username, $password, $role);

        if ($user) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['role'] = $user['Role'];
            
            echo json_encode([
                'success' => true,
                'redirect' => 'portal-user.html'
            ]);
        } else {
            throw new Exception("Invalid username or password");
        }

    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
    exit();
}
?>