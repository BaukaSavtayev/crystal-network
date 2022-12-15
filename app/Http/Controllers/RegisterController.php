<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'surname' => 'required|min:3|max:255',
            //'email' => 'email|unique:users,email',
            //'email_phone_number' => 'size:11|numeric|unique:users,phone_number',
            'email_or_phone_number' => [
                'required',
                'regex:/^[a-zA-z0-9_\-.]{1,30}@[a-zA-z0-9_\-]{1,30}\.[a-zA-z0-9]{1,10}$|^[0-9]{9,12}$/'
            ],
            'password' => 'required|min:6|max:255'
        ]);
        $user = new User();
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->password = Hash::make($data['password']);
//        if ($request['phone_number']): $user->phone_number = $data['phone_number'];
//        elseif ($request['email']): $user->email = $data['email'];
//        else: die('Пошел наху');
//        endif;
        if (strpos($data['email_or_phone_number'], '@') === false) $user->phone_number = $data['email_or_phone_number'];
        else $user->email = $data['email_or_phone_number'];

        $user->save();
//        $user = User::create([
//            'name' => $data['name'],
//            'surname' => $data['surname'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);

        if ($user) {
            //event(new Registered($user));
            return $user;
        }
    }
}
