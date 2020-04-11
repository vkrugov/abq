<?php

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGenders()
    {
        return response()->json(GenderEnum::toSelectArray());
    }
}
