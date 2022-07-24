<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
       $product_id=$request->input('product_id');
       $product_qty=$request->input('product_qty');

       if(Auth::check())
       {
            $prd_check=Product::where('id',$product_id)->first();
            if($prd_check)
            {
              if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                return response()->json(['status'=>$prd_check->name.' Already added to cart']);
              }
              $cartItem=new Cart();
              $cartItem->prod_id=$product_id; 
              $cartItem->prod_qty=$product_qty; 
              $cartItem->user_id=Auth::id();
              $cartItem->save();
              return response()->json(['status'=>$prd_check->name.'Added to cart.']); 
            }
       }else{
        return response()->json(['status'=>'Login to continue']);
       }
    }

    public function cart()
    {
      $cartItem=Cart::where('user_id',Auth::id())->get();
      return view('frontend.cart',compact('cartItem'));
    }

    public function Delete_cartItem(Request $request)
    {
      if(Auth::check()){

      
       $p_id=$request->input('prd_id');
       if(Cart::where('prod_id', $p_id)->where('user_id',Auth::id())->exists())
        {
          $cart=Cart::where('prod_id',$p_id)->where('user_id',Auth::id())->first();
          $cart->delete();
          return response()->json(['status'=>"Product successfully deleted"]);
        }else{
          return response()->json(['status'=>"Login to continue."]);
        }
      }else{
        return response()->json(['status'=>"Loggin to continue."]);
      }
    }

    public function update_cart(Request $request)
    {
       $prod_id=$request->input('prd_id');
       $product_qty=$request->input('prd_qty');
       if(Auth::check())
       {
         if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
         {
           $cart= Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
           $cart->prod_qty=$product_qty;
           $cart->update();
           return response()->json(['status'=>"Quantity updated."]);
         }
       }
    }
    public function cart_count()
   {
      $cart_count=Cart::where('user_id',Auth::id())->count();
      return response()->json(['count'=>$cart_count]);
   }
}
