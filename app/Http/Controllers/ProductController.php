<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    //this method will show products page
    public function index(){
        $product = Product::orderBy('created_at','DESC')->get();
    
        return view('product.list',[
            'product' => $product
        ]);
    }

     //this method will show create products page
    public function create(){
        return view('product.create');
     }

    //this method will store or insert product in db
    public function store(Request $request) {
        $rules = [
                'name' => 'required|min:5',
                'sku' => 'required|min:3',
                'price' => 'required|numeric'            
        ];

        if ($request->image !=  ""){
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('product.create')->withInput()->withErrors($validator);
        }

        //here wee will insert product in db
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image !=  ""){
        //here we will store image
        $image = $request->image;
        $ext =$image->getClientOriginalExtension();
        $imageName = time().'.'.$ext; //unique img name

        //save img to product directory
        $image->move(public_path('uploads/product'),$imageName);

        //save img in database
        $product->image = $imageName;
        $product->save();
        }

        return redirect()->route('product.index')->with('success','product added succesfully');
    }

    //this method will show edit products  pages
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('product.edit',[
            'product' => $product
        ]);
        
     }
    //this method will update products 
    public function update($id, Request $request){

        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric'            
    ];

    if ($request->image !=  ""){
        $product = Product::findOrFail($id);//checking if product is on or not
        $rules['image'] = 'image';
    }

    $validator = Validator::make($request->all(),$rules);

    if($validator->fails()){
        return redirect()->route('product.edit',$product->id)->withInput()->withErrors($validator);
    }

    //here wee will update product in db
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->save();

    if ($request->image !=  ""){

    //delete old img
    File::delete(public_path('uploads/product/'.$product->image));

    //here we will store image
    $image = $request->image;
    $ext =$image->getClientOriginalExtension();
    $imageName = time().'.'.$ext; //unique img name

    //save img to product directory
    $image->move(public_path('uploads/product'),$imageName);

    //save img in database
    $product->image = $imageName;
    $product->save();
    }

    return redirect()->route('product.index')->with('success','product updated succesfully');
    }



    //this method will delete the product
    public function destroy($id){

        $product = Product::findOrFail($id);

        //delete img
        File::delete(public_path('uploads/product/'.$product->image));
        
        //delete product from database
        $product->delete();

        return redirect()->route('product.index')->with('success','product deleted succesfully');


        
    }
}
