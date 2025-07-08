<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Cart;
use App\Models\CartItem;
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

    public function destroy(User $user) // Asumiendo Route Model Binding para User
    {
        
        $userID = $user->user_id;
        $cart = Cart::firstOrCreate(['user_id' => $userID]);

        //elimina todos los items del carrito si es que hay
        CartItem::where('cart_id', $cart->cart_id)->delete();

        //Borra el carrito asignado para el usuario
        $cart->delete();
        //Banea al usuario
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario y todos sus carritos e ítems de carrito eliminados con éxito.');
    }
}
