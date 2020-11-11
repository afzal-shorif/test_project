<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Session;
use DB;


class Prime_model extends Model
{
    use HasFactory;

    /**
     * @param $user_type
     * @return object
     *      all file based on user_type
     */
    public static function get_file_list($user_type = ''){
        return DB::table('resource')->orderBy('resource_id', 'desc')->where('type', '<=' , $user_type)->paginate(5);
    }

    /**
     * @param string $user_id
     * @return array
     * use foreach loop to convert array from object
     * toArray method not working
     */
    public static function get_purchase_list($user_id = ''){

        //return DB::table('temp')->where('user_id', '=', $user_id)->get()->toArray();

        // if inArray not working

        $purchase = array();
        $list = DB::table('temp')->where('user_id', '=', $user_id)->get();
        foreach ($list as $item) array_push($purchase, $item->resource_id);
        return $purchase;
    }


    /**
     * return an array (user_id, user_type)
     * @param string $email
     * @return array
     */

    public static function get_user_id_and_type($email = ''){
        $user = DB::table('users')->where('email', $email)->first();;
        return array($user->id,$user->user_type);
    }

    /**
     * @return array
     */
    public static function get_cart_item(){
        $sql = "select * from resource where resource_id in( ";

        $cart = Session::get('cart');
        if(count($cart)<=0) return [];

        foreach ($cart as $id){
            $sql .= $id.',';
        }
        $sql[strlen($sql)-1] = ')';

        return DB::select($sql);
    }

    public static function cart_confirm(){
        $values = "";
        $user_id = Session::get('user_id');

        foreach (Session::get('cart') as $data){
            $values .= '('.$user_id.','.$data.'),';
        }
        $values[strlen($values)-1] = ';';

        $sql = 'insert into temp(user_id, resource_id) VALUES '.$values;

        try{
            DB::insert($sql);


        }catch (QueryException $ex){
            dd($ex->getMessage());
        }

        $cart = array();
        Session::forget('cart');
        Session::put('cart',$cart);
    }

}
