<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class CategoryController extends Controller
{
    //

    public function index(){
    	$category = Category::all();

    	return Response()->json(compact('category'));
    }

    public function store(Request $request){
    	$this->validate($request,['category_name'=>'required']);
    	$data = $request->all();
    	$data['slug']=str_slug($request->get('category_name'));
    	$category = Category::create($data);
    	return Response()->json(['category'=>$category,
    							 'status'=>200]);
    }

    public function show($id){
    	$category = Category::find($id);
    	if (!$category) {
    		return Response()->json(['error'=>"Category Not Found"],404);
    	}
    	return $category;
    }

      public function update(Request $request,$id){
    	$this->validate($request,['category_name'=>'required']);

		$data = $request->all();
		$data['slug']=str_slug($request->get('category_name'));
    	$category = Category::find($id);
    	/**
    	 *
    	 * HOW TO EDIT DATA WITH OWNERSHIP DATA
    	 *
    	 */

    	// if ($request->user()->id != $category->user_id) {
    	// 	return Response()->json(['error'=>'cannot Edit this category'])
    	// }
    	
    	$category->update($data);
    
    	return Response()->json(['category'=>$category,
    							 'status'=>200]);
    }
     public function delete(Request $request,$id){
   
    	$category = Category::find($id);
    	/**
    	 *
    	 * HOW TO DELETE DATA WITH OWNERSHIP DATA
    	 *
    	 */

    	// if ($request->user()->id != $category->user_id) {
    	// 	return Response()->json(['error'=>'cannot Edit this category'])
    	// }
    	
    	$category->delete();
    
    	return Response()->json(['status'=>200]);
    }

}
