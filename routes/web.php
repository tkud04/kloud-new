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

#Route::get('/', function(){return "<h2 style='color: red;'>Out of service</h2>";});

Route::get('/', 'MainController@getIndex');

Route::get('about', 'MainController@getAbout');
Route::get('bundle', 'MainController@getBundle');
Route::get('top-deals', 'MainController@getTopDeals');
Route::get('deals', 'MainController@getDeals');

Route::get('auctions', 'MainController@getAuctions');
Route::get('auction', 'MainController@getAuction');

Route::get('cart', 'MainController@getCart');
Route::get('buy', 'MainController@getBuy');
Route::get('add-to-cart', 'MainController@getAddToCart');
Route::get('update-cart', function(){return redirect()->intended('cart');});
Route::post('update-cart', 'MainController@postUpdateCart');
Route::get('remove-from-cart', 'MainController@getRemoveFromCart');

Route::get('checkout', 'MainController@getCheckout');
Route::post('checkout', 'MainController@postCheckout');

Route::get('payment/callback', 'PaymentController@getPaymentCallback');
Route::post('pay', 'PaymentController@postRedirectToGateway');

Route::get('deal', 'MainController@getDeal');
Route::post('rate-deal', 'MainController@postRateDeal');
Route::post('comment', 'MainController@postComment');
Route::get('faq', 'MainController@getFAQ');
Route::get('airtime', 'MainController@getAirtime');
Route::get('hotels', 'MainController@getHotels');
Route::get('travelstart', 'MainController@getTravelStart');
Route::get('enterprise', 'MainController@getEnterprise');
Route::get('merchants', 'MainController@getMerchants');

Route::get('login', 'LoginController@getLogin');
Route::get('register', 'LoginController@getRegister');
Route::get('mregister', 'LoginController@getMerchantRegister');
Route::post('mregister', 'LoginController@postMerchantRegister');
Route::post('login', 'LoginController@postLogin');
Route::post('register', 'LoginController@postRegister');
Route::get('login', 'LoginController@getLogin');

Route::get('forgot-password', 'LoginController@getForgotPassword');
Route::post('forgot-password', 'LoginController@postForgotPassword');
Route::get('reset', 'LoginController@getPasswordReset');
Route::post('reset', 'LoginController@postPasswordReset');

Route::get('dashboard', 'MainController@getDashboard');
Route::get('profile', 'MainController@getProfile');
Route::post('profile', 'MainController@postProfile');
Route::get('transactions', 'MainController@getTransactions');

Route::get('userguide', 'MainController@getUserGuide');

Route::get('kloudpay', 'MainController@getKloudPay');
Route::get('wallet', 'MainController@getWallet');
Route::get('deposit', 'MainController@getKloudPayDeposit');
Route::get('kloudpay-transfer', 'MainController@getKloudPayTransfer');
Route::post('kloudpay-transfer', 'MainController@postKloudPayTransfer');
Route::get('withdraw', 'MainController@getKloudPayWithdraw');
Route::post('withdraw', 'MainController@postKloudPayWithdraw');

Route::get('orders', 'MainController@getOrders');
Route::get('invoice', 'MainController@getInvoice');

Route::get('my-deals', 'MainController@getMyDeals');
Route::get('deal-new', 'MainController@getAddDeal');
Route::post('deal-new', 'MainController@postAddDeal');
Route::get('edit-deal', 'MainController@getEditDeal');
Route::post('edit-deal', 'MainController@postEditDeal');
Route::get('delete-deal', 'MainController@getDeleteDeal');

Route::get('my-auctions', 'MainController@getMyAuctions');
Route::get('add-auction', 'MainController@getAddAuction');
Route::post('add-auction', 'MainController@postAddAuction');
Route::get('end-auction', 'MainController@getEndAuction');
Route::get('wyrte', 'MainController@getAutoEndAuction');
Route::get('delete-auction', 'MainController@getDeleteAuction');

Route::get('bid', 'MainController@getBid');
Route::get('my-bids', 'MainController@getMyBids');

Route::get('posts', 'MainController@getBlogPosts');
Route::get('post', 'MainController@getBlogPost');

Route::get('my-store', 'MainController@getMyStore');
Route::get('stores', 'MainController@getStores');
Route::get('stores/{flink}', 'MainController@getStore');
Route::get('manage-my-store', 'MainController@getManageMyStore');
Route::get('edit-store', 'MainController@getEditStore');
Route::post('edit-store', 'MainController@postEditStore');
Route::get('delete-store', 'MainController@getDeleteStore');
Route::get('sales-history', 'MainController@getStoreSalesHistory');

