<?php

function verifierAdmin(): bool {
    if (isset($_SESSION['login']) && $_SESSION['login'] === true && $_SESSION['role'] === 'admin') 
          return true;
    else
        return false;
}