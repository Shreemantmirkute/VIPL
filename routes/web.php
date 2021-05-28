<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use App\User;
use App\Notifications\TaskCompleted;
//use Auth;


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

/*all ajax ----------------------------------------------------------------------------------------------------------------------------*/
Route::get('/my_header', function () {
    return view('header');
});

Route::get('admin/ajax-get-item', 'ReportController@ajax_get_item');

Route::get('ajax-get-item-user', 'ReportController@ajax_get_item_user');

Route::get('admin/finalreport', 'ReportController@finalreport');

Route::get('ajaxbidbybuyer/{seller_id}/{seller_user_id}/{buyer_user_id}', 'BidacceptController@ajaxbidbybuyer');

Route::post('ajax_start_bidding', 'BidacceptController@ajax_start_bidding');

Route::post('start-counterbidding', 'BidacceptController@start_counterbidding');

Route::post('ajax_start_counterbidding', 'BidacceptController@ajax_start_counterbidding');

Route::get('ajaxcounterbidbybuyer/{seller_id}/{buyer_user_id}/{seller_user_id}', 'BidacceptController@ajaxcounterbidbybuyer');

Route::get('ajax-atri', 'BuyerController@ajax');

Route::get('ajax-prod', 'ProductController@ajax');

Route::get('ajax-allprod', 'ProductController@allajax');

Route::get('ajax-my-allprod', 'ProductController@allmyajax');

Route::get('ajax-allemail', 'ProductController@allemail');

Route::get('ajax-allphone', 'ProductController@allphone');

Route::get('ajax-allsubcat', 'ProductController@allsubcatajax');

Route::get('ajax-allcat', 'ProductController@allcatajax');

Route::get('admin/ajaxsingletrails/{buyer_id}/{buyer_user_id}/{seller_user_id}/{bidid}', 'BidacceptController@ajaxbidbysellerhistorysingle');

Route::get('ajaxbidbyseller/{buyer_id}/{buyer_user_id}/{seller_user_id}', 'BidacceptController@ajaxbidbyseller');

Route::get('ajaxcounterbid/{offer_id}/{seller_user_id}/{buyer_user_id}', 'BidacceptController@ajaxcounterbid');

Route::get('ajax-state', 'StateController@allstate');

Route::get('/ajax-updatedate', 'RoleController@updatedate');

Route::get('ajax-businesstype', 'BusinesstypeController@allbusinesstype');

Route::get('ajax-allbusiness', 'BusinesstypeController@allbusinesstypelist');

Route::get('ajax-unit', 'UnitController@allunit');

Route::get('ajax-country', 'CountryController@allcountry');

Route::get('ajax-informationpage', 'InformationpageController@allinformationpage');

// Route::get('/{slug}', 'InformationpageController@view_info');

Route::get('/about', 'InformationpageController@view_about');

Route::get('admin/ajaxsingletrail/{buyer_id}/{seller_id}/{buyer_user_id}/{seller_user_id}/{bidid}', 'BidacceptController@ajaxsingletrail');

Route::get('admin/ajaxsingletrailb/{seller_id}/{seller_user_id}/{buyer_user_id}/{bidid}', 'BidacceptController@ajaxbidbybuyerhistorysingle');



/*----------------------------------------------------------------------------------------------------------------------------------*/

Route::get('/', function () {
    return view('welcome_page');
});

Route::get('/thankyou', function () {
    return view('thankyou');
});

Route::get('/notify', function(){
    $data = 'variable';
    User::find(Auth::user()->id)->notify(new TaskCompleted($data));
    dd('done');
});

    
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'HomeController@admin');

// Route::get('/register', 'Auth\RegisterController@register_view');

Route::post('/test001', 'ProfileController@test001');
Route::get('/save-token', 'ProfileController@saveToken')->name('save-token');

