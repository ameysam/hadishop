<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Chart;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeFrontController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $products = Product::with('category')->latest('id')->take(10)->get();

        return
        $data = [
            'sliders' => $sliders,
            'products' => $products,
        ];
        return view('home.front', $data);
    }
}
