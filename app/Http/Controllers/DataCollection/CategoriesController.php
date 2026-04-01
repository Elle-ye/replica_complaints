<?php

namespace App\Http\Controllers\DataCollection;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index(){
        // $branches=Branches::all();
        return view('data_collection/categories');
    }

    // For initial Category and Sub-Category Addition
    public function category_store(Request $req){
        $req->validate([
            'categoryName'=>'required|string|max:250|unique:categories,categoryName',
            'subCategoryName'=> 'required|string|max:250'
        ]);
        $category = null;
        $subCategory = null;

        DB::transaction(function() use ($req, &$category, &$subCategory) {
            $category = Category::create([
                'categoryName' => $req->categoryName
            ]);

            $subCategory = SubCategory::create([
                'category_id' => $category->id,
                'subCategoryName' => $req->subCategoryName
            ]);
        });

        return response()->json([
            'success'=> true,
            'message'=>'Category Added Successfully!',
            'category'=>[
                'id'=> $category->id,
                'categoryName'=>$category->categoryName,
                'subCategoryName'=>$subCategory->subCategoryName,
                'created_at'=> $category->created_at->format('d/m/Y g:ia')
            ]
        ]);
    }

    // For Subsequent Sub-Category addition
    public function subcategory_store(Request $req){
        $req->validate([
            'category_id'=>'required|exists:categories,id',
            'subCategoryName'=> [
                'required',
                'string',
                'max:250',
            // ✅ unique within the same category
                Rule::unique('sub_categories', 'subCategoryName')
                ->where('category_id', $req->category_id)
        ]
        ]);

        SubCategory::create($req->all());

        return response()->json([
            'success'=> true,
            'message'=>'Sub-Category Added Successfully!',
        ]);
    }

    public function category_datatable(){
        $categories = Category::with('subCategory')->get();
        return response()->json([
            'data'=>$categories->map(function($category){
                $subCategoryList = $category->subCategory
                ->pluck('subCategoryName')
                ->join(', ');

                return [
                    'id'=> $category->id,
                    'categoryName'=> $category->categoryName,
                    'subCategory'=> $subCategoryList,
                    'created_at'=>$category->created_at->format('d/m/Y g:ia'),
                    'actions'=>'
                       <button data-id="'.$category->id.'"
                            class="button info outline addSubCategoryBtn">+ Sub-Category</button>
                        <button data-id="'.$category->id.'" 
                            data-name="'.$category->categoryName.'"
                            class="button info outline editBtn">Edit</button>
                        <button data-id="'.$category->id.'" 
                            class="button primary outline deleteBtn">Delete</button>
                        '
                ];
            })
        ]);
    }

    public function get_subcategories($category_id){
        $subCategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subCategories);
    }

    // public function branches_update(Request $req, $id){
    //     // $req->validate([
    //     //     'branchName'=>'required|string|max:250|unique:branches,branchName',
    //     //     'region'=>'required|string|max:250'
    //     // ]);

    //     // $branch = Branches::findOrFail($id);
    //     // $branch->update($req->all());

    //     // return response()->json([
    //     //     'success'=> true,
    //     //     'message'=> 'Branch Updated Successfully!',
    //     //     'data'=> [
    //     //         'id'=> $branch->id,
    //     //         'branchName'=> $branch->branchName,
    //     //         'region'=> $branch->region,
    //     //     ]
    //     // ]);
    // }

    // public function branches_destroy(Request $req, $id){
    //     // $branch = Branches::findOrFail($id)->delete();
        
    //     // return response()->json([
    //     //     'success'=> true,
    //     //     'message'=> 'Branch Deleted Successfully!'
    //     // ]);
    // }

    // public function bulk_branch_destroy(Request $req, ){
    //     // Branches::whereIn('id', $req->ids)->delete();

    //     // return response()->json([
    //     //     'success'=> true,
    //     //     'message' => 'Branches deleted successfully!'
    //     // ]);
    // }
}