Route::get('/user', function () {
    return view('pages/user');
});
Route::get('/tables', function () {
    return view('pages/tables');
});
Route::get('/admin-change-password', function () {
    return view('admin/admin-changepassword');
});
Route::get('/typography', function () {
    return view('pages/typography');
});
Route::get('/icons', function () {
    return view('pages/icons');
});
Route::get('/map', function () {
    return view('pages/map');
});
Route::get('/notifications', function () {
    return view('pages/notifications');
});
Route::get('/clear_notification', function() {
    $myuser = \App\User::find(Auth::user()->id);
    $myuser->unreadNotifications->markAsRead();
    return redirect()->back()->with('success', 'Notification Clear Successfully');
});
Route::get('/rtl', function () {
    return view('pages/rtl');
});
Route::get('/upgrade', function () {
    return view('pages/upgrade');
});
Route::get('/tandc', function () {
    return view('tandc');
});
Route::get('/forget-password', function () {
    return view('pages/forget_password');
});
Route::get('/registration-successful', function () {
    return view('pages/registration_successful');
});




/*test routs*/
Route::get('/test', function () {
    return view('test');
});

// Route::get('/test2', function () {
//     return view('all_pages/admin/dashboard');
// });
Route::get('/test2', 'ReportController@test2');

Route::get('userfinalreport', 'ReportController@userfinalreport');

Route::get('/myhelpfile', function () {
    return view('myhelpfile');
});

//Demo for ui
Route::get('/demo', 'DemoController@demo');

//Bids

