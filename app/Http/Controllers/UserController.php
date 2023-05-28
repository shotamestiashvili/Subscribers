<?php

namespace App\Http\Controllers;

use App\Data\UserCollection;
use App\Data\UserData;
use App\Http\Requests\UserRequest;
use Domain\Shared\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(UserRequest $request): UserData
    {
        dd ($request->getData());
    }

    public function index()
    {
        $userData = (UserData::from(User::find(1)->getData()));
        $userCollection = (UserCollection::collection($userData));

        dd($userCollection);
    }
}
