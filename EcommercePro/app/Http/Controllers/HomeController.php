<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;

use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{

    public function index(){
        $product=product::paginate(3);
        return view('home.userpage',compact('product'));
    }

    public function redirect(){

        $usertype=Auth::user()->usertype;

        if($usertype == '1'){

            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            $order=order::all();
            $total_revenue=0;

            foreach($order as $o)
            {
                $total_revenue=$total_revenue + $o->price;
            }
            $order_delivered=0;
            $order_processing=0;
            foreach ($order as $o)
            {
                if($o->delivery_status == 'delivered')
                {
                    $order_delivered += 1;
                }
                if($o->delivery_status=='processing')
                {
                    $order_processing +=1;
                }
            }


            return view('admin.home', compact('total_product', 'total_order', 'total_user','total_revenue', 'order_delivered', 'order_processing'));
        }

        else{
            $product=product::paginate(3);
            return view('home.userpage',compact('product'));
        }
    }

    public function product_details($id)
    {
        $product=product::find($id);

        return view('home.product_details', compact('product'));
    }


    public function add_cart(Request $request, $id)
    {
        if (Auth::id())
        {
            $user=Auth::user();
            $product=product::find($id); 
            $cart=cart::where('product_id', '=', $id)->first();
                if($cart != null)
                {
                    if($product->discount_price!=null)
                    {
                        $cart->price=$request->quantity*$product->discount_price;
                    }
                    else
                    {
                        $cart->price=$request->quantity*$product->price;
                    }
                    $cart->quantity+=$request->quantity;
                    }
                else{
                    $cart=new cart;
                    $cart->name=$user->name;

                    $cart->email=$user->email;
                    $cart->phone=$user->phone;
                    $cart->address=$user->address;
                    $cart->user_id=$user->id;
                    $cart->product_title=$product->title;
                    if($product->discount_price!=null){
                        $cart->price=$request->quantity*$product->discount_price;
                    }
                    else{
                        $cart->price=$request->quantity*$product->price;
                    }
                    $cart->product_id=$product->id;
                    $cart->quantity=$request->quantity;
                    $cart->image=$product->image;
                    }
            $cart->save();

            Alert::success('Product added successfully to the cart!');
            return redirect()->back();






        }
        else
        {

            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id()){
           $id=Auth::user()->id;
        $cart=cart::where('user_id', '=', $id)->get();
        return view('home.showcart', compact('cart')); 
        }
        else{
            return redirect('login');
        }
        
    }

    public function remove_cart($id)
    {

        $data=cart::find($id);
        $data->delete();
        return redirect()->back()->with('message','Cart deleted successfully');

    }

    public function cash_order()
    {
        $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id', '=', $userid)->get();

        foreach($data as $d)
        {
            $order=new order;
            $order->name=$d->name;
            $order->email=$d->email;
            $order->phone=$d->phone;
            $order->address=$d->address;
            $order->user_id=$d->user_id;
            $order->product_title=$d->product_title;
            $order->price=$d->price;
            $order->quantity=$d->quantity;
            $order->image=$d->image;
            $order->product_id=$d->product_id;

            $order->payment_status='cash on delivery';
            $order->delivery_status='processing';

            $order->save();

            $cart_id=$d->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }

        Alert::info('We have Received your Order. We will connect with you soon...');
        return redirect()->back();
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }


    public function stripePost(Request $request, $totalprice)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
        $user=Auth::user();

        $userid=$user->id;

        $data=cart::where('user_id', '=', $userid)->get();

        foreach($data as $d)
        {
            $order=new order;
            $order->name=$d->name;
            $order->email=$d->email;
            $order->phone=$d->phone;
            $order->address=$d->address;
            $order->user_id=$d->user_id;
            $order->product_title=$d->product_title;
            $order->price=$d->price;
            $order->quantity=$d->quantity;
            $order->image=$d->image;
            $order->product_id=$d->product_id;

            $order->payment_status='paid';
            $order->delivery_status='processing';

            $order->save();

            $cart_id=$d->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_orders()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $user_id=$user->id;
            $orders=order::where('user_id', '=', $user_id)->get();

            return view('home.orders', compact('orders'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status="Canceled";

        $order->save();

        return redirect()->back();
    }

    public function products()
    {
        $product=product::all();
        return view('home.all_products',compact('product'));
    }
}