Route::group(['middleware' => ['auth']], function() {

    /*admin routs */
    Route::get('/admin/users', 'HomeController@admin_users');
    Route::get('/admin/user-details/{id}', 'HomeController@user_details');
    Route::get('/admin/category', 'HomeController@admin_category');
    Route::get('/admin/product', 'HomeController@admin_product');
    Route::get('/admin/subproduct', 'HomeController@admin_subproduct');
    Route::get('admin/top-buyers', 'ReportController@top_buyers');
    Route::get('admin/top-sellers', 'ReportController@top_sellers');
    Route::get('admin/daily-sales', 'ReportController@daily_sales');
    Route::get('admin/amount-wise-turnover', 'ReportController@amount_wise_turnover');
    Route::get('admin/admin-final-report', 'ReportController@admin_final_report');

    //New route for add enquiry and add offer
    Route::get('/add-enquiry-offer', 'SellerController@addEquiryOffer');
    Route::post('/save-enquiry-offer', 'SellerController@saveEnquiryOffer');
    Route::get('/enquiry-offer-view', 'SellerController@enquiryOfferView');
    Route::get('/productsBusinessTypeWise', 'SellerController@productsBusinessTypeWise');
    Route::get('/getbusinesstype', 'SellerController@getbusinesstype');

    /*profile route*/
    Route::post('/profileupdate', 'ProfileController@create');

    Route::post('/change_password', 'ProfileController@changepassword');

    Route::get('/offer-view', 'SellerController@offerview');

    Route::get('/report', 'ReportController@report');
    
     Route::get('/product-wise-buyer-seller', 'ReportController@productWiseBuyerSeller');

    Route::get('/offer-list-view', 'SellerController@offerlistview');

    Route::post('/offer-post', 'SellerController@save');

    Route::post('/update-seller', 'SellerController@update');

    Route::get('/delete-seller/{id}', 'ProfileController@delete_seller');

    Route::post('/update-profile', 'ProfileController@update_profile');
    
    Route::post('/update-password', 'ProfileController@update_password');

    Route::get('/edit-profile', 'HomeController@edit_profile');

    Route::get('/delete-buyer/{id}', 'BuyerController@delete_buyer');

    Route::post('/update-buyer', 'BuyerController@update');

    Route::get('/fetch-image/{id}', 'ProfileController@fetchimage');

    Route::get('/enquiry-view', 'BuyerController@enquiryview');

    Route::get('/enquiry-list-view', 'BuyerController@enquirylistview');

    Route::post('/enquiry-post', 'BuyerController@save');

    Route::get('/bidacceptance-view', 'ProfileController@bidacceptanceview');

    Route::get('/new-bidacceptance-view', 'ProfileController@newBidAcceptanceView');

    Route::get('/bidacceptance-view/{product_name}', 'ProfileController@bidacceptanceview');

    Route::post('/create-category', 'CategoryController@create_category');

    Route::post('/create-product', 'ProductController@create_product');

    Route::post('/create-subproduct', 'ProductController@create_subproduct');

    Route::get('/delete-product/{id}', 'ProductController@delete_product');

    Route::get('/delete-subproduct/{id}', 'ProductController@delete_subproduct');

    Route::get('/delete-category/{id}', 'CategoryController@delete_category');

    Route::get('/delete-user/{id}', 'HomeController@delete_user');

    Route::get('/update-product', 'ProductController@update_product');

    Route::get('/delete-item/{id}', 'ItemController@delete_item');

    Route::get('/admin-delete-item/{id}', 'ItemController@admin_delete_item');

    Route::post('/update-item', 'ItemController@update_item');

    Route::post('/admin-update-item', 'ItemController@admin_update_item');

    Route::post('/admin-reject-item', 'ItemController@admin_reject_item');

    Route::post('/update-user', 'HomeController@update_user');

    Route::post('/forget-password', 'HomeController@forget-password');

    Route::get('/activate-user/{id}', 'HomeController@activate_user');

    Route::get('/deactivate-user/{id}', 'HomeController@deactivate_user');

    Route::get('/activate-product/{id}', 'ProductController@activate_product');

    Route::get('/deactivate-product/{id}', 'ProductController@deactivate_product');

    Route::get('/activate-subproduct/{id}', 'ProductController@activate_subproduct');

    Route::get('/deactivate-subproduct/{id}', 'ProductController@deactivate_subproduct');

    Route::get('/activate-category/{id}', 'ProductController@activate_category');

    Route::get('/deactivate-category/{id}', 'ProductController@deactivate_category');

    Route::get('/user_dashboard', 'HomeController@user_dashboard');
    
     Route::get('/more_news', 'HomeController@more_News');
     
     Route::get('/user-information', 'HomeController@user_information');

    Route::get('/inactive_user_dashboard', 'HomeController@user_dashboard');

    Route::get('/pending_user_dashboard', 'HomeController@user_dashboard');

    Route::get('/user_profile', 'HomeController@user_profile');

    Route::get('/change_password', 'HomeController@change_password');

    Route::get('/add_product', 'ProductController@add_product');

    Route::get('/sproduct_details', 'ProductController@sproduct_details');

    Route::get('/bproduct_details', 'ProductController@bproduct_details');

    Route::post('/add_item', 'ItemController@add_item');

    Route::get('/add_item', 'ItemController@add_item_view');

    Route::get('/add_category', 'ProductController@add_category');

    Route::get('/add_user', 'SubuserController@add_user')->middleware('auth');

    Route::post('/subuser-store', 'SubuserController@subuserstore');

    Route::get('/activate-enquiry/{id}', 'BuyerController@activate_enquiry');

    Route::get('/deactivate-enquiry/{id}', 'BuyerController@deactivate_enquiry');

    Route::get('/activate-offer/{id}', 'SellerController@activate_offer');

    Route::get('/statuson', 'SellerController@statuson');

    Route::get('/statusoff', 'SellerController@statusoff');

    Route::get('/statusonenquiry', 'SellerController@statusonenquiry');

    Route::get('/statusoffenquiry', 'SellerController@statusoffenquiry');

    Route::get('/deactivate-offer/{id}', 'SellerController@deactivate_offer');

    Route::get('admin/admin-offer-view', 'HomeController@admin_offer_view');
    
    Route::get('admin/admin-ongoingbid', 'BidacceptController@adminOngoingBid');

    Route::get('admin/admin-enquiry-view', 'HomeController@admin_enquiry_view');

    Route::get('admin/taxclass', 'TaxClassController@view_taxclass');

    Route::get('admin/role', 'RoleController@view_role');

    Route::get('admin/admin-bidacceptance-view', 'HomeController@admin_bidacceptance_view');

    Route::get('admin/admin-bidaccepted-view', 'HomeController@admin_bidaccepted_view');
    
     Route::get('admin/admin-bidcompleted-view', 'HomeController@admin_bidcompleted_view');
     
      Route::get('admin/admin-ongoing-view', 'HomeController@admin_ongoing_view');

    Route::get('admin/admin-bidaccepted-single-view/{id}/{buyer_id}/{seller_id}', 'HomeController@admin_bidaccepted_single_view');

    Route::get('admin/admin-product', 'HomeController@admin_item');

    Route::get('buyerbidacceptance/{id}', 'BuyerController@buyerbidacceptance');

    Route::get('sellerbidacceptance/{id}/{userid}', 'BidacceptController@sellerbidacceptance');

    Route::get('bidbybuyer/{seller_id}/{seller_user_id}/{buyer_user_id}', 'BidacceptController@bidbybuyer');

    

    Route::get('bidbyseller/{buyer_id}/{buyer_user_id}/{seller_user_id}', 'BidacceptController@bidbyseller');

    

    Route::get('bidbysellerhistory/{buyer_id}/{buyer_user_id}/{seller_user_id}', 'BidacceptController@bidbysellerhistory');

    Route::get('bidbysellerhistorysingle/{buyer_id}/{buyer_user_id}/{seller_user_id}/{bidid}', 'BidacceptController@bidbysellerhistorysingle');

    Route::get('admin/singletrails/{buyer_id}/{buyer_user_id}/{seller_user_id}/{bidid}', 'BidacceptController@bidbysellerhistorysingle');

    Route::get('bidbybuyerhistory/{seller_id}/{seller_user_id}/{buyer_user_id}', 'BidacceptController@bidbybuyerhistory');

    Route::get('bidbybuyerhistorysingle/{seller_id}/{seller_user_id}/{buyer_user_id}/{bidid}', 'BidacceptController@bidbybuyerhistorysingle');

    Route::get('admin/singletrailb/{seller_id}/{seller_user_id}/{buyer_user_id}/{bidid}', 'BidacceptController@bidbybuyerhistorysingle');

    Route::get('admin/singletrail/{buyer_id}/{seller_id}/{buyer_user_id}/{seller_user_id}/{bidid}', 'BidacceptController@singletrail');



    Route::get('counterbidbybuyer/{seller_id}/{buyer_user_id}/{seller_user_id}', 'BidacceptController@counterbidbybuyer');

    

    Route::get('counterbidbyseller/{offer_id}/{seller_user_id}/{buyer_user_id}', 'BidacceptController@counterbidbyseller');

    

    Route::get('accept-bid/{sellerid}/{selleruserid}/{buyeruserid}', 'BidacceptController@acceptbid');

    Route::get('accept-bids/{sellerid}/{userid}/{price}/{bidid}/{quantity}', 'BidacceptController@acceptbids');

    Route::get('accept-bid-by-buyer/{sellerid}/{selleruserid}/{buyeruserid}', 'BidacceptController@acceptbidbybuyer');

    Route::get('accept-bid-by-seller/{buyerid}/{buyeruserid}/{selleruserid}', 'BidacceptController@acceptbidbyseller');

    Route::get('accept-by-seller/{id}', 'BidacceptController@acceptbyseller');

    Route::get('accept-by-buyer/{id}', 'BidacceptController@acceptbybuyer');

    Route::get('decline-by-seller/{id}', 'BidacceptController@declinebyseller');

    Route::get('decline-by-buyer/{id}', 'BidacceptController@declinebybuyer');

    Route::post('start-bid', 'BidacceptController@bid');

    Route::post('start-bidding', 'BidacceptController@start_bidding');

    Route::post('start_bidding_reject', 'BidacceptController@start_bidding_reject');

    Route::post('counter-bid', 'BidacceptController@counterbid');

    Route::get('offerbid/{id}', 'BidacceptController@offerbid');

    Route::get('enquirybid/{id}', 'BidacceptController@enquirybid');

    Route::get('ongoingbid', 'BidacceptController@ongoingbid');

    Route::get('counterbidbysellernew/{offer_id}/{seller_user_id}/{buyer_user_id}', 'BidacceptController@counterbidbyseller');

    Route::get('new-ongoingbid', 'BidacceptController@newOngoingBid');

    Route::get('new-acceptedbid', 'BidacceptController@newAcceptedBid');

    Route::get('new-rejectedbid', 'BidacceptController@newRejectedBid');

    Route::get('new-acceptedbid-approved', 'BidacceptController@newAcceptedBidApproved');
    
    /*New Route add by shreemant*/
     Route::get('admin-bids-approved', 'BidacceptController@adminBidApproved');
    /*end of the route*/
    
      /*New Route add by shreemant*/
     Route::get('order-book-seller', 'BidacceptController@orderBookSeller');
    /*end of the route*/
    
    /*New Route add by shreemant*/
     Route::get('order-book-buyer', 'BidacceptController@orderBookBuyer');
    /*end of the route*/

    Route::get('new-acceptedbid-approved-details/{id}', 'BidacceptController@newAcceptedBidApprovedDetails');

    Route::get('upload-document-seller/{id}', 'BidacceptController@uploadDocumentsSeller');

    Route::get('upload-document-buyer/{id}', 'BidacceptController@uploadDocumentsBuyer');

    Route::post('upload-doc-seller', 'BidacceptController@uploadDocSeller');

    Route::post('upload-doc-buyer', 'BidacceptController@uploadDocBuyer');

    Route::get('singlebid/{id}/{buyer_id}/{seller_id}', 'BidacceptController@singlebid');

    Route::get('singlebidbuyer/{enquiryid}/{buyer_id}/{seller_id}', 'BidacceptController@singlebidbuyer');

    Route::get('/approve-acceptedbid/{id}', 'HomeController@approve_acceptedbid');

    Route::get('/disapprove-acceptedbid/{id}', 'HomeController@disapprove_acceptedbid');

    Route::get('/approve-item/{id}', 'HomeController@approve_item');

    Route::get('/disapprove-item/{id}', 'HomeController@disapprove_item');
    
    Route::post('/ajax_for_enquiry_favorite', 'BidacceptController@onChangedFavoriteEnquiry');

});

