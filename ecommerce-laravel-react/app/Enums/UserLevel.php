<?php
namespace App\Enums;

enum UserLevel: int
{
    case CLIENTE = 1;
    case VENDEDOR = 2;
    case ADMIN = 3;
}
