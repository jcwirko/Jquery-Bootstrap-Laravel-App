<?php

namespace App\Values;

class RolesValues
{
    const ADMIN = [
        'name' => 'Admin',
        'title' => 'Acceso a todo el sistema'
    ];

    const SUPERVISOR = [
        'name' => 'Supervisor',
        'title' => 'Acceso al modulo de administración'
    ];

    const CASHIER = [
        'name' => 'Cajero',
        'title' => 'Acceso a los productos y usuarios'
    ];
}
