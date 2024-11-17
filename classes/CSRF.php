<?php

class CSRF {
    public function __construct(){

        // Generate CSRF token if it doesn’t exist
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
    }
}