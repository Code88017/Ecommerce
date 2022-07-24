<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
        $featured_product=Product::where('trending','1')->take(15)->get();
        $trnd_cat=Category::where('popular','1')->take(15)->get();
        return view('frontend.index',compact('featured_product','trnd_cat'));
    }


    public function categories()
    {
        $category=Category::where('status','0')->get();
        return view('frontend.categories',compact('category'));
    }




    public function category($slug)
    {
        if(Category::where('slug',$slug)->exists())
         {
             $category=Category::where('slug',$slug)->first();
             $product=Product::where('cate_id',$category->id)->get();
             return view('frontend.products.index',compact('category','product'));
         }else{
              return redirect('/')->with('status',"Category does not exist.");
         }
    }

    public function viewproduct($cat_slug, $prd_slug)
    {
       if(Category::where('slug',$cat_slug)->exists())
       {
        if(Product::where('slug',$prd_slug)->exists())
        {
            $product=Product::where('slug',$prd_slug)->first();
            $rate=Rating::where('prod_id',$product->id)->get();
            $rate_sum=Rating::where('prod_id',$product->id)->sum('stars_rating');
            $user_rating=Rating::where('prod_id',$product->id)->where('user_id',Auth::id())->first();
            $review=Review::where('prod_id',$product->id)->get();


            if($rate->count()>0)
            {
                $rating_value=$rate_sum/$rate->count();

            }else{
                $rating_value=0;
            }
            

            return view('frontend.products.view',compact('product','rate','rating_value','user_rating','review'));
        }else{
            return redirect('/')->with('status','slug does not exists.');
        }
       }else{
        return redirect('/')->with('status','slug does not exists.');
       }
    }
    public function productlistajax()
    {
        $prod=Product::where('status','0')->get();
        $data=[];
        foreach($prod as $item)
        {
            $data[]=$item['name'];
        }
        return $data;
    }
}
