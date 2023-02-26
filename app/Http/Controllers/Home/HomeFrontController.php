<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chart;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeFrontController extends Controller
{
    public function index()
    {

        $sliders = Slider::get();
        // return
        $products = Product::with('category', 'files')->latest('id')->get();

        $products_latest = Product::with('category', 'files')->latest('id')->orderAvailable()->take(10)->get();

        $products_suggest = Product::with('category', 'files')->whereSuggest()->orderAvailable()->latest('id')->take(8)->get();

        // return
        $categories = Category::with([
            'files',
            'products' => function($q){
                $q->with('category', 'files')->latest('id')->take(10)->get();
            }
        ])->latest('id')->get();


        // return
        $data = [
            'sliders' => $sliders,
            'products' => $products,
            'products_suggest' => $products_suggest,
            'products_latest' => $products_latest,
            'categories' => $categories,
        ];
        return view('home.front', $data);
    }
}
