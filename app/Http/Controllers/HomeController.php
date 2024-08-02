<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
 
class HomeController extends Controller{
   
    public function index(){
        $products = Product::all();

        return view('index', ['products'=>$products]);
    }

    public function addproducts(){
        return view('addproducts');
    }

    public function addproductsPost(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric|between:0,999999.99',
            'description' => 'required'
        ]);

        $product = Product::create($data);

        return redirect(route('index'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}