<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class InstructorController extends Controller
{
    //
    public function index(){
        return inertia("User/Instructors/index");
    }
}
