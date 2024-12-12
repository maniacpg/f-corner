<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $slider;
    private $category;
    private $product;
    private $setting;

    public function __construct(Slider $slider, Category $category, Product $product, Setting $setting)
    {
        $this->setting = $setting;
        $this->product = $product;
        $this->category = $category;
        $this->slider = $slider;
    }

    public function index()
    {
        $sliders = $this->slider->latest()->whereNull('deleted_at')->get();
        $categories = $this->category->where('parent_id', 0)->get();
        $products = $this->product->get();
        $productRecommends = $this->product->latest('views-count', 'desc')->take(12)->get();
        $categoriesList = $this->category->where('parent_id', 0)->take(3)->get();
        return view('home.home', compact('sliders', 'categories', 'products', 'productRecommends', 'categoriesList'));
    }
    public function page404(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('errors.404');
    }


}
