<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function index(){
        $products = Product::select(['id', 'name', 'quantity', 'price', 'description'])->get();
        return view('index', compact('products'));
    }

    public function edit($id){
        $product = Product::find($id);
        
        if(!$product){
            return redirect()->route('index');
        }

        return view('edit', compact('product'));
    }

    public function update(Request $request, $id){
        $product = Product::find($id);

        if(!$product){
            return redirect()->route('index');
        }

        $name = $request->input('name');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $description = $request->input('description');
    
        $error = '';
    
        if(empty($name) || empty($quantity) || empty($price) || empty($description)){
            $error = 'Fill out all fields.';
        }
        elseif(!is_numeric($quantity) || intval($quantity) != $quantity){
            $error = 'Quantity must be an integer.';
        } 
        elseif(!is_numeric($price) || floatval($price) != $price) {
            $error = 'Price must be a double.';
        }

        if(!empty($error)){
            return back()->with('error', $error)->withInput();
        }

        $product->update([
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'description' => $description
        ]);

        return redirect()->route('index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id){
        $product = Product::find($id);

        if(!$product){
            return redirect()->route('index');
        }

        $product->delete();

        return redirect()->route('index')->with('success', 'Product deleted successfully');
    }

    public function addproducts(){
        return view('addproducts');
    }

    public function addproductsPost(Request $request){
        $name = $request->input('name');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $description = $request->input('description');
    
        $error = '';
    
        if(empty($name) || empty($quantity) || empty($price) || empty($description)){
            $error = 'Fill out all fields.';
        }
        elseif(!is_numeric($quantity) || intval($quantity) != $quantity){
            $error = 'Quantity must be an integer.';
        } 
        elseif(!is_numeric($price) || floatval($price) != $price) {
            $error = 'Price must be a double.';
        }

        if(!empty($error)){
            return back()->with('error', $error)->withInput();
        }

        $data = $request->only([
            'name',
            'quantity',
            'price',
            'description'
        ]);
    
        Product::create($data);
    
        return redirect()->route('index')->with('success', 'Product created successfully.');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}