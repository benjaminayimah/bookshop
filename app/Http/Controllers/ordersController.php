<?php

namespace App\Http\Controllers;

use App\Address;
use App\Order;
use App\Orderscounter;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Session;


class ordersController extends Controller {

    public function postSession(Request $request) {
        $token = $request['_token'];
        $id =  $request['input'];
        $user_id = Auth::id();
        $thisBook = DB::table('books')->where('id', $id)->first();
        $session = null;
        if (session()->exists('bookIdses')){
            $session = session('bookIdses');
        }
        if(Auth::user()) {
            $check = DB::table('carts')->where([
                ['user_id', '=', Auth::id()],
                ['itemId', '=', $id]
            ])->first();

            if($check){
                $checkID = $check->id;
                $newQty = $check->quantity + 1;

                $newEntry = Cart::find($checkID);
                $newEntry->quantity = $newQty;

                $newEntry->update();

                return response()->json([
                    'msg' => 'Item is added to your cart!',
                    'state' => 0,
                    'title' => $thisBook->title
                ], 200);
            }else{
                $auth_cart = new Cart();
                $auth_cart->user_id = $user_id;
                $auth_cart->itemId = $id;
                $auth_cart->token = $token;

                $auth_cart->save();
                return response()->json([
                    'msg' => 'Item is added to your cart!',
                    'state' => 1,
                    'title' => $thisBook->title
                ], 200);
            }

        }else{
            $check = DB::table('sessions')->where([
                ['token', '=', $session],
                ['itemId', '=', $id]
            ])->first();

            if($check){
                $checkID = $check->id;
                $newQty = $check->quantity + 1;

                $newEntry = Session::find($checkID);
                $newEntry->quantity = $newQty;

                $newEntry->update();

                return response()->json([
                    'msg' => 'Item is added to your cart!',
                    'state' => 0,
                    'title' => $thisBook->title
                ], 200);

            }else{
                $ip = \Request::getClientIp(true);
                $newcart = new Session();
                $newcart->token = $token;
                $newcart->itemId = $id;
                $newcart->ip_address = $ip;
                $newcart->save();
                session(['bookIdses' => $token]);
                return response()->json([
                    'msg' => 'Item is added to your cart!',
                    'state' => 1,
                    'title' => $thisBook->title
                ], 200);

            }

        }

    }
    public function postDelCart(Request $request) {
        $id = $request['content'];

        if (Auth::user()) {

            $delCart = Cart::find($id);
            $delCart->delete();
            $checkCart = DB::table('carts')->where('user_id', '=', Auth::id())->get();
            if(count($checkCart) > 0){
                return response()->json(['status' => 'Cart item deleted successfully!'], 200);
            }else{
                $checkOldorder = DB::table('orders')->where([
                    ['user_id', '=', Auth::id()],
                    ['status', '=', '0']
                ])->get();
                if ($checkOldorder){
                    $k = 0;
                    foreach ($checkOldorder as $check){
                        $del = Order::find($check->id);
                        $del->delete();
                        $k++;
                    }
                    $checkCounter = DB::table('orderscounters')->where([
                        ['user_id', '=', Auth::id()],
                        ['status', '=', '0']
                    ])->first();
                    if ($checkCounter){
                        $del = Orderscounter::find($checkCounter->id);
                        $del->delete();
                    }

                }
                return response()->json(['status' => 'Cart item deleted successfully!'], 200);
            }
        }elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $ip = \Request::getClientIp(true);
            $delSessCart = Session::find($id);
            $delSessCart->delete();
            $checkCart = DB::table('sessions')->where([
                ['token', '=', $session],
                ['ip_address', '=', $ip]
            ])->get();
            if(count($checkCart) > 0){
                return response()->json(['status' => 'Cart item deleted successfully!'], 200);
            }else{
                $checkOldorder = DB::table('orders')->where([
                    ['session_id', '=', $session],
                    ['status', '=', '0']
                ])->get();
                if ($checkOldorder){
                    $k = 0;
                    foreach ($checkOldorder as $check){
                        $del = Order::find($check->id);
                        $del->delete();
                        $k++;
                    }
                    $checkCounter = DB::table('orderscounters')->where([
                        ['session_id', '=', $session],
                        ['status', '=', '0']
                    ])->first();
                    if ($checkCounter){
                        $del = Orderscounter::find($checkCounter->id);
                        $del->delete();
                    }

                }
                return response()->json(['status' => 'Cart item deleted successfully!'], 200);
            }

        }else{

            return response()->json(['status' => $php_errormsg], 500);
        }

    }
    public function getCart() {

        $cart = array();
        $orders = array();
        $cart_count = 0;


        if(Auth::user()){
            $cart = DB::table('books')
                ->leftJoin('carts', 'books.id', '=', 'carts.itemId')
                ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
                ->where('carts.user_id', '=', Auth::id())
                ->select('books.title','books.price','books.discount','books.image', 'carts.*', 'categories.category')
                ->orderBy('created_at', 'desc')
                ->get();
            $cart_count = $cart->count();
            $orders = DB::table('orderscounters')->where('user_id', Auth::id())->get();

            return view('cart', [
                'carts' => $cart,
                'count' => $cart_count,
                'orders' => $orders
            ]);


        }elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');

            $cart = DB::table('books')
                ->leftJoin('sessions', 'books.id', '=', 'sessions.itemId')
                ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
                ->where('sessions.token', '=', $session)
                ->select('books.title','books.price','books.discount','books.image', 'sessions.*', 'categories.category')
                ->orderBy('created_at', 'desc')
                ->get();
            $cart_count = $cart->count();
            $orders = DB::table('orderscounters')->where('session_id', $session)->get();

            return view('cart', [
                'carts' => $cart,
                'count' => $cart_count,
                'orders' => $orders
            ]);
        }

        return view('cart', [
            'carts' => $cart,
            'count' => $cart_count,
            'orders' => $orders
        ]);

    }
    public function postClearCart(Request $request){
        if (Auth::user()){
            $checkOldorder = DB::table('orders')->where([
                ['user_id', '=', Auth::id()],
                ['status', '=', '0']
            ])->get();

            if ($checkOldorder){
                $k = 0;
                foreach ($checkOldorder as $check){
                    $del = Order::find($check->id);
                    $del->delete();
                    $k++;
                }

                $checkCounter = DB::table('orderscounters')->where([
                    ['user_id', '=', Auth::id()],
                    ['status', '=', '0']
                ])->first();
                if ($checkCounter){
                    $del = Orderscounter::find($checkCounter->id);
                    $del->delete();
                }

            }

            $selQuery = DB::table('carts')->where('user_id', Auth::id())->get();
            $i = 0;
            foreach ($selQuery as $x){
                $id = $x->id;
                $del = Cart::find($id);
                $del->delete();
                $i++;
            }
            return redirect()->back()->with('status', 'Your cart items are deleted successfully');
        }
        if(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $checkOldorder = DB::table('orders')->where([
                ['session_id', '=', $session],
                ['status', '=', '0']
            ])->get();
            if ($checkOldorder){
                $k = 0;
                foreach ($checkOldorder as $check){
                    $del = Order::find($check->id);
                    $del->delete();
                    $k++;
                }
                $checkCounter = DB::table('orderscounters')->where([
                    ['session_id', '=', $session],
                    ['status', '=', '0']
                ])->first();
                if ($checkCounter){
                    $del = Orderscounter::find($checkCounter->id);
                    $del->delete();
                }

            }

            $selQuery = DB::table('sessions')->where('token', $session)->get();
            $i = 0;
            foreach ($selQuery as $y){
                $id = $y->id;
                $del = Session::find($id);
                $del->delete();
                $i++;
            }
            return redirect()->back()->with('status', 'Your cart items are deleted successfully');

        }
    }
    public function postQntty(Request $request){
        $id = $request['dataID'];
        $input = $request['quantityInput'];


        $this->validate($request, [
            'quantityInput' => 'required'
        ]);
        if(Auth::user()){
            $updateAuth = Cart::find($id);
            $updateAuth->quantity = $input;

            $updateAuth->update();
            return redirect()->back()->with(['status' => 'Your cart is updated successfully']);

        }elseif(session()->exists('bookIdses')){
            $updateSes = Session::find($id);
            $updateSes->quantity = $input;

            $updateSes->update();
            return redirect()->back()->with(['status' => 'Your cart is updated successfully']);

        }

    }
    public function getCheckout(){


        $checkOd = 0;
        $payment_mode = 0;
        $hasAdd = null;
        $couponVal = null;
        $getCharges = array();
        $getCharges = DB::table('charges')->get();
        $getCoupon = DB::table('orderscounters')->where([
            ['user_id', '=', Auth::id()],
            ['status', '=', '0']
        ])->latest()->first();
        if($getCoupon != null){
            $payment_mode = $getCoupon->payment_mode;
        }
        $type = null;
        $value = null;
        if(Auth::user()){
            $type = 'user_id';
            $value = Auth::id();
        }elseif(session()->exists('bookIdses')){
            $session = session('bookIdses');
            $type = 'session_id';
            $value = $session;
        }

        $checkPrev = DB::table('orderscounters')->where([
            [ $type, '=', $value],
            ['status', '=', '0']
        ])->first();
        if ($checkPrev != null){
            $getQuery = DB::table('orders')->where([
                [$type, '=', $value],
                ['status', '=', '0']
            ])->get();
            $hasAdd = DB::table('addresses')->where($type, '=', $value)->first();

            return view('checkout', [
                'orders' => $getQuery,
                'charges' => $getCharges,
                'coupon' => $couponVal,
                'checkOd' => $checkOd,
                'address' => $hasAdd,
                'payment_mode' => $payment_mode
            ]);
        }else{
            return redirect()->route('get.cart');
        }

    }
    public function getCheckoutDelivery(){

        $checkOd = 0;
        $hasAdd = null;
        $payment_mode = 0;

        $type = null;
        $value = null;
        if(Auth::user()){
            $type = 'user_id';
            $value = Auth::id();
        }elseif(session()->exists('bookIdses')){
            $session = session('bookIdses');
            $type = 'session_id';
            $value = $session;
        }

        $checkPrev = DB::table('orderscounters')->where([
            [ $type, '=', $value],
            ['status', '=', '0']
        ])->first();

        if ($checkPrev != null){
            $checkOd = 1;
            $payment_mode = $checkPrev->payment_mode;

            $hasAdd = DB::table('addresses')->where($type, '=', $value)->first();

            return view('checkout-delivery',[
                'checkOd' => $checkOd,
                'address' => $hasAdd,
                'payment_mode' => $payment_mode
            ]);
        }else{
            return redirect()->route('get.cart');
        }


    }
    public function postChangeAdd(Request $request){

        $type = null;
        $value = null;
        if(Auth::user()){
            $type = 'user_id';
            $value = Auth::id();
        }elseif(session()->exists('bookIdses')){
            $session = session('bookIdses');
            $type = 'session_id';
            $value = $session;
        }
        $addr = DB::table('addresses')->where($type, '=', $value)->first();
        $del = Address::find($addr->id);
        $del->delete();
        return redirect()->back();

    }
    public function getCheckoutPayment(){

        $checkOd = 0;
        $hasAdd = null;
        $payment_mode = 0;
        $type = null;
        $value = null;
        if(Auth::user()){
            $type = 'user_id';
            $value = Auth::id();
        }elseif(session()->exists('bookIdses')){
            $session = session('bookIdses');
            $type = 'session_id';
            $value = $session;
        }
        $checkPrev = DB::table('orderscounters')->where([
            [ $type, '=', $value],
            ['status', '=', '0']
        ])->first();
        if ($checkPrev != null){
            $checkOd = 1;
            $payment_mode = $checkPrev->payment_mode;
            $hasAdd = DB::table('addresses')->where($type, '=', $value)->first();
            if ($hasAdd == null){
                return redirect()->route('get.checkoutdelivery')->with('status2', 'Please fill out the delivery form');
            }else{
                return view('checkout-payment',[
                    'checkOd' => $checkOd,
                    'address' => $hasAdd,
                    'payment_mode' => $payment_mode
                ]);
            }

        }else{
            return redirect()->route('get.cart');
        }

    }
    public function getCheckoutConfirm(){

        $checkOd = 0;
        $payment_mode = 0;
        $hasAdd = null;
        $couponVal = null;
        $getCharges = array();
        $getCharges = DB::table('charges')->get();
        $getCoupon = DB::table('orderscounters')->where([
            ['user_id', '=', Auth::id()],
            ['status', '=', '0']
        ])->latest()->first();
        if($getCoupon != null){
            $payment_mode = $getCoupon->payment_mode;
        }
        $type = null;
        $value = null;
        if(Auth::user()){
            $type = 'user_id';
            $value = Auth::id();
        }elseif(session()->exists('bookIdses')){
            $session = session('bookIdses');
            $type = 'session_id';
            $value = $session;
        }
        $checkPrev = DB::table('orderscounters')->where([
            [$type, '=', $value],
            ['status', '=', '0']
        ])->first();
        if ($checkPrev != null){
            $checkOd = 1;
            $payment_mode = $checkPrev->payment_mode;
            $getQuery = DB::table('orders')->where([
                [$type, '=', $value],
                ['status', '=', '0']
            ])->get();
            $hasAdd = DB::table('addresses')->where($type, '=', $value)->first();
            if ($hasAdd == null){
                return redirect()->route('get.checkoutdelivery');
            }elseif ($checkPrev->payment_mode == '0'){
                return redirect()->back()->with('status2', 'Please select a payment method');
            }
            else{
                return view('checkout-confirm',[
                    'checkOd' => $checkOd,
                    'address' => $hasAdd,
                    'orders' => $getQuery,
                    'charges' => $getCharges,
                    'coupon' => $couponVal,
                    'payment_mode' => $payment_mode
                ]);
            }

        }else{
            return redirect()->route('get.cart');
        }

    }
    public function postInitOrder(Request $request){

        if (Auth::user()){
            $checkOldorder = DB::table('orders')->where([
                ['user_id', '=', Auth::id()],
                ['status', '=', '0']
            ])->get();

            if ($checkOldorder){
                $k = 0;
                foreach ($checkOldorder as $check){
                    $del = Order::find($check->id);
                    $del->delete();
                    $k++;
                }

                $checkCounter = DB::table('orderscounters')->where([
                    ['user_id', '=', Auth::id()],
                    ['status', '=', '0']
                ])->first();
                if ($checkCounter){
                    $del = Orderscounter::find($checkCounter->id);
                    $del->delete();
                }

            }

            $getIdQuery = DB::table('carts')->where('user_id', Auth::id())->first();
            $order_id  = preg_replace('#[^0-9]#i', '', microtime()).$getIdQuery->id;
            $getCartQuery = DB::table('carts')->where('user_id', Auth::id())->get();
            $i = 0;
            foreach ($getCartQuery as $cart){
                $book = DB::table('books')
                    ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
                    ->where('books.id', '=', $cart->itemId)
                    ->select('books.title','books.price','books.discount','books.image', 'categories.category')
                    ->first();
                $ip = \Request::getClientIp(true);
                $order = new Order();
                $order->order_id = $order_id;
                $order->user_id = Auth::id();
                $order->session_id = null;
                $order->item_title = $book->title;
                $order->item_id = $cart->itemId;
                $order->category = $book->category;
                $order->quantity = $cart->quantity;
                $order->discount = $book->discount;
                $order->price = $book->price;
                $order->image = $book->image;
                $order->ip_address = $ip;
                $order->save();
                $i++;
            }
            $insertCount = new Orderscounter();
            $insertCount->order_id = $order_id;
            $insertCount->user_id = Auth::id();
            $insertCount->session_id = null;
            $insertCount->save();
            return redirect()->route('get.checkout');

        }elseif (session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $checkOldorder = DB::table('orders')->where([
                ['session_id', '=', $session],
                ['status', '=', '0']
            ])->get();
            if ($checkOldorder){
                $k = 0;
                foreach ($checkOldorder as $check){
                    $del = Order::find($check->id);
                    $del->delete();
                    $k++;
                }
                $checkCounter = DB::table('orderscounters')->where([
                    ['session_id', '=', $session],
                    ['status', '=', '0']
                ])->first();
                if ($checkCounter){
                    $del = Orderscounter::find($checkCounter->id);
                    $del->delete();
                }

            }
            $getIdQuery = DB::table('sessions')->where('token', $session)->first();
            $order_id  = preg_replace('#[^0-9]#i', '', microtime()).$getIdQuery->id;
            $getCartQuery = DB::table('sessions')->where('token', $session)->get();
            $i = 0;
            foreach ($getCartQuery as $cart){
                $book = DB::table('books')
                    ->leftJoin('categories', 'books.cat_id', '=', 'categories.id')
                    ->where('books.id', '=', $cart->itemId)
                    ->select('books.title','books.price','books.discount','books.image', 'categories.category')
                    ->first();
                $ip = \Request::getClientIp(true);
                $order = new Order();
                $order->order_id = $order_id;
                $order->user_id = null;
                $order->session_id = $session;
                $order->item_title = $book->title;
                $order->item_id = $cart->itemId;
                $order->quantity = $cart->quantity;
                $order->discount = $book->discount;
                $order->category = $book->category;
                $order->price = $book->price;
                $order->image = $book->image;
                $order->ip_address = $ip;
                $order->save();
                $i++;
            }
            $insertCount = new Orderscounter();
            $insertCount->order_id = $order_id;
            $insertCount->user_id = null;
            $insertCount->session_id = $session;
            $insertCount->save();
            return redirect()->route('get.checkout');

        }else{
            return redirect()->back()->with('status2', $php_errormsg);
        }

    }
    public function postAddress(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|max:120',
            'phone' => 'required|max:10',
            'alternativePhone'=> 'max:10',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);
        if (Auth::user()){
            $checkAd = DB::table('addresses')->where('user_id', Auth::id())->first();
            if (isset($checkAd)){
                $update = Address::find($checkAd->id);
                $update->user_id = Auth::id();
                $update->session_id = null;
                $update->order_id = null;
                $update->name = $request['name'];
                $update->email = $request['email'];
                $update->phone = $request['phone'];
                $update->alt_phone = $request['alternativePhone'];
                $update->address = $request['address'];
                $update->apartment = $request['apartment'];
                $update->city = $request['city'];
                $update->country = $request['country'];
                $update->additional_info = $request['additionalInfo'];

                $update->update();
                return redirect()->back()->with('status', 'Your delivery address is updated');
            }else{
                $address = new Address();
                $address->user_id = Auth::id();
                $address->session_id = null;
                $address->order_id = null;
                $address->name = $request['name'];
                $address->email = $request['email'];
                $address->phone = $request['phone'];
                $address->alt_phone = $request['alternativePhone'];
                $address->address = $request['address'];
                $address->apartment = $request['apartment'];
                $address->city = $request['city'];
                $address->country = $request['country'];
                $address->additional_info = $request['additionalInfo'];

                $address->save();
                return redirect()->back()->with('status', 'Your delivery information is saved successfully');
            }

        }elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $checkPrev = DB::table('orderscounters')->where([
                ['session_id', '=', $session],
                ['status', '=', '0']
            ])->first();
            if($checkPrev){
                if ($request['createAccount'] === 'on'){
                    $this->validate($request, [
                        'email' => 'unique:users',
                    ]);
                    $default_pass = random_int(10000, 99999);
                    $user = new User();
                    $user->email = $request['email'];
                    $user->name = $request['name'];
                    $user->password = bcrypt($default_pass);
                    $user->save();
                    $checkUser = DB::table('users')->where('email', $request['email'])->first();
                    if (isset($checkUser)){
                        $order_id = $checkPrev->order_id;
                        $address = new Address();
                        $address->user_id = $checkUser->id;
                        $address->session_id = $session;
                        $address->order_id = $order_id;
                        $address->name = $request['name'];
                        $address->email = $request['email'];
                        $address->phone = $request['phone'];
                        $address->alt_phone = $request['alternativePhone'];
                        $address->address = $request['address'];
                        $address->apartment = $request['apartment'];
                        $address->city = $request['city'];
                        $address->country = $request['country'];
                        $address->additional_info = $request['additionalInfo'];
                        $address->save();
                        $updateOC = DB::table('orderscounters')->where([
                            ['session_id', '=', $session],
                            ['order_id', '=', $order_id]
                        ])->first();
                        if (isset($updateOC)){
                            $updade = Orderscounter::find($updateOC->id);
                            $updade->user_id = $checkUser->id;
                            $updade->update();

                            $chord = DB::table('orders')->where([
                                ['order_id', '=', $order_id],
                                ['session_id', '=', $session]
                            ])->get();
                            $u = 0;
                            foreach ($chord as $orders){
                                $find = Order::find($orders->id);
                                $find->user_id = $checkUser->id;
                                $find->update();
                                $u++;
                            }

                            return redirect()->back()->with([
                                'accountCreated' => 'your delivery address and Login Account is created successfully. Proceed to Login below.',
                                'name' => $request['name'],
                                'email' => $request['email'],
                                'pass' => $default_pass
                            ]);
                        }else {
                            return redirect()->back()->with('status2', 'An Error has occurred');
                        }
                    }else{
                        return redirect()->back()->with('status2', 'An Error has occurred');
                    }

                }else{
                    $order_id = $checkPrev->order_id;
                    $address = new Address();
                    $address->user_id = null;
                    $address->session_id = $session;
                    $address->order_id = $order_id;
                    $address->name = $request['name'];
                    $address->email = $request['email'];
                    $address->phone = $request['phone'];
                    $address->alt_phone = $request['alternativePhone'];
                    $address->address = $request['address'];
                    $address->apartment = $request['apartment'];
                    $address->city = $request['city'];
                    $address->country = $request['country'];
                    $address->additional_info = $request['additionalInfo'];

                    $address->save();
                    return redirect()->back()->with('status', 'Your delivery information is saved. Please proceed to the next step');
                }
            }else{
                return redirect()->route('get.cart');
            }
        }
        return redirect()->back()->with('status2', $php_errormsg);
    }
    public function postSubmitOrder(Request $request){

        if (Auth::user()){
            $checkPrev = DB::table('orderscounters')->where([
                ['user_id', '=', Auth::id()],
                ['status', '=', '0']
            ])->first();
            if ($checkPrev != null){
                $chOd = DB::table('orders')->where([
                    ['user_id', '=', Auth::id()],
                    ['order_id', '=', $checkPrev->order_id],
                    ['status', '=', '0']
                ])->get();
                if (count($chOd) > 0){
                    $i = 0;
                    foreach ($chOd as $orderInput){
                        $input = Order::find($orderInput->id);
                        $input->status = '1';
                        $input->update();

                        $i++;
                    }
                    $odcounter = Orderscounter::find($checkPrev->id);
                    $odcounter->status = '1';
                    $odcounter->update();

                    $clcart = DB::table('carts')->where('user_id', Auth::id())->get();
                    $k = 0;
                    foreach ( $clcart as $item) {
                        $del = Cart::find($item->id);
                        $del->delete();

                        $k++;
                    }
                    return redirect()->route('welcome')->with([
                        'orderStatus' => 'Your order is placed successfully, details are sent to your email.',
                        'orderID' => $checkPrev->order_id,
                        'user' => Auth::id()
                    ]);
                }else{
                    return redirect()->route('get.cart');
                }

            }else{
                return redirect()->route('get.cart');
            }

        }elseif(session()->exists('bookIdses')) {
            $session = session('bookIdses');
            $checkPrev = DB::table('orderscounters')->where([
                ['session_id', '=', $session],
                ['status', '=', '0']
            ])->first();
            if ($checkPrev != null){
                $chOd = DB::table('orders')->where([
                    ['session_id', '=', $session],
                    ['order_id', '=', $checkPrev->order_id],
                    ['status', '=', '0']
                ])->get();
                if (count($chOd) > 0){
                    $i = 0;
                    foreach ($chOd as $orderInput){
                        $input = Order::find($orderInput->id);
                        $input->status = '1';
                        $input->update();

                        $i++;
                    }
                    $odcounter = Orderscounter::find($checkPrev->id);
                    $odcounter->status = '1';
                    $odcounter->update();

                    $clcart = DB::table('sessions')->where('token', $session)->get();
                    $k = 0;
                    foreach ( $clcart as $item) {
                        $del = Session::find($item->id);
                        $del->delete();

                        $k++;
                    }
                    return redirect()->route('welcome')->with([
                        'orderStatus' => 'Your order is placed successfully, details are sent to your email.',
                        'orderID' => $checkPrev->order_id,
                        'user' => null
                    ]);
                }else{
                    return redirect()->route('get.cart');
                }

            }else{
                return redirect()->route('get.cart');
            }
        }
        return redirect()->route('get.cart');

    }
    public function getClientOrders(){

        $orders = DB::table('orderscounters')->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.orders', [
            'orders' => $orders
        ]);
    }
    public function getOrderdetails(){
        return view('dashboard.order-details');
    }
    public function postSubmitpayment(Request $request){
        $input = $request['paymentModeRadio'];
        if($request['paymentModeRadio'] == null){
            $input = '0';
        }
        $type = null;
        $value = null;
        if(Auth::user()){
            $type = 'user_id';
            $value = Auth::id();
        }elseif(session()->exists('bookIdses')){
            $session = session('bookIdses');
            $type = 'session_id';
            $value = $session;
        }

        $order = DB::table('orderscounters')->where([
            [$type, '=', $value],
            ['status', '=', '0']
        ])->first();
        $setpayMode = Orderscounter::find($order->id);
        $setpayMode->payment_mode = $input;
        $setpayMode->update();

        return redirect()->route('get.checkoutconfirm');
    }
    public function viewcustomerOrderdetail($id){
        $cart_count = DB::table('carts')->where('user_id', Auth::id())->count();
        $couponVal = null;
        $getCharges = array();
        $getCharges = DB::table('charges')->get();
        $checkOrder = DB::table('orderscounters')->where([
            [ 'user_id', '=', Auth::id()],
            ['order_id', '=', $id],
            ['delete_status', '=', '0']
        ])->first();
        if ($checkOrder != null){
            $getOrders = DB::table('orders')->where([
                ['user_id', '=', Auth::id()],
                ['order_id', '=', $id],
            ])->get();
            $order_status = $checkOrder->status;

            return view('customer-order-details', [
                'orders' => $getOrders,
                'orderStatus' => $order_status,
                'id' => $id,
                'charges' => $getCharges,
                'coupon' => $couponVal,
                'count' => $cart_count
            ]);
        }else{
            return redirect()->route('get.customerAccOrders')->with('status2', 'An Error has occurred!');
        }

    }
    public function postcancelOrder(Request $request){
        $order_id = $request['inputID'];
        $type = $request['type'];
        if ($type === $request['_token']){
            $orderCounter = DB::table('orderscounters')->where([
                ['user_id', '=', Auth::id()],
                ['order_id', '=', $order_id]
            ])->first();
            if ($orderCounter){
                $update = Orderscounter::find($orderCounter->id);
                $update->status = '4';
                $update->update();

                $getOrders = DB::table('orders')->where([
                    ['user_id','=', Auth::id()],
                    ['order_id', '=', $order_id]
                ])->get();
                $k = 0;
                foreach ($getOrders as $orders){
                    $updatethis = Order::find($orders->id);
                    $updatethis->status = '4';
                    $updatethis->update();
                    $k++;
                }
                return redirect()->route('get.customerAccOrders')->with('status', 'Order successfully canceled');

            }else{
                return redirect()->back()->with('status2', 'An Error has occurred');
            }
        }elseif ($type === '0'){
            $orderCounter = DB::table('orders')->where([
                ['user_id', '=', Auth::id()],
                ['order_id', '=', $request['ordID']]
            ])->first();
            if ($orderCounter){
                $getOrder = DB::table('orders')->where([
                    ['user_id','=', Auth::id()],
                    ['id', '=', $order_id]
                ])->first();
                $updatethis = Order::find($getOrder->id);
                $updatethis->status = '4';
                $updatethis->update();

                $countOrder = DB::table('orders')->where([
                    ['user_id','=', Auth::id()],
                    ['order_id', '=', $request['ordID']],
                    ['status', '=', '1']
                ])->count();
                if ($countOrder > 0){
                    return redirect()->back()->with('status', 'This order is canceled');
                }elseif($countOrder === 0){
                    $getOrcounter = DB::table('orderscounters')->where([
                        ['user_id', '=', Auth::id()],
                        ['order_id', '=', $getOrder->order_id]
                    ])->first();
                    $update = Orderscounter::find($getOrcounter->id);
                    $update->status = '4';
                    $update->update();
                    return redirect()->route('get.customerAccOrders')->with('status', 'Order successfully cancelled');
                }

            }else{
                return redirect()->back()->with('status2', 'An Error has occurred');
            }
        }else{
            return redirect()->back()->with('status2', 'An Error has occurred');
        }
    }
    public function postdelcusorder(Request $request){

        $order_check = DB::table('orderscounters')->where([
            ['user_id', '=', Auth::id()],
            ['order_id', '=', $request['input']]
        ])->first();
        if ($order_check){
            $update = Orderscounter::find($order_check->id);
            $update->delete_status = '1';
            $update->update();
            return redirect()->back()->with('status', 'Deleted!');
        }else{
            return redirect()->back()->with('status2', 'An Error has occurred');
        }
    }
   
}
