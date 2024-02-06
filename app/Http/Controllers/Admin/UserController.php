<?php

namespace App\Http\Controllers\Admin;
use App\Enums\UserRole;
use App\Models\User;


class UserController extends TemplateController
{
    public function __construct(User $user)
    {
        parent::__construct($user, 'Admin/User/IndexUsers', 'name');
    }

    public function getRoleEnums() {
        return response()->json(UserRole::cases()); // Assuming UserRole is an enum class
    }
}
