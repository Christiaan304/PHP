<?php
    function verifySession()
    {
        return isset($_SESSION['user']);
    }