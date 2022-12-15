<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use App\Models\Profiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class CommunityController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::id();
        $credentials = $request->validate([
            'community_name' => [
                'required',
                'regex:/^[а-яА-Яa-zA-Z0-9_\-.]{3,55}$/'
            ]
        ]);

        DB::beginTransaction();
        try{
            $community = new User();
            $community->name = $credentials['community_name'];
            $community->surname = $user_id;
            $community->is_group = 1;
            $community->email = null;
            $community->password = 0;
            $community->save();


            Profiles::firstOrCreate([
               'account_id' => $community->id,
                'admin_id' => $user_id
            ]);
            DB::commit();
        } catch (\Exception $e){
            return $e;
        }

        return $community;
    }
}
