<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/dashboard', [
    'uses' => 'userController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'admin'
]);
Route::get('/categories', [
    'uses' => 'categoryController@getCategory',
    'as' => 'categories',
    'middleware' => 'admin'
]);
Route::get('/books-upload', [
    'uses' => 'bookController@getbooksUpload',
    'as' => 'books.upload',
    'middleware' => 'admin',

]);
Route::get('/all-books', [
    'uses' => 'bookController@getallbooks',
    'as' => 'all.books',
    'middleware' => 'admin'
]);
Route::get('/dashboard/orders', [
    'uses' => 'ordersController@getClientOrders',
    'as' => 'get.orders',
    'middleware' => 'admin'
]);
Route::get('/dashboard/orders/order-details', [
    'uses' => 'ordersController@getOrderdetails',
    'as' => 'get.orders.details',
    'middleware' => 'admin'
]);

Route::get('/', [
    'uses' => 'bookController@getHomepage',
    'as' => 'welcome'
]);

Route::post('/getitemimg', [
    'uses' => 'bookController@getPagejs',
    'as' => 'get.item.imgs'
]);

Route::get('/login', [
    'uses' => 'userController@getLoginForm',
    'as' => 'login'
]);
Route::get('/register', [
    'uses' => 'userController@getRegisterForm',
    'as' => 'register'
]);


Route::post('/register-user', [
    'uses' => 'userController@registerUser',
    'as' => 'createuser'
]);
Route::post('/login-user', [
    'uses' => 'userController@loginUser',
    'as' => 'loginuser'
]);

Route::post('/logout-user', [
    'uses' => 'userController@postLogout',
    'as' => 'logout'
]);
Route::post('/post-Category', [
    'uses' => 'categoryController@postCategory',
    'as' => 'post.category'
]);

Route::post('/post-subCatergory1', [
    'uses' => 'categoryController@postSubcategory1',
    'as' => 'post.subCat1'
]);
Route::post('/post-subCatergory2', [
    'uses' => 'categoryController@postSubcategory2',
    'as' => 'post.subCat2'
]);

Route::post('/edit-Category', [
    'uses' => 'categoryController@editCategory',
    'as' => 'edit.category'
]);
Route::post('/del-Category', [
    'uses' => 'categoryController@delCategory',
    'as' => 'del.cat'
]);
Route::post('/fetch-options',[
    'uses' => 'categoryController@fetchOpt',
    'as'=> 'fetch.Opt'

]);
Route::post('/fetch-suboptions',[
    'uses' => 'categoryController@fetchSubOpt',
    'as'=> 'fetch.sub2'
]);
Route::post('/fetch-subcate',[
    'uses' => 'categoryController@fetchCate',
    'as' => 'fetch.cate'

]);

Route::post('/post-bookUpload', [
    'uses' => 'bookController@postUploadbook',
    'as' => 'post.bookUpload'
]);
Route::get('/image/{filename}', [
    'uses' => 'bookController@getbookimg',
    'as' => 'get.bookImgs'
]);
Route::post('/load-subcategory', [
    'uses' => 'categoryController@loadsubCategories',
    'as' => 'load.subcat',
]);
Route::post('/uploadb-img', [
    'uses' => 'categoryController@loadbimg',
    'as' => 'upLimg',
]);


Route::get('/getbook-edit/{book}', [
    'uses' => 'bookController@getbookEdit',
    'as' => 'book.edit',
    'middleware' => 'admin'
]);
Route::post('/post-editedBook', [
    'uses' => 'bookController@postEditedBook',
    'as' => 'post.editedBook'
]);
Route::post('/bookItm-delete', [
    'uses' => 'bookController@postBookItmdel',
    'as' => 'delbk.bk'
]);
Route::post('/get-book-preview', [
    'uses' => 'bookController@getbookpreview',
    'as' => 'get.preview',
]);
Route::post('/load-sub-cat2', [
    'uses' => 'categoryController@loadsubcate2',
    'as' => 'load.subcate2'
]);
Route::post('/getedit-sub1', [
    'uses' => 'categoryController@getEditSub1',
    'as' => 'get.editsub1'
]);
Route::post('/postedit-sub1', [
    'uses' => 'categoryController@postEditSub1',
    'as' => 'post.editsub1'
]);
Route::post('/getedit-sub2', [
    'uses' => 'categoryController@getEditSub2',
    'as' => 'get.editsub2'
]);
Route::post('/postedit-sub2', [
    'uses' => 'categoryController@postEditSub2',
    'as' => 'post.editsub2'
]);
Route::post('/dele-sub1', [
    'uses' => 'categoryController@postDelsub1',
    'as' => 'del.sub1'
]);
Route::post('/dele-sub2', [
    'uses' => 'categoryController@postDelsub2',
    'as' => 'del.sub2'
]);
Route::get('/item-detail/{id}', [
    'uses' => 'bookController@getItemdetail',
    'as' => 'get.item.detail'
]);

