<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
     public function add($slug)
     {
        $p_check=Product::where('slug',$slug)->where('status','0')->first();
        if($p_check)
        {
            $prod_id=$p_check->id;
            $review=Review::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
            if($review)
            {
                return view('frontend.review.edit',compact('review'));
            }else{
           
            $verify_purchase=Order::where('orders.user_id',Auth::id())->join('orders_items','orders.id','orders_items.order_id')->where('orders_items.prod_id',$prod_id)->get();
            return view('frontend.review.index',compact('p_check','verify_purchase'));
                 
            }

        }else{
            return redirect()->back()->with('status',"The link you followed was broken.");
        }

       
     }
     public function create(Request $request)
     {
        $p_id=$request->input('p_id');
        $product=Product::where('id',$p_id)->where('status','0')->first();
        if($product)
        {
            $user_review=$request->input('user_review');
            $new_review=Review::create([
                'user_id'=>Auth::id(),
                'prod_id'=>$p_id,
                'user_review'=>$user_review
            ]);
            $cat_slug=$product->category->slug;
            $pro_slug=$product->slug;
            if($new_review)
            {
                return redirect('category/'.$cat_slug.'/'.$pro_slug)->with('status',"Thank you for writing a review");
            }
        }
        else{
            return redirect()->back()->with('status',"The link you followed was broken");
        }
     }

     public function edit($slug)
     {
        $product=Product::where('slug',$slug)->where('status','0')->first();
        if($product)
        {
            $prd_id=$product->id;
            $review=Review::where('prod_id',$prd_id)->where('user_id',Auth::id())->first();
            if($review)
            {
                 return view('frontend.review.edit',compact('review'));
            }else{
            return redirect()->back()->with('status',"The link you followed was broken");
            }
        }else{
            return redirect()->back()->with('status',"The link you followed was broken");
        }
     }

     public function update(Request $request)
     {
        $user_review=$request->input('user_review');
        if($user_review !='')
        {
            $review_id=$request->input('p_id');
            $rev=Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($rev)
            {
                $rev->user_review=$request->input('user_review');
                $rev->update();
                return redirect('category/'.$rev->product->category->slug.'/'.$rev->product->slug)->with('status',"Review updated successfully");
            }else{
                return redirect()->back()->with('status',"The link you followed was broken");
            }
        }else{
            return redirect()->back()->with('status',"You can not submit empty review.");
        }
     }
}
