<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request)
    {
         $stars_rated=$request->input('product_rating');
         $prod_id=$request->input('product_id');

         $p_check=Product::where('id',$prod_id)->where('status','0')->get();
         if($p_check)
         {
            $verify_purchase=Order::where('orders.user_id',Auth::id())->join('orders_items','orders.id','orders_items.order_id')->where('orders_items.prod_id',$prod_id)->get();

            if($verify_purchase->count()>0)
            {
                $exist_rate=Rating::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                if($exist_rate)
                {
                    $exist_rate->stars_rating=$stars_rated;
                    $exist_rate->update();
                }else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'prod_id'=>$prod_id,
                        'stars_rating'=>$stars_rated
                    ]);
                }
               
                return redirect()->back()->with('status',"Thank you for Rating this product.");
            }else{
                return redirect()->back()->with('status',"You cannot rate product without purchase.");
            }
         }else{
            return redirect()->back()->with('status',"The you followed was  broken.");
        }
    }
}
