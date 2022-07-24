<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
   public function index()
   {
      $wish=Wishlist::where('user_id',Auth::id())->get();
      return view('frontend.wishlist',compact('wish'));
   }
   public function add(Request $request)
   {
      if(Auth::check())
      {
         $prod_id=$request->input('prd_id');
         $prod_qty=$request->input('prd_qty');
         if(Product::find($prod_id))
         {
            $wish=new Wishlist();
            $wish->prod_id=$prod_id;
            $wish->prod_qty=$prod_qty;
            $wish->user_id=Auth::id();
            $wish->save();
            return response()->json(['status'=>"Product added successfully to wishlist"]);
         }else{
            return response()->json(['status'=>"This product does not exists."]);
         }
      }
      else
      {
         return response()->json(['status'=>"Login to continue"]);
      }
   }
   public function delete(Request $request)
   {
     if(Auth::check())
     {
        $p_id=$request->input('prd_id');
        if(Wishlist::where('prod_id',$p_id)->where('user_id',Auth::id())->exists())
        {
           $wishlist=Wishlist::where('prod_id',$p_id)->where('user_id',Auth::id())->first();
           $wishlist->delete();
           return response()->json(['status',"Product successfully removed from wishlist."]);
        }
        else{
            return response()->json(['status'=>"This product does not exists."]);
         }
     }
     else
     {
        return response()->json(['status'=>"Login to continue"]);
     }
   }
   public function wishlist_count()
   {
      $wish_count=Wishlist::where('user_id',Auth::id())->count();
      return response()->json(['count'=>$wish_count]);
   }
}
