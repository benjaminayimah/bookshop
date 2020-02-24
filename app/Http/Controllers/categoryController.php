<?php

namespace App\Http\Controllers;

use App\Categories;
use App\SubCategory1;
use App\SubCategory2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class categoryController extends Controller
{
    public function getCategory(){
        $categories = '';

        $categories  = DB::table('categories')->paginate(10);
        $subCategories = DB::table('sub_category1s')->get();

        return view('dashboard.categories',[
            'categories' => $categories,
            'subCategories' => $subCategories
        ]);

    }
    public function postCategory(Request $request){

        $this->validate($request, [
            'category' => 'required',
        ]);
        $categori = trim($request['category']);
        $checkcat = DB::table('categories')->where('category', $categori)->get();

        $coun = count($checkcat);
        if ($coun < 1){
            $category = new Categories();
            $category->category = $categori;
            $category->save();
            return redirect()->back();
        }
        return redirect()->back()->with('status2', 'Category already exist!!!');

    }
    public function editCategory(Request $request){

        $id = $request['catID'];
        $input = trim($request['input']);

        $category = Categories::find($id);
        $category->category = $input;

        $category->update();
        return response()->json(['msg' => 'Category updated'],200);
    }
    public function delCategory(Request $request){
        //check if user is authorized to delete
        $id = $request['catID'];

        $category = Categories::find($id);
        $category->delete();

        return response()->json(['msg' => 'Categories Deleted'],200);

    }

    public function postSubcategory1(Request $request){
        $this->validate($request, [
            'subCategory1' => 'required',
        ]);

        $mainCat = trim($request['catHidden']);
        $subCat = trim($request['subCategory1']);

            $checkTable = DB::table('sub_category1s')->where([
                ['sub_category1', '=', $subCat],
                ['cat_id', '=', $mainCat],
            ])->get();
        $countC = count($checkTable);
        if ($countC < '1'){
            $sub_category = new SubCategory1();
            $sub_category->cat_id = $mainCat;
            $sub_category->sub_category1 = $subCat;
            $sub_category->save();
            return redirect()->back();
        }else{
            return redirect()->back()->with('status2', 'This sub category already exist!!!');

        }

    }
    public function postSubcategory2(Request $request){

        $this->validate($request, [
            'SubCategory2' => 'required',
        ]);

        $mainCat = $request['catHidden'];
        $subCat1 = $request['SubcatHidden'];
        $subCat2 = trim($request['SubCategory2']);

        $checkTable = DB::table('sub_category2s')->where([
            ['sub_catid', '=', $subCat1],
            ['cat_id', '=', $mainCat],
        ])->first();
        if ($checkTable){
            $result = $checkTable->sub_category2;
            if ($result != $subCat2){

                $sub_category = new SubCategory2();
                $sub_category->cat_id = $mainCat;
                $sub_category->sub_catid = $subCat1;
                $sub_category->sub_category2 = $subCat2;
                $sub_category->save();
                return redirect()->back();
            }else{
                return redirect()->back()->with('status2', 'This sub category already exist!!!');
            }
        }
        else{

            $sub_category = new SubCategory2();
            $sub_category->cat_id = $mainCat;
            $sub_category->sub_catid = $subCat1;
            $sub_category->sub_category2 = $subCat2;
            $sub_category->save();
            return redirect()->back();
        }

    }
    public function loadsubCategories(Request $request){
        $content = trim($request['content']);

        $subCategory = DB::table('sub_category1s')->where('cat_id', $content)->get();
        return response()->json(['msg' => $subCategory],200);

    }

    public function loadsubcate2(Request $request){
        $catID = trim($request['catID']);
        $subcatID = trim($request['subcatID']);

        $subCategory2 = DB::table('sub_category2s')->where([
            ['cat_id', '=', $catID],
            ['sub_catid', '=', $subcatID],
            ])->get();
        return response()->json(['msg' => $subCategory2],200);
    }
    public function fetchOpt(Request $request){

        $content = trim($request['content']);

        $subCategory = DB::table('sub_category1s')->where('cat_id', $content)->get();
        return response()->json(['msg' => $subCategory],200);
    }
    public function fetchCate(Request $request){
        $content = trim($request['content']);
        $subCate = DB::table('sub_category1s')->where('category', $content)->get();
        return response()->json(['msg' => $subCate],200);

    }
    public function fetchSubOpt(Request $request){
        $main_cat = $request['content'];
        $sub_cat = $request['content2'];
        $sub_subcat = DB::table('sub_category2s')->where([
            ['cat_id', '=', $main_cat],
            ['sub_catid', '=', $sub_cat],
        ])->get();
        return response()->json(['msg' => $sub_subcat],200);
    }
    function getEditSub1(Request $request){
        $id = trim($request['id']);

        $query = DB::table('sub_category1s')->where('id', $id)->first();

        return response()->json(['msg' => $query],200);
    }
    public function postEditSub1(Request $request){
        $this->validate($request, [
            'SubCategory' => 'required',
        ]);

        $id = $request['hidden'];
        $input = $request['SubCategory'];

        $check = DB::table('sub_category1s')->get();
        foreach ($check as $checks){
            $result = $checks->sub_category1;

            if ($result == $input){
                return redirect()->back()->with('status2', 'Item already exist!');

            }
        }

        $edit = SubCategory1::find($id);
        $edit->sub_category1 = $input;

        $edit->update();
        return redirect()->back()->with('status', 'Item successfully updated!');

    }
    function getEditSub2(Request $request){
        $id = trim($request['id']);

        $query = DB::table('sub_category2s')->where('id', $id)->first();

        return response()->json(['msg' => $query],200);
    }
    public function postEditSub2(Request $request){
        $this->validate($request, [
            'SubCategory' => 'required',
        ]);

        $id = $request['hidden'];
        $input = $request['SubCategory'];

        $check = DB::table('sub_category2s')->get();
        foreach ($check as $checks){
            $result = $checks->sub_category2;

            if ($result == $input){
                return redirect()->back()->with('status2', 'Item already exist!');

            }
        }

        $edit = SubCategory2::find($id);
        $edit->sub_category2 = $input;

        $edit->update();
        return redirect()->back()->with('status', 'Item successfully updated!');

    }
    public function postDelsub1(Request $request){
        //check if user is authorized to delete
        $id = $request['id'];

        $subCategory = SubCategory1::find($id);
        $subCategory->delete();


        return response()->json(['msg' => 'Item succefully deleted'], 200);
    }
    public function postDelsub2(Request $request){
        //check if user is authorized to delete
        $id = $request['id'];

        $subCategory = SubCategory2::find($id);
        $subCategory->delete();


        return response()->json(['msg' => 'Item succefully deleted'], 200);
    }

    public function loadbimg(Request $request){
        return response()->json(['msg' => 'success'],200);

        /*if ($_FILES['file']['name'] != ''){
            $file_name = $_FILES['file']['name'];
            return response()->json(['msg' => $file_name],200);
        }*/
    }
}
