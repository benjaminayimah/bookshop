<?php

namespace App\Http\Controllers;

use App\Newsletter;
use App\Wishlist;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Http\Request;
use App\User;
use App\Session;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function registerUser(Request $request){

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|max:120',
            'password' => 'required|confirmed|min:4'
        ]);
        $user = new User();
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->password = bcrypt($request['password']);

        $user->save();
        return redirect()->back()->with('status', 'Account created!');
    }
    public function loginUser(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request['_token'];
        $rememberMe = $request['rememberMe'];
        $email = $request['email'];
        $password = $request['password'];
        if ($rememberMe == 'on'){
            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                // The user is being remembered...
                $user = User::where('email', $request->email)->first();
                if ($request['type'] == '_cart'){
                    if ($request->session()->exists('bookIdses')) {
                        $session = session('bookIdses');
                        $session_cart = DB::table('sessions')->where('token', $session)->get();
                        $i = 0;
                        foreach ($session_cart as $ss){
                            $checkBook = DB::table('carts')->where([
                                ['user_id', '=', Auth::id()],
                                ['itemId', '=', $ss->itemId]
                            ])->first();
                            if ($checkBook){
                                $thisId = $checkBook->id;
                                $thisQnty = $checkBook->quantity;
                                $newEntry = Cart::find($thisId);
                                $newEntry->quantity = $thisQnty + $ss->quantity;
                                $newEntry->update();
                            }else{
                                $auth_cart = new Cart();
                                $auth_cart->user_id = Auth::id();
                                $auth_cart->itemId = $ss->itemId;
                                $auth_cart->quantity = $ss->quantity;
                                $auth_cart->token = $ss->token;
                                $auth_cart->save();
                            }
                            $del = Session::find($ss->id);
                            $del->delete();
                            session()->forget('bookIdses');
                            $i++;
                        }
                    }
                    return redirect()->back()->with('status', 'Login success!');
                }
                if($user->is_admin()){
                    if ($request->session()->exists('bookIdses')) {
                        $session = session('bookIdses');
                        $session_cart = DB::table('sessions')->where('token', $session)->get();
                        $i = 0;
                        foreach ($session_cart as $ss){
                            $checkBook = DB::table('carts')->where([
                                ['user_id', '=', Auth::id()],
                                ['itemId', '=', $ss->itemId]
                            ])->first();
                            if ($checkBook){
                                $thisId = $checkBook->id;
                                $thisQnty = $checkBook->quantity;
                                $newEntry = Cart::find($thisId);
                                $newEntry->quantity = $thisQnty + $ss->quantity;
                                $newEntry->update();
                            }else{
                                $auth_cart = new Cart();
                                $auth_cart->user_id = Auth::id();
                                $auth_cart->itemId = $ss->itemId;
                                $auth_cart->quantity = $ss->quantity;
                                $auth_cart->token = $ss->token;
                                $auth_cart->save();
                            }
                            $del = Session::find($ss->id);
                            $del->delete();
                            session()->forget('bookIdses');
                            $i++;
                        }
                    }
                    return redirect()->route('dashboard')->with('status', 'Welcome '.Auth::user()->name);
                }
                return redirect()->route('welcome')->with('status', 'Welcome '.Auth::user()->name);
            }
            return redirect()->back()->with('status2', 'Wrong Credentials');
        }else{
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                // Authentication passed...
                $user = User::where('email', $request->email)->first();
                if ($request['type'] == '_cart'){
                    if ($request->session()->exists('bookIdses')) {
                        $session = session('bookIdses');
                        $session_cart = DB::table('sessions')->where('token', $session)->get();
                        $i = 0;
                        foreach ($session_cart as $ss){
                            $checkBook = DB::table('carts')->where([
                                ['user_id', '=', Auth::id()],
                                ['itemId', '=', $ss->itemId]
                            ])->first();
                            if ($checkBook){
                                $thisId = $checkBook->id;
                                $thisQnty = $checkBook->quantity;
                                $newEntry = Cart::find($thisId);
                                $newEntry->quantity = $thisQnty + $ss->quantity;
                                $newEntry->update();
                            }else{
                                $auth_cart = new Cart();
                                $auth_cart->user_id = Auth::id();
                                $auth_cart->itemId = $ss->itemId;
                                $auth_cart->quantity = $ss->quantity;
                                $auth_cart->token = $ss->token;
                                $auth_cart->save();
                            }
                            $del = Session::find($ss->id);
                            $del->delete();
                            session()->forget('bookIdses');
                            $i++;
                        }
                    }
                    return redirect()->back()->with('status', 'Login success!');
                }
                if($user->is_admin()){
                    if ($request->session()->exists('bookIdses')) {
                        $session = session('bookIdses');
                        $session_cart = DB::table('sessions')->where('token', $session)->get();
                        $i = 0;
                        foreach ($session_cart as $ss){
                            $checkBook = DB::table('carts')->where([
                                ['user_id', '=', Auth::id()],
                                ['itemId', '=', $ss->itemId]
                            ])->first();
                            if ($checkBook){
                                $thisId = $checkBook->id;
                                $thisQnty = $checkBook->quantity;
                                $newEntry = Cart::find($thisId);
                                $newEntry->quantity = $thisQnty + $ss->quantity;
                                $newEntry->update();
                            }else{
                                $auth_cart = new Cart();
                                $auth_cart->user_id = Auth::id();
                                $auth_cart->itemId = $ss->itemId;
                                $auth_cart->quantity = $ss->quantity;
                                $auth_cart->token = $ss->token;
                                $auth_cart->save();
                            }
                            $del = Session::find($ss->id);
                            $del->delete();
                            session()->forget('bookIdses');
                            $i++;
                        }
                    }
                    return redirect()->route('dashboard')->with('status', 'Welcome '.Auth::user()->name);
                }
                return redirect()->route('welcome')->with('status', 'Welcome '.Auth::user()->name);

            }
            return redirect()->back()->with('status2', 'Wrong Credentials');
        }

        
    }
    public function getLoginForm() {

        $cart_count = 0;
        if(Auth::user()){
            $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        } elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $cart_count = DB::table('sessions')->where('token', $session)->count();
        }

        return view('users-login', [
            'count' => $cart_count
        ]);
    }
    public function getRegisterForm() {

        $cart_count = 0;
        if(Auth::user()){
            $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        } elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $cart_count = DB::table('sessions')->where('token', $session)->count();
        }

        return view('users-register', [
            'count' => $cart_count
        ]);
    }
    public function getDashboard(){

        $books = DB::table('books')->get();
        $book_cout = count($books);

        return view('dashboard.admin-dashboard', [
            'book_count' => $book_cout
        ]);
    }
    public function postLogout(){
        Auth::logout();
        return redirect()->route('welcome');
    }
    public function getCustomerAccHm(){
        $cart_count = 0;
        $address = null;
        $accDetail = null;
        if(Auth::user()){
            $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
            $address = DB::table('addresses')->where('user_id', Auth::id())->first();
            $accDetail = DB::table('users')->where('id', Auth::id())->first();

        }
        return view('userAccount', [
            'count' => $cart_count,
            'address' => $address,
            'accDetails' => $accDetail
        ]);
    }
    public function getCustomerAccOrders(){
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        $orders = DB::table('orderscounters')->where([
            ['user_id', '=', Auth::id()],
            ['status', '!=', '0'],
            ['delete_status', '=', '0']
        ])->orderBy('created_at', 'DESC')->get();

        return view('userAccountOrders', [
            'count' => $cart_count,
            'orders' => $orders
        ]);
    }
    public function getCustomerAccWishlist(){
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        $wish = array();
        $wishlist = DB::table('books')
            ->leftJoin('wishlists', 'books.id', '=', 'wishlists.item_id')
            ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
            ->where('wishlists.user_id', '=', Auth::id())
            ->select('books.title','books.price','books.discount','books.image', 'wishlists.*', 'categories.category')
            ->orderBy('created_at', 'desc')
            ->get();
        if(isset($wishlist)){
            $wish = $wishlist;
        }
        return view('userAccountWishlist', [
            'count' => $cart_count,
            'wishlist' => $wish
        ]);
    }
    public function postGetdeliveryadd(){
        $hasAd = 0;
        $checkAd = DB::table('addresses')->where('user_id', Auth::id())->first();
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        if (isset($checkAd)){
            $hasAd = 1;
        }
        return view('add-delivery-address',[
            'hasAddress' => $hasAd,
            'address' => $checkAd,
            'count' => $cart_count
        ]);
    }
    public function getEditcustacct($key){

        $user = DB::table('users')->where('id', Auth::id())->first();
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        return view('edit-customer-acc', [
            'user' => $user,
            'count' => $cart_count,
            'key' => $key
        ]);
    }
    public function postEditcustacct(Request $request){
        $this->validate($request, [
            'name' => 'required|max:120'
        ]);
        $gender = $request['genderRadio'];
        if ($gender != null){
            if ($gender == 1){
                $gender = 'male';
            }else{
                $gender = 'female';
            }
        }
        $user = User::find(Auth::id());
        $user->name = $request['name'];
        $user->gender = $gender;
        $user->update();

        return redirect()->route('get.customerAccHome')->with('status', 'Account successfully updated');
    }
    public function postChangepass(Request $request){

        $this->validate($request, [
            'currentPassword' => 'required',
            'newPassword' => 'required|confirmed|min:4'
        ]);
        $oldpass = $request['currentPassword'];
        $user = DB::table('users')->where('id', Auth::id())->first();
        if (Auth::attempt(['id' => Auth::id(), 'password' => $oldpass])) {
            $update = User::find(Auth::id());
            $update->password = bcrypt($request['newPassword']);
            $update->update();
            return redirect()->route('get.customerAccHome')->with('status', 'Password successfully updated');
        }else{
            return redirect()->back()->with('status2', 'Incorrect current password');
        }

    }
    public function postWishList(Request $request){
        if (Auth::user()){
            $id =  $request['input'];
            $check = DB::table('wishlists')->where([
                ['user_id', '=', Auth::id()],
                ['item_id', '=', $id]
            ])->first();
            if (isset($check)){
                return response()->json(['msg' => 'This item is already in your wish list'], 200);
            }else{
                $wish = new Wishlist();
                $wish->user_id = Auth::id();
                $wish->item_id = $id;
                $wish->save();
                return response()->json(['msg' => 'This item is added to your wish list'], 200);
            }
        }else{
            return response()->json(['error' => 'Please login to continue'], 500);
        }

    }
    public function postremvWishI(Request $request){
        if (Auth::user()){
            $findQuery = DB::table('wishlists')->where([
                ['user_id', '=', Auth::id()],
                ['id', '=', $request['input']]
            ])->first();
            $del = Wishlist::find($findQuery->id);
            $del->delete();
            return redirect()->back()->with('status', 'Item is deleted');
        }
        return redirect()->back()->with('status2', $php_errormsg);
    }
    public function postNewsletter(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $checkQuery = DB::table('newsletters')->where('email', $request['email'])->first();
        if ($checkQuery){
            $request->session()->put('newsletter_token', $request['_token']);
            return back()->with('status2', 'Status! you have already subscribed to our newsletter. Thank you.');
        }else{

            $newsletter = new Newsletter();
            $newsletter->email = $request['email'];
            $newsletter->save();
            $token = $request['_token'];
            cookie()->forever('newsletter_token', $token);


            return back()->with('status', 'Success! you are added to our newsletter list');
        }

    }
    public function postNewsLtoken(Request $request){
        $token = $request['_token'];
        session(['newsletter_token' => $token]);
        return response()->json(['msg' => 'success'], 200);
    }


}
