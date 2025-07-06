<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartItemsController extends Controller
{
    public function index(){
        
        $user = Auth::user(); //variable que guarda el usuario autenticado
        $userID = $user->user_id; //variable que guarda el id del usuario autenticado
        $cart = Cart::firstOrCreate(['user_id' => $userID]); //busca el carrito del usuario autenticado
        $CartItems = CartItem::where('cart_id', $cart->cart_id)->get(); //busca los items del carrito del usuario autenticado

        return view('users.cartItems', compact('CartItems', 'userID', 'cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,products_id', 
            'count' => 'required|numeric|min:1', 
        ]);

        $userID = Auth::id(); 
        if (!$userID) {
            return response()->json(['success' => false, 'message' => 'Debes iniciar sesión.'], 401);
        }

        $cart = Cart::firstOrCreate(['user_id' => $userID]); 
        $product = Product::find($request->product_id); 

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'El producto no existe.'], 404);
        }
        
        $unitPrice = $product->price; 

        $existingCartItem = CartItem::where('cart_id', $cart->cart_id) 
                                    ->where('products_id', $product->products_id) 
                                    ->first();

        if ($existingCartItem) {
            $existingCartItem->count += $request->count; 
            $existingCartItem->unit_price = $unitPrice; 
            $existingCartItem->save();
            $message = 'Cantidad del producto actualizada en el carrito.';
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->cart_id, 
                'products_id' => $product->products_id, 
                'count' => $request->count,
                'unit_price' => $unitPrice,
            ]);
            $message = 'Producto agregado al carrito.';
        }

        // --- ¡AQUÍ ES DONDE DEBE ESTAR LA DEFINICIÓN DE LA VARIABLE! ---
        // Calcula el nuevo total de ítems en el carrito (o la suma de las cantidades)
        // Esto se ejecuta SÍ o SÍ después de la creación/actualización del CartItem.
        $newCartItemCount = CartItem::where('cart_id', $cart->cart_id)->sum('count'); 
        // O si quieres el número de productos *diferentes* en el carrito:
        // $newCartItemCount = CartItem::where('cart_id', $cart->cart_id)->count();

        // Ahora $newCartItemCount está definida y lista para usarse
        return response()->json([
            'success' => true,
            'message' => $message,
            'newCartItemCount' => $newCartItemCount 
        ]);
    }

    public function updateQuantity(Request $request, CartItem $cartItem){
        $request->validate([
            'action' => 'required|in:increase,decrease',
        ]);

        if(Auth::id() != $cartItem->cart->user_id){
            return redirect()->route('user.cart')->with('error', 'No tienes permiso para modificar este item.');
        }

        if($request->action === 'increase'){
            $cartItem->count++;
        } elseif ($request->action === 'decrease'){
            $cartItem->count--;
        }

        if($cartItem->count <= 0){
            $cartItem->delete(); // Elimina el item si se reduce a 0 o menos
            return redirect()->route('user.cart')->with('success', 'Item eliminado del carrito.');
        }

        $cartItem->save();

        return redirect()-> route('user.cart')-> with('success', 'Cantidad del producto actualizada en el carrito.');
    }

    public function destroy(CartItem $cartItem) // Laravel inyectará el CartItem basado en el ID de la ruta
    {
        $cartItem->load('cart');
        // Asegúrate de que el usuario autenticado es dueño del carrito y del ítem
        // O al menos que el cartItem pertenece al cart del usuario actual
        if (Auth::id() != $cartItem->cart->user_id) {
            return redirect()->route('user.cart')->with('error', 'No tienes permiso para eliminar este ítem.');
        }

        $cartItem->delete();

        return redirect()->route('user.cart')->with('success', 'Producto eliminado del carrito.');
    }

    public function deleteAll(){
        $userID = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $userID]);

        $CartItems = CartItem::where('cart_id', $cart->cart_id)->delete();

        return redirect()->route('user.product')->with('success', 'Compra realizada con éxito(?)');
    }
}