/* add news */

Route::get('news', 'NewsController@index');

Route::group(['middleware' => ['auth']], function()
{
    Route::get('admin/add-news', 'NewsController@add_news_view');

    Route::post('admin/add-news', 'NewsController@add_news');

    Route::post('admin/filter-news', 'NewsController@add_news_view_filter');

    Route::post('admin/search-news', 'NewsController@add_news_view_search');

    Route::get('complete-news/{id}', 'NewsController@complete_news');
});

/* add event */

Route::get('event', 'EventController@index');

Route::group(['middleware' => ['auth']], function()
{

    Route::get('admin/add-event', 'EventController@add_event_view');

    Route::post('admin/add-event', 'EventController@add_event');

    Route::post('admin/filter-event', 'EventController@add_event_view_filter');

    Route::post('admin/search-event', 'EventController@add_event_view_search');

    Route::get('complete-event/{id}', 'EventController@complete_event');
});

/* add event */

Route::get('blog', 'BlogController@index');

Route::group(['middleware' => ['auth']], function()
{

    Route::get('admin/add-blog', 'BlogController@add_blog_view');

    Route::post('admin/add-blog', 'BlogController@add_blog');

    Route::post('admin/filter-blog', 'BlogController@add_blog_view_filter');

    Route::post('admin/search-blog', 'BlogController@add_blog_view_search');

    Route::get('complete-blog/{id}', 'BlogController@complete_blog');
});



