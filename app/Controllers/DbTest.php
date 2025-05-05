<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class DbTest extends Controller
{
    public function index()
    {
        $db = Database::connect();  // Establish the database connection

        // Try a simple query to see if the DB is accessible
        $query = $db->query("SELECT 1");  

        // Check if query ran successfully
        if ($query) {
            echo "Database connection is successful!";
        } else {
            echo "Failed to connect to the database.";
        }
    }
}
