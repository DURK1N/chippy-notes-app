<?php

// Models/NoteModel.php
class NoteModel {
    public function getText($inputText) {

        /**
         * 
         * Process notes.
         * 
         */

        return $inputText;
    }
    /**
     * Stores the username given by the Controller in a cookie, or uses the IP address as a username if one is not given.
     * @return bool Returns true for successful username assignment.
     */
    public function login($username) {
        if ($username != null) {
            setcookie("username", $username, time() + 86400); // It stores the username for 1 day (for now)
        }
        else  { // If the user did not enter a username, their IP is assigned as an identifier
            setcookie("username", $_SERVER['REMOTE_ADDR'], time() + 86400);
        }
        return true;
        // BELOW IS THE CODE FOR ADDING THE USERNAME TO THE DATABASE ITSELF, IF WE DECIDE TO GO WITH THIS APPROACH
        // SQL Query
        // $sqlQuery = 'UPDATE authors SET username = :username';
        // $statement = $this->_dbHandle->prepare($sqlQuery);
        // Bind parameters
        // $statement->bindParam(':username', $username);
        // $statement->execute();
    }
}