Route::post('/create-role', 'RoleController@create_role');



Route::group(['middleware' => ['auth']], function()
{

    /* Currency */
    Route::post('/create-currency', 'CurrencyController@create_currency');

    Route::get('/delete-currency/{id}', 'CurrencyController@delete_currency');

    Route::get('/admin/currency', 'CurrencyController@view_currency');

    Route::post('/admin-update-currency', 'CurrencyController@update_currency');

    /* Country */
    Route::post('/create-country', 'CountryController@create_country');

    Route::get('/delete-country/{id}', 'CountryController@delete_country');

    Route::get('/admin/country', 'CountryController@view_country');

    


    /* State */
    Route::post('/create-state', 'StateController@create_state');

    Route::get('/delete-state/{id}', 'StateController@delete_state');

    Route::get('/admin/state', 'StateController@view_state');

    


    /* Business Type */
    Route::post('/create-businesstype', 'BusinesstypeController@create_businesstype');

    Route::get('/delete-businesstype/{id}', 'BusinesstypeController@delete_businesstype');

    Route::get('/admin/businesstype', 'BusinesstypeController@view_businesstype');

    Route::get('/edit/businesstype/{businesstype}', 'BusinesstypeController@edit_businesstype');

    Route::post('/update-businesstype/{business_id}','BusinesstypeController@updateBusinesstype');

    

    /* Unit */
    Route::post('/create-unit', 'UnitController@create_unit');

    Route::get('/delete-unit/{id}', 'UnitController@delete_unit');

    Route::get('/admin/unit', 'UnitController@view_unit');

    

    /* Information page */
    Route::post('/create-informationpage', 'InformationpageController@create_informationpage');

    Route::get('/delete-informationpage/{id}', 'InformationpageController@delete_informationpage');

    Route::get('/admin/informationpage', 'InformationpageController@view_informationpage');
});


