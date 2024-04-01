<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
// use Session;
// use Stripe;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class HomeController extends Controller
{
    
    public function redirect(){
        $usertype = Auth::User()->usertype;
        if($usertype=='1'){
            return view('admin.home');

        }
        else{
            $product = Product::paginate(6);
            return view('home.userpage', compact('product'));
        }

    }

    public function index() {
        $product = Product::paginate(6);
        return view('home.userpage', compact('product'));
    }
    public function product_details_page($id){
        $product=product::find($id);
        return view('home.product_details_page',compact('product'));
    }
    public function add_cart(Request $request,$id){
    if (Auth::id()){
        $user=Auth::user();
        $product=product::find($id);
        $cart= new cart;

        $cart->user_id=$user->id;
        $cart->user_name=$user->name;
        $cart->user_email=$user->email;
        $cart->user_phone=$user->phone;
        $cart->user_address=$user->address;
        
        $cart->product_id=$product->id;
        $cart->product_title=$product->title;
        $cart->product_description=$product->description;

        $cart->product_image=$product->image;

        
        if($product->discount_price!=null){
            $cart->product_price=$product->discount_price; // * $request->cart_quantity;
        }
        else{
            $cart->product_price=$product->price; // * $request->cart_quantity;
        }
        $cart->cart_quantity=$request->cart_quantity;
        $existingCartItem = Cart::where('user_id', auth()->id())
        ->where('product_id', $cart->product_id)
        ->first();

        if ($existingCartItem) {
        $existingCartItem->cart_quantity += $request->input('cart_quantity');
        $existingCartItem->save();
        } else {
        $cart->save();
        }
        return redirect()->back()->with('message', 'Product added to cart sucessfully!');

    
    }
    else{
        return redirect('login');
    }
}
    public function show_cart(){
        if (Auth::id()){
        $id=Auth::user()->id;
        $cart=cart::where('user_id','=',$id)->get();
        return view('home.show_cart', compact('cart'));
    }
    else{
        return redirect('login');
    }
}
public function remove_cart($id)
{
    $cartItem = Cart::where('product_id', $id)->first();

    if ($cartItem) {
        $cartItem->delete();
        return redirect()->back()->with('message', 'Product removed from cart successfully.');
    } else {
        return redirect()->back();
    }
}
public function update_cart(Request $request, $id){
    $cart=cart::find($id);
    $product=product::find($id);
    if (!$cart) {
        return redirect()->back()->with('error', 'Category not found!');
    }
    $cart->cart_quantity = $request->cart_quantity;
    $cart->save();
    $product_id=$cart->product_id;
    $cartItems = Cart::where('user_id', $cart->user_id)->get(); 
    $product_price=0;
    foreach ($cartItems as $item) {
        $product = Product::find($item->product_id);
        if($product->discount_price!=null){
            $product_price = $product->discount_price * $item->cart_quantity;
        

        }
        else{
            $product_price = $product->price * $item->cart_quantity;

        }
        $cart->product_price =$product_price;

    }
    $cart->save();
    return redirect()->back()->with('message', 'Category updated successfully!');
    }


  
    public function cash_order(){

        $user=Auth::user();
        $user_id=$user->id;
        $data=cart::where('user_id', '=',$user_id)->get();
        foreach($data as $data){
            $order=new order;
            $order->user_id=$data->user_id;
            $order->user_name=$data->user_name;
            $order->user_email=$data->user_email;
            $order->user_phone=$data->user_phone;
            $order->user_address=$data->user_address;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->product_description=$data->product_description;
            $order->product_image=$data->product_image;
            $order->product_price=$data->product_price;
            $order->cart_quantity=$data->cart_quantity;
            $order->payment_status='cash on delivery';
            $order->delivery_status='proccessing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
            
        }
        return redirect()->back()->with('message', 'Order placed successfully!');
    }
    public function stripe($totalPrice){
        return view('home.stripe', compact('totalPrice'));
    }

    // public function stripePost(Request $request, $totalPrice)
    // {
    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
    //     Stripe\Charge::create ([
    //             "amount" => $totalPrice * 100,
    //             "currency" => "usd",
    //             "source" => $request->stripeToken,
    //             "description" => "Thanks for payment." 
    //     ]);
      
    //     Session::flash('success', 'Payment successful!');
              
    //     return back();
    // }

    public function stripePost($totalPrice)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $checkout_session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Your Product',
                ],
                'unit_amount' => $totalPrice * 100, // Amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('success'), // URL to redirect after successful payment
        'cancel_url' => route('cancel'),   // URL to redirect if payment is canceled
    ]);





    $user=Auth::user();
        $user_id=$user->id;
        $data=cart::where('user_id', '=',$user_id)->get();
        foreach($data as $data){
            $order=new order;
            $order->user_id=$data->user_id;
            $order->user_name=$data->user_name;
            $order->user_email=$data->user_email;
            $order->user_phone=$data->user_phone;
            $order->user_address=$data->user_address;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->product_description=$data->product_description;
            $order->product_image=$data->product_image;
            $order->product_price=$data->product_price;
            $order->cart_quantity=$data->cart_quantity;
            $order->payment_status='Paid';
            $order->delivery_status='proccessing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
            
        }
    return redirect()->to($checkout_session->url);
}


public function success()
{
    // Handle successful payment
    return view('home.success');
}

public function cancel()
{
    // Handle canceled payment
    return view('home.cancel');
}
}




