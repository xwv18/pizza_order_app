<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //admin category home page

    public function categoryHome(){
        $categories = Category::when(request('searchKey'),function($query){
            $searchKey = request('searchKey');
            $query->where('name','like','%'.$searchKey.'%');
        })
        ->orderBy('id','desc')
        ->paginate(2);
        $categories->appends(request()->all());

        return view('admin.category.home',compact('categories'));
    }
    // admin category create list page

    public function categoryList(){
        return view('admin.category.category');
    }

    // admin category create get page

    public function categoryCreate(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#home');
    }

    // delete category
    public function categoryDelete($id){
        Category::where('id',$id)->delete();
        return back()->with(['categoryDelete'=> 'Category Delete successful !']);
    }

    // edit category
    public function categoryEdit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // update category
    public function categoryUpdate(Request $request){
        $id = $request->categoryID;
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#home');
    }

    // private function
    // category validation check
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->categoryID,
        ])->validate();
    }

    // category request data
    private function requestCategoryData($request){
        return [
             'name' => $request->categoryName
        ];

    }

}
