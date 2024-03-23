<?php
namespace App\Interfaces;

interface AuthServiceInterface
{
    public function authenticate($username, $password);
}
