<?php

namespace App\Http\Controllers;
use App\Models\Prime_model;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Session;

class Home extends Controller
{
    // initial page after login student or teacher

    /**
     * generate a list of available resource for the user
     * require a model to get the data from server
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        // get all file list
        // with pagination

        $available_file_list = Prime_model::get_file_list(Session::get('user_type'));
        $purchase = Prime_model::get_purchase_list(Session::get('user_id'));

        return view('home', ['title'=>'Project Name :: Home', 'files'=>$available_file_list, 'purchase'=>$purchase]);
    }

    /**
     * generate download link
     * use public store driver
     * @param string $filename
     * @return file in http protocol
     */

    public function download($filename = ''){

        if ( file_exists( Storage::path($filename) ) ) {
            // Send Download
            return Storage::download($filename);
        } else {
            // Error
            exit( 'Requested file does not exist on our server!' );
        }

    }

    /**
     * add item to cart array
     * cart array store in session
     * @parameter 2
     *      1. page number for redirect to same page
     *      2. resource id to store into the cart array
     * redirect the /home/page_number route (same page with pagination)
     */
    public function add_to_cart($page, $resource_id){

        /// copy the session array to the local array
        /// push the new resource id to local array
        /// update the session array with local array
        $cart = array();

        $cart = Session::get('cart');

        /// if resource_id not exist
        if(in_array($resource_id, $cart) == false)  array_push($cart,$resource_id);
        Session::put('cart',$cart);

        return redirect('/home?page='.$page);
    }

    /**
     * generate cart.blade.php view file
     * show the list of cart item
     * load model to get the cart items
     * return /cart
    */

    public function cart(){
        $data = Prime_model::get_cart_item();
        return view('cart',['title'=>'Cart','data'=>$data]);
    }



    /**
     *  remove an element from cart array in session
     * @parameter 1
     *      array element that want to remove
     *  redirect /cart route
    */

    public function remove_to_cart($resource_id){

        $cart = Session::get('cart');

        $index = array_search($resource_id, $cart);
        if($index >= 0) {
            array_splice($cart, $index, 1);

        }

        Session::put('cart',$cart);

        return redirect('/cart');
    }

    /**
     *
     */
    public function cart_confirm(){
        Prime_model::cart_confirm();
        return redirect('/home');
    }


    /**
        delete all session data and redirect /login route
    */
    public function logout(){

        Session::flush();
        return redirect('/login');
    }
}
