<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

use PDF;
class AdminController extends Controller
{
    public function view_category(){
        $data=category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category( Request $request){
        $data=new Category;
        $data->category_name=$request->category;
        $data->save();
        return redirect()->back()->with('message', 'category added successfully!');
        
    }
    public function delete_category($id){
        $data=category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'category deleted successfully!');

    }
    public function update_category($id){
        $data=category::find($id);
        return view('admin.update_category',compact('data'));

    }
    public function update_category_confirm(Request $request, $id){

        $data = category::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Category not found!');
        }
        $request->validate([
            'category_name' => 'required|string|max:255', 
        ]);
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('message', 'Category updated successfully!');

    }
    public function view_product(){
        $category=category::all();
        return view('admin.product', compact('category'));
    }
    public function add_product(Request $request){
        $product=new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image=$imagename;
        $product->save();
        return redirect()->back()->with('message', 'Product added successfully!');

    }
    public function show_product(){
        $product=product::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id){
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message', 'Product deleted successfully!');
    }
    public function update_product($id){
        $product=product::find($id);
        $category=category::all();
        return view('admin.update_product',compact('product','category'));

    }
    public function update_product_confirm(Request $request, $id){
        $product=product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->category=$request->category;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $image=$request->image;
        if($image){

            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image=$imagename;
            $product->image=$imagename;
        }
        
        $product->save();
        return redirect()->back()->with('message', 'Product updated successfully!');
    }

    public function order(){
        $order=order::all();
        return view('admin.order', compact('order'));
    }

    public function delivered($id){
        $order=order::find($id);
        $order->payment_status="Paid";
        $order->delivery_status="Delivered";
        $order->save();
        return redirect()->back();
    }


    public function print_pdf($id)
    {
        // Retrieve the order by ID
        $order = Order::findOrFail($id);

        // Load the PDF view and pass the order data
        $pdf = PDF::loadView('admin.print_pdf', compact('order'));

        // Download the PDF with a specific file name
        return $pdf->download('order_' . $order->id . '.pdf');
    }
   
}