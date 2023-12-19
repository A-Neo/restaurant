<?php

namespace App\Models\Traits;

trait Roleable
{
    public function isAdmin()
    {
        return $this->role === 'admin'; // или другая логика определения администратора
    }
}
