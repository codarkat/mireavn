<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Category;
use App\Models\IKBO;
use App\Models\ListVote;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Setting;
use App\Models\ShippingFee;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('main.index');
    }

    //Hàm cho trang IKBO
    public function clubIKBO(){
        $dataIKBOs = IKBO::all();
        $urlPhoto = asset("data/images/upload/ikbo/");

        return view('main.ikbo', [
            'dataIKBOs' => $dataIKBOs,
            'urlPhoto' => $urlPhoto,
        ]);
    }

    //Hàm cho trang MIREA FC
    public function clubMireaFC(){
        $dataIKBOs = IKBO::all();
        $urlPhoto = asset("data/images/upload/ikbo/");

        return view('main.coming-soon', [
            'dataIKBOs' => $dataIKBOs,
            'urlPhoto' => $urlPhoto,
        ]);
    }

}
