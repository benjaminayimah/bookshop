<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class bookController extends Controller{
    public function getHomepage(){

        $books = DB::table('books')->orderBy('id', 'desc')->get();
        $catergories = DB::table('categories')->limit('9')->orderBy('category', 'ASC')->get();

        $sub_cat = DB::table('sub_category1s')->get();
        $sub_cat2 = DB::table('sub_category2s')->get();

        $cart_count = 0;
        if(Auth::user()){
            $auth_cart = DB::table('carts')->where('user_id', Auth::id())->get();
            $cart_count = $auth_cart->count();
        } elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $ses_cart = DB::table('sessions')->where('token', $session)->get();
            $cart_count = $ses_cart->count();
        }

        return view('welcome', [
            'books' => $books,
            'count' => $cart_count,
            'categories' => $catergories,
            'subCat' => $sub_cat,
            'subCat2' => $sub_cat2,

        ]);
    }
    public function getbookfromcategory($name, $id){
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();

        $thisbook = DB::table('books')->where('cat_id', $id)->get();

        return view('booksfromcategory', [
            'category' => $name,
            'count' => $cart_count,
            'books' => $thisbook
        ]);

    }
    public function getPagejs(Request $request){

        $books = DB::table('books')->where('id', $request['content'])->first();

        return response()->json(['msg' => $books], 200);

    }

    public function getbooksUpload(){
        $init_price = '';
        $total_price = '';

        $categories  = DB::table('categories')->get();

        $books = DB::table('books')->get();

        $bookscount = count($books);

        if ($bookscount > 0){

            $books = DB::table('books')
                ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
                ->leftJoin('sub_category1s', 'books.sub_catid', '=', 'sub_category1s.id')
                ->leftJoin('sub_category2s', 'books.sub_catid2', '=', 'sub_category2s.id')
                ->select('books.*', 'categories.category', 'sub_category1s.sub_category1', 'sub_category2s.sub_category2')
                ->orderBy('books.id', 'desc')
                ->paginate(8);
        }else{
            $books = '';
        }
        $latestBook = DB::table('books')
            ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
            ->leftJoin('sub_category1s', 'books.sub_catid', '=', 'sub_category1s.id')
            ->leftJoin('sub_category2s', 'books.sub_catid2', '=', 'sub_category2s.id')
            ->select('books.*', 'categories.category', 'sub_category1s.sub_category1', 'sub_category2s.sub_category2')
            ->latest()->first();

        if ($latestBook){
            $init_price = $latestBook->price;
            $dis = $latestBook->discount;
            if ($dis > 0){
                $rate = $latestBook->discount;
                $percent = $rate/100;
                $discount_price = $percent * $init_price;
                $total = $init_price - $discount_price;
                $total_price = number_format($total, 2);
            }

        }
        return view('dashboard.books-upload',[
            'categories' => $categories,
            'books' => $books,
            'latestBook' => $latestBook,
            'late_init_price' => $init_price,
            'late_total_price' => $total_price,
        ]);
    }
    public function getallbooks(){

        $books = DB::table('books')->orderBy('id', 'desc')->get();
        $bookscount = count($books);
        if ($bookscount > 0){
            $books = DB::table('books')
                ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
                ->leftJoin('sub_category1s', 'books.sub_catid', '=', 'sub_category1s.id')
                ->leftJoin('sub_category2s', 'books.sub_catid2', '=', 'sub_category2s.id')
                ->select('books.*', 'categories.category', 'sub_category1s.sub_category1', 'sub_category2s.sub_category2')
                ->orderBy('books.id', 'desc')
                ->paginate(8);
        }else{
            $books = '';
        }

        return view('dashboard.all-books',[
            'books' => $books,
        ]);
    }

    public function postUploadbook(Request $request){

        if($request['price'] == null){
            $request['price'] = 0;
        }if($request['discount'] == null){
            $request['discount'] = 0;
        }
        $description = $request['description'];
        if($request['description'] == null){
            $description = 'N/A';
        }

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'bookImage' => 'required',
            'discount' => 'numeric',
            'price' => 'numeric'
        ]);
        $bs = $request['bestSeller'];
        $new = $request['new_arrival'];
        $featured = $request['featured'];
        if ($bs == 'on'){
            $bestSeller = true;
        }else{
            $bestSeller = false;
        }
        if ($new == 'on'){
            $new_arrival = true;
        }else{
            $new_arrival = false;
        }
        if ($featured == 'on'){
            $featured_book = true;
        }else{
            $featured_book = false;
        }
        $existQuery = DB::table('books')->where([
            ['title', '=', $request['title']],
            ['cat_id', '=', $request['category']]
        ])->count();
        if ($existQuery >= 1){
            return redirect()->back()->with('status2', 'Item already exist under the same category');
        }else{
            $rawfile = $_FILES['bookImage']["name"];
            $split = explode(".", $rawfile);
            $fileExt = end($split);
            $imgtitle = strtolower($request['title']);
            $imgFinaltitle = preg_replace('#[^a-z0-9]#i', '', $imgtitle);
            $filename = $imgFinaltitle . '_'. rand(1,999999999) . '.'. $fileExt;

            $book = new Book();
            $book->title = $request['title'];
            $book->cat_id = trim($request['category']);
            $book->price = $request['price'];
            $book->discount = $request['discount'];
            $book->image = $filename;
            $book->isbn = $request['isbn'];
            $book->book_author = $request['bookAuthor'];
            $book->sub_catid = trim($request['subCategory1']);
            $book->sub_catid2 = trim($request['subCategory2']);
            $book->new_arrivals = $new_arrival;
            $book->featured_books = $featured_book;
            $book->author = Auth::user()->name;
            $book->author2 = Auth::user()->name;
            $book->description = $description;
            $book->publisher = $request['publisher'];
            $book->best_seller = $bestSeller;

            $book->save();
            $file = $request->file('bookImage');
            if ($file){
                Storage::disk('local')->put($filename, File::get($file));

            }
            return redirect()->back()->with('status', 'Item Uploaded Successfully!!!');
        }

    }
    public function getbookimg($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function editBook(Request $request){
        $id = trim($request['bkID']);

        $getbook = DB::table('books')->where('id', $id)->first();
        $categories  = DB::table('categories')->get();
        $bookcat = $getbook->category;
        $subCategory = DB::table('sub_category1s')->where('category', $bookcat)->get();

        return response()->json([
            'book' => $getbook,
            'categories' => $categories,
            'subCategory' => $subCategory
        ],200);
    }
    public function getbookEdit($book){
        $categories  = DB::table('categories')->get();
        $init_price = '';
        $total_price = '';

        $thisBook = DB::table('books')
            ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
            ->leftJoin('sub_category1s', 'books.sub_catid', '=', 'sub_category1s.id')
            ->leftJoin('sub_category2s', 'books.sub_catid2', '=', 'sub_category2s.id')
            ->where('books.id', '=', $book)
            ->select('books.*', 'categories.category', 'sub_category1s.sub_category1', 'sub_category2s.sub_category2')
            ->first();
        if ($thisBook){
            $init_price = $thisBook->price;
            $dis = $thisBook->discount;
            if ($dis > 0){
                $rate = $thisBook->discount;
                $ini_price = $thisBook->price;
                $percent = $rate/100;
                $discount_price = $percent * $ini_price;
                $total = $init_price - $discount_price;
                $total_price = number_format($total, 2);
            }
        }else{
            $thisBook = '';
        }

        return view('dashboard.edit-book', [
            'categories' => $categories,
            'thisBook' => $thisBook,
            'total_price' => $total_price,
            'init_price' => $init_price,
        ]);

    }
    public function postEditedBook(Request $request){

        if($request['price'] == null){
            $request['price'] = 0;
        }if($request['discount'] == null){
            $request['discount'] = 0;
        }
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'discount' => 'numeric',
            'price' => 'numeric'
        ]);

        $id = trim($request['bookid']);
        $old_image = trim($request['imgbookOld']);
        $img_name = $request['bookImage'];

        $bs = $request['bestSeller'];
        $new = $request['new_arrival'];
        $featured = $request['featured'];
        if ($bs == 'on'){
            $bestSeller = true;
        }else{
            $bestSeller = false;
        }
        if ($new == 'on'){
            $new_arrival = true;
        }else{
            $new_arrival = false;
        }
        if ($featured == 'on'){
            $featured_book = true;
        }else{
            $featured_book = false;
        }

        if($img_name){
            $rawfile = $_FILES['bookImage']["name"];
            $split = explode(".", $rawfile);
            $fileExt = end($split);
            $imgtitle = strtolower($request['title']);
            $imgFinaltitle = preg_replace('#[^a-z0-9]#i', '', $imgtitle);

            $filename = $imgFinaltitle . '_'. rand(1,999999999) . '.'. $fileExt;

            $book = Book::find($id);
            $book->title = $request['title'];
            $book->cat_id = trim($request['category']);
            $book->price = $request['price'];
            $book->discount = $request['discount'];
            $book->image = $filename;
            $book->isbn = $request['isbn'];
            $book->book_author = $request['bookAuthor'];
            $book->sub_catid = trim($request['subCategory1']);
            $book->sub_catid2 = trim($request['subCategory2']);
            $book->new_arrivals = $new_arrival;
            $book->featured_books = $featured_book;
            $book->author2 = Auth::user()->name;
            $book->description = $request['description'];
            $book->publisher = $request['publisher'];
            $book->best_seller = $bestSeller;

            $book->update();

            Storage::disk('local')->delete($old_image);

            $file = $request->file('bookImage');
            if ($file){
                Storage::disk('local')->put($filename, File::get($file));
            }
            return redirect()->back();

        }else{
            $book = Book::find($id);
            $book->title = $request['title'];
            $book->cat_id = trim($request['category']);
            $book->price = $request['price'];
            $book->discount = $request['discount'];
            $book->isbn = $request['isbn'];
            $book->book_author = $request['bookAuthor'];
            $book->sub_catid = trim($request['subCategory1']);
            $book->sub_catid2 = trim($request['subCategory2']);
            $book->new_arrivals = $new_arrival;
            $book->featured_books = $featured_book;
            $book->author2 = Auth::user()->name;
            $book->description = $request['description'];
            $book->publisher = $request['publisher'];
            $book->best_seller = $bestSeller;

            $book->update();

            return redirect()->back();
        }

    }
    public function postBookItmdel(Request $request){

        $id = $request['bookID'];
        $img = $request['image'];


        $book = Book::find($id);
        $book->delete();

        Storage::disk('local')->delete($img);

        return response()->json(['msg' => $id], 200);
    }



    public function getbookpreview(Request $request){
        $id = $request['bkID'];
        $init_price = '';
        $total_price = '';

        $preview = DB::table('books')
            ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
            ->leftJoin('sub_category1s', 'books.sub_catid', '=', 'sub_category1s.id')
            ->leftJoin('sub_category2s', 'books.sub_catid2', '=', 'sub_category2s.id')
            ->where('books.id', '=', $id)
            ->select('books.*', 'categories.category', 'sub_category1s.sub_category1', 'sub_category2s.sub_category2')
            ->first();

        if ($preview){
            $init_price = $preview->price;
            $dis = $preview->discount;
            if ($dis > 0){
                $rate = $preview->discount;
                $ini_price = $preview->price;
                $percent = $rate/100;
                $discount_price = $percent * $ini_price;
                $total = $init_price - $discount_price;

                $total_price = number_format($total, 2);

            }
        }


        return response()->json([
            'msg' => $preview,
            'discounted' => $total_price,
            'oldprice' => $init_price
            ], 200);


    }
    public function getItemdetail($id) {

        $book = DB::table('books')->where('id', $id)->first();

        $cart_count = 0;
        if(Auth::user()){
            $auth_cart = DB::table('carts')->where('user_id', Auth::id())->get();
            $cart_count = $auth_cart->count();
        } elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $ses_cart = DB::table('sessions')->where('token', $session)->get();
            $cart_count = $ses_cart->count();
        }


        return view('item-detail', [
            'item' => $book,
            'count' => $cart_count
        ]);

    }
    public function getbooktype($id){
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        $books = array();
        if ($id ==='featured') {
            $books = DB::table('books')->where('featured_books', '1')->orderBy('title')->get();
            $key = 'Featured books';

            return view('book-type', [
                'count' => $cart_count,
                'key' => $key,
                'books' => $books
            ]);

        }
        if ($id === 'newarrivals') {
            $books = DB::table('books')->where('new_arrivals', '1')->orderBy('title')->get();
            $key = 'New arrivals';

            return view('book-type', [
                'count' => $cart_count,
                'key' => $key,
                'books' => $books
            ]);

        }
        if ($id === 'bestseller') {
            $books = DB::table('books')->where('best_seller', '1')->orderBy('title')->get();
            $key = 'Best sellers';

            return view('book-type', [
                'count' => $cart_count,
                'key' => $key,
                'books' => $books
            ]);

        }else{
            return view('book-type', [
                'count' => $cart_count,
                'key' => $id,
                'books' => $books
            ]);
        }
    }

}
