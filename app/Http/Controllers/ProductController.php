<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // products List

    public function productsList()
    {
        $products = Product::select('products.*','categories.name as category_name')
            ->when(request('searchKey'), function ($value) {
                $searchKey = request('searchKey');
                $value->where('products.name', 'like', '%' . $searchKey . '%');
            })
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);
        // dd($products->toArray());
        $products->appends(request()->all());
        return view('admin.products.pizzaList', compact('products'));
    }

    //    create products
    public function productsCreate()
    {
        $categoryData = Category::select('id', 'name')->get();

        return view('admin.products.create', compact('categoryData'));
    }

    // get products

    public function getProduct(Request $request)
    {
        $this->productValidationCheck($request, 'create');
        $product = $this->productData($request);
        // dd($product);

        $imageName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $imageName);
        $product['image'] = $imageName;

        Product::create($product);
        return redirect()->route('products#list');
    }

    // delete product

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess' => 'Product Delete Success...']);
    }

    // detail product
    public function detailProduct($id)
    {
        $product = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id', $id)->first();
        // dd($product);
        return view('admin.products.detail', compact('product'));
    }

    // edit product

    public function editProduct($id)
    {
        $product = Product::where('id', $id)->first();
        $categories = Category::get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // update product
    public function updateProduct(Request $request)
    {
        $data = $this->productData($request);
        $this->productValidationCheck($request, 'update');
        $id = $request->productID;
        if ($request->hasFile('image')) {
            $oldImage = Product::select('image')->where('id', $id)->first();
            $oldImage = $oldImage->image;
            if ($oldImage != null) {
                Storage::delete('public/' . $oldImage);
            }

            $imageName = uniqid() . "_" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }
        Product::where('id', $id)->update($data);
        return redirect()->route('products#list');
    }

    // private function

    private function productValidationCheck($request, $action)
    {
        $validationRules = [
            'name' => 'required|unique:products,name,' . $request->productID,
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'waitingTime' => 'required',
        ];
        $validationRules['image'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png|file' : 'mimes:jpg,jpeg,png|file';
        Validator::make($request->all(), $validationRules)->validate();
    }

    private function productData($request)
    {
        return [
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
        ];
    }
}
