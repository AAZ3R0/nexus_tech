<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class userController extends Controller
{
    public function index(){

        $users = User::where('rol_id', 2)->paginate(10);
        $roles = Role::all();
        $carts = Cart::all();

        return view('admin.usersTable', compact('users', 'roles', 'carts'));
    }

    public function destroy(User $user, Cart $cart){

        $cart->where('user_id', $user->user_id)->delete(); //Borramos el carrito del usuario
        $user->delete(); //Borramos el usuario
        return redirect()-> route('admin.users.index')-> with('success', 'Usuario baneado');
    }
}
