<?php

namespace App\Http\Controllers\DataCollection;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    // Branches
    public function index(){
        // $branches=Branches::all();
        return view('data_collection/branches');
    }

    public function branches_store(Request $req){
        $req->validate([
            'branchName'=>'required|string|max:250|unique:branches,branchName',
            'region'=>'required|string|max:250'
        ]);

        $branch=Branches::create($req->all());

        return response()->json([
            'success'=> true,
            'message'=>'Branch Added Successfully!',
            'branch'=>[
                'id'=> $branch->id,
                'branchName'=>$branch->branchName,
                'region'=>$branch->region,
                'created_at'=> $branch->created_at->format('d/m/Y g:ia')
            ]
        ]);
    }

    public function branches_datatable(){
        $branches = Branches::all();
        return response()->json([
            'data'=>$branches->map(function($branch){
                return [
                    'id'=> $branch->id,
                    'branchName'=> $branch->branchName,
                    'region'=> $branch->region,
                    'created_at'=>$branch->created_at->format('d/m/Y g:ia'),
                    'actions'=>'
                        <button data-id="'.$branch->id.'" 
                            data-name="'.$branch->branchName.'" data-region="'.$branch->region.'"
                            class="button info outline editBtn">Edit</button>
                        <button data-id="'.$branch->id.'" 
                            class="button primary outline deleteBtn">Delete</button>
                        '
                ];
            })
        ]);
    }

    public function branches_update(Request $req, $id){
        $req->validate([
            'branchName'=>'required|string|max:250|unique:branches,branchName',
            'region'=>'required|string|max:250'
        ]);

        $branch = Branches::findOrFail($id);
        $branch->update($req->all());

        return response()->json([
            'success'=> true,
            'message'=> 'Branch Updated Successfully!',
            'data'=> [
                'id'=> $branch->id,
                'branchName'=> $branch->branchName,
                'region'=> $branch->region,
            ]
        ]);
    }

    public function branches_destroy(Request $req, $id){
        $branch = Branches::findOrFail($id)->delete();
        
        return response()->json([
            'success'=> true,
            'message'=> 'Branch Deleted Successfully!'
        ]);
    }

    public function bulk_branch_destroy(Request $req, ){
        Branches::whereIn('id', $req->ids)->delete();

        return response()->json([
            'success'=> true,
            'message' => 'Branches deleted successfully!'
        ]);
    }
}
