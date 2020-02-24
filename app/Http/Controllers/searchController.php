<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class searchController extends Controller
{
    public function getSearchparam(){

        if (Input::has('search')){
            $key = Input::get('search');
            if ($key == null){
                $book = array();
                $category = array();
                return response()->json([
                    'key' => $key,
                    'books' => $book,
                    'categories' => $category
                ], 200);

            }else{
                $book = DB::table('books')
                    ->where('title', 'LIKE', '%'.$key.'%')
                    ->select('id', 'title', 'image')
                    ->orderBy('title')->get();
                $category = DB::table('categories')
                    ->where('category', 'LIKE', '%'.$key.'%')
                    ->select('id', 'category')
                    ->orderBy('id')->get();
                $sub_category1 = DB::table('sub_category1s')
                    ->where('sub_category1', 'LIKE', '%'.$key.'%')
                    ->orderBy('id')->get();
                $sub_category2 = DB::table('sub_category2s')
                    ->where('sub_category2', 'LIKE', '%'.$key.'%')
                    ->orderBy('id')->get();
                return response()->json([
                    'key' => $key,
                    'books' => $book,
                    'categories' => $category
                ], 200);
            }

        }if (Input::has('searchparam')){
            $key = Input::get('searchparam');
            $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
            if ($key == null){
                $book = array();
                $category = array();
                return view('search', [
                    'count' => $cart_count,
                    'key' => $key,
                    'books' => $book,
                    'category' => $category
                ]);

            }else{
                $book = DB::table('books')
                    ->where('title', 'LIKE', '%'.$key.'%')
                    ->orderBy('title')->get();
                $category = DB::table('categories')
                    ->where('category', 'LIKE', '%'.$key.'%')
                    ->orderBy('id')->get();
                $sub_category1 = DB::table('sub_category1s')
                    ->where('sub_category1', 'LIKE', '%'.$key.'%')
                    ->orderBy('id')->get();
                $sub_category2 = DB::table('sub_category2s')
                    ->where('sub_category2', 'LIKE', '%'.$key.'%')
                    ->orderBy('id')->get();

                return view('search', [
                    'count' => $cart_count,
                    'key' => $key,
                    'books' => $book,
                    'category' => $category
                ]);
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function getdefaultpage(){

        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();

        return view('default-page', [
            'count' => $cart_count
        ]);
    }
}