Route::post('/post.session', [
    'uses' => 'ordersController@postSession',
    'as' => 'post.session'
]);

Route::get('/cart', [
    'uses' => 'ordersController@getCart',
    'as' => 'get.cart'
]);
Route::get('/checkout', [
    'uses' => 'ordersController@getCheckout',
    'as' => 'get.checkout',
    'middleware' => 'checkout'
]);
Route::get('/checkout/delivery-details', [
    'uses' => 'ordersController@getCheckoutDelivery',
    'as' => 'get.checkoutdelivery',
    'middleware' => 'checkout'
]);
Route::get('/checkout/payment', [
    'uses' => 'ordersController@getCheckoutPayment',
    'as' => 'get.checkoutpayment',
    'middleware' => 'checkout'
]);
Route::get('/checkout/confirm', [
    'uses' => 'ordersController@getCheckoutConfirm',
    'as' => 'get.checkoutconfirm',
    'middleware' => 'checkout'
]);
Route::post('/postchange-address', [
    'uses' => 'ordersController@postChangeAdd',
    'as' => 'post.changeadd',
    'middleware' => 'checkout'
]);

Route::get('/customer/account/home', [
    'uses' => 'userController@getCustomerAccHm',
    'as' => 'get.customerAccHome',
    'middleware' => 'auth'
]);
Route::get('/customer/account/orders', [
    'uses' => 'userController@getCustomerAccOrders',
    'as' => 'get.customerAccOrders',
    'middleware' => 'auth'
]);
Route::get('/customer/account/wishlist', [
    'uses' => 'userController@getCustomerAccWishlist',
    'as' => 'get.customerAccWishlist',
    'middleware' => 'auth'
]);
Route::get('/customer/account/add-delivery-address', [
    'uses' => 'userController@postGetdeliveryadd',
    'as' => 'post.get.deliveryadd',
    'middleware' => 'auth'
]);
Route::get('/customer/account/{key}', [
    'uses' => 'userController@getEditcustacct',
    'as' => 'get.Editcustacct',
    'middleware' => 'auth'
]);
Route::post('/post/customerAcc', [
    'uses' => 'userController@postEditcustacct',
    'as' => 'post.editcustAcct',
    'middleware' => 'auth'
]);
Route::post('/post.wishlist', [
    'uses' => 'userController@postWishList',
    'as' => 'post.wishlist',
    'middleware' => 'auth'
]);
Route::post('/post.changepassword', [
    'uses' => 'userController@postChangepass',
    'as' => 'post.changepass',
    'middleware' => 'auth'
]);
Route::post('/post.remvWishI', [
    'uses' => 'userController@postremvWishI',
    'as' => 'post.remvWishItem',
    'middleware' => 'auth'
]);
Route::get('/customer/account/order-detail/{id}', [
    'uses' => 'ordersController@viewcustomerOrderdetail',
    'as' => 'get.custorderdetail',
    'middleware' => 'auth'
]);
Route::post('/post.cancelorder', [
    'uses' => 'ordersController@postcancelOrder',
    'as' => 'post.cancelorder',
    'middleware' => 'auth'
]);
Route::post('/post.delorder', [
    'uses' => 'ordersController@postdelcusorder',
    'as' => 'post.delorder',
    'middleware' => 'auth'
]);



Route::post('/ctIdel', [
    'uses' => 'ordersController@postDelCart',
    'as' => 'cart.del'
]);

Route::post('/post.qntty', [
    'uses' => 'ordersController@postQntty',
    'as' => 'post.cartQtty'
]);
Route::post('/post.init.order', [
    'uses' => 'ordersController@postInitOrder',
    'as' => 'post.initorder'
]);
Route::post('/post.clear.cart', [
    'uses' => 'ordersController@postClearCart',
    'as' => 'post.clearcart'
]);
Route::post('/post.address', [
    'uses' => 'ordersController@postAddress',
    'as' => 'post.address'
]);

Route::post('/post/submit-order.xml', [
    'uses' => 'ordersController@postSubmitOrder',
    'as' => 'post.sumitOrder'
]);

Route::post('/post/submit-payment-method', [
    'uses' => 'ordersController@postSubmitpayment',
    'as' => 'post.payment'
]);
Route::post('/post/newsletter', [
    'uses' => 'userController@postNewsletter',
    'as' => 'post.newsletter'
]);
Route::get('/category/{name}/{id}', [
    'uses' => 'bookController@getbookfromcategory',
    'as' => 'get.bookfromCategory'
]);

Route::get('/search/', [
    'uses' => 'searchController@getSearchparam',
    'as' => 'get.searchparam'
]);

Route::get('/book-type/{key}', [
    'uses' => 'bookController@getbooktype',
    'as' => 'get.booktype'
]);
Route::get('/defaul-page', [
    'uses' => 'searchController@getdefaultpage',
    'as' => 'get.default'
]);
Route::post('/post/newslesession', [
    'uses' => 'userController@postNewsLtoken',
    'as' => 'post.newsLtoken'
]);