Route::get('logout', 'LoginController@getLogout');

/***** Admin routes *****/
Route::get('admin', 'LoginController@getAdminLogin');
Route::post('admin', 'LoginController@postAdminLogin');

Route::get('cobra-forgot-password', 'LoginController@getAdminForgotPassword');
Route::post('cobra-forgot-password', 'LoginController@postAdminForgotPassword');

Route::get('cobra', 'AdminController@getIndex');
#Route::post('cobra', 'AdminController@postIndex');

Route::get('cobra-users', 'AdminController@getUsers');
Route::get('cobra-user', 'AdminController@getUser');
Route::post('cobra-user', 'AdminController@postUser');

Route::get('cobra-activate-user', 'AdminController@getActivateUser');
Route::get('cobra-suspend-user', 'AdminController@getSuspendUser');

Route::get('cobra-posts', 'AdminController@getBlogPosts');
Route::get('cobra-post', 'AdminController@getBlogPost');
Route::post('cobra-post', 'AdminController@postBlogPost');
Route::get('cobra-add-post', 'AdminController@getAddBlogPost');
Route::post('cobra-add-post', 'AdminController@postAddBlogPost');

Route::get('cobra-deals', 'AdminController@getDeals');
Route::get('cobra-deal', 'AdminController@getDeal');
Route::post('cobra-deal', 'AdminController@postDeal');

Route::get('cobra-add-deal', 'AdminController@getAddDeal');
Route::post('cobra-add-deal', 'AdminController@postAddDeal');

Route::get('cobra-stores', 'AdminController@getStores');
Route::get('cobra-store', 'AdminController@getStore');
Route::post('cobra-store', 'AdminController@postStore');
Route::get('cobra-delete-store', 'AdminController@getDeleteStore');

Route::get('cobra-be', 'AdminController@getSiteConfig');
Route::post('cobra-be', 'AdminController@postSiteConfig');

Route::get('cobra-auctions', 'AdminController@getAuctions');
Route::get('cobra-auction', 'AdminController@getAuction');

#Route::get('cobra-add-auction', 'AdminController@getAddAuction');
#Route::post('cobra-add-auction', 'AdminController@postAddAuction');
Route::get('cobra-end-auction', 'AdminController@getEndAuction');
Route::get('cobra-delete-auction', 'AdminController@getDeleteAuction');

Route::get('cobra-transactions', 'AdminController@getTransactions');
Route::get('cobra-invoice', 'AdminController@getInvoice');

Route::get('cobra-orders', 'AdminController@getOrders');
Route::get('cobra-order', 'AdminController@getOrder');
Route::post('cobra-order', 'AdminController@postOrder');

Route::get('cobra-fund-wallet', 'AdminController@getFundWallet');
Route::post('cobra-fund-wallet', 'AdminController@postFundWallet');

Route::get('cobra-withdrawals', 'AdminController@getWithdrawals');
Route::get('cobra-approve-withdrawal', 'AdminController@getApproveWithdrawal');

Route::get('cobra-add-coupon', 'AdminController@getAddCoupon');
Route::post('cobra-add-coupon', 'AdminController@postAddCoupon');

Route::get('cobra-coupon', 'AdminController@getCoupon');
Route::get('cobra-coupons', 'AdminController@getCoupons');

Route::get('cobra-rc', 'AdminController@getRC');
Route::get('cobra-rating', 'AdminController@getRating');
Route::get('cobra-mr', 'AdminController@getApproveRating');

Route::get('cobra-comments', 'AdminController@getComments');
Route::get('cobra-comment', 'AdminController@getComment');
Route::post('cobra-comment', 'AdminController@postComment');

Route::get('mailer', 'AdminController@getMailer');
Route::get('smtp', 'AdminController@getSmtp');
Route::post('smtp', 'AdminController@postSmtp');

Route::get('leads', 'AdminController@getLeads');
Route::get('delete-leads', 'AdminController@getDeleteLeads');
Route::post('leads', 'AdminController@postLeads');

Route::post('bomb', 'AdminController@postSend');

Route::get('sdd', 'AdminController@getSeeder');

Route::get('dri', 'MainController@getDeleteImage');
Route::get('practice', 'MainController@getPractice');
Route::get('zohoverify/{url}', 'MainController@getZoho');
