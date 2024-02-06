<?php

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
    case Admin = 'admin';
    case Instructor = 'instructor';
    case Mechanic = 'mechanic';
    case Reseller = 'reseller';
}
