<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cart=Cart::where('user_id',Auth::id())->get();
        foreach($old_cart as $item)
        {
            if(!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
            {
              $remove=Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
              $remove->delete();
            }
        }
        $cart=Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cart'));
    }

    public function placeorder(Request $request)
    {
        $order=new Order();
        $order->user_id=Auth::id();
        $order->fname=$request->input('fname');
        $order->lname=$request->input('lname');
        $order->email=$request->input('email');
        $order->phone=$request->input('phone_no');
        $order->address1=$request->input('address1');
        $order->address2=$request->input('address2');
        $order->city=$request->input('city');
        $order->state=$request->input('state');
        $order->country=$request->input('country');
        $order->pincode=$request->input('pincode');
        $order->payment_mode=$request->input('payment_mode');
        $order->payment_id=$request->input('payment_id');
        $order->tracking_no='order'.rand(1111,9999);
      
        $total=0;
        $cart_total=Cart::where('user_id',Auth::id())->get();
        foreach($cart_total as $c_item)
        {
            $total+=$c_item->product->selling_price*$c_item->prod_qty;
        }
        if($request->input('total'))
        {
            $order->total_price=$request->input('total');

        }else{
            $order->total_price= $total;
        }
    
       
        $order->save();

        $cartitem=Cart::where('user_id',Auth::id())->get();
        foreach($cartitem as $cart)
        {
            OrderItem::create([
                'order_id'=>$order->id,
                'prod_id'=>$cart->prod_id,
                'qty'=>$cart->prod_qty,
                'price'=>$cart->product->selling_price,
            ]);
            $prod=Product::where('id',$cart->prod_id)->first();
            $prod->qty=$prod->qty-$cart->prod_qty;
            $prod->update();
        }

        if(Auth::user()->address1==NULL)
        {
            $user=User::where('id',Auth::id())->first();
            $user->name=$request->input('fname');
            $user->lname=$request->input('lname');
            $user->phone=$request->input('phone_no');
            $user->address1=$request->input('address1');
            $user->address2=$request->input('address2');
           
            $user->city=$request->input('city');
            $user->state=$request->input('state');
            $user->country=$request->input('country');
            $user->pincode=$request->input('pincode');
            $user->update();
        }
        $cartitem=Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitem);
        if( $order->payment_mode=="Paid by paypal")
        {
            return response()->json(['status'=>"Successfully paid"]);
        }
        return redirect('/')->with('status',"Order placed successfully.");
    }

    public function razorapay(Request $request)
    {
        $cartItem=Cart::where('user_id',Auth::id())->get();
        $total_price=0;
        foreach( $cartItem as $item)
        {
            $total_price +=$item->product->selling_price * $item->prod_qty;
        }
                $fname=$request->input('fname');
                $lname=$request->input('lname');
                $email=$request->input('email');
                $phone=$request->input('phone');
                $address1=$request->input('address1');
                $address2=$request->input('address2');
              
                $city=$request->input('city');
                $state=$request->input('state');
                $country=$request->input('country');
                $pincode=$request->input('pincode');
                
            return response()->json([
                'fname'=>$fname,
                'lname'=>$lname,
                'email'=>$email,
                'phone'=>$phone,
                'address1'=>$address1,
                'address2'=>$address2,
                'city'=>$city,
                'state'=>$state,
                'country'=>$country,
                'pincode'=>$pincode,
                'total_price'=>$total_price,
            ]);
            
    }
}
