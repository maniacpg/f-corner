<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function showAllProduct()
    {
        $sliders = $this->slider->latest()->whereNull('deleted_at')->get();
        $categories = $this->category->where('parent_id', 0)->get();
        $products = $this->product->get();
        $productRecommends = $this->product->latest('views-count', 'desc')->take(12)->get();
        $categoriesList = $this->category->where('parent_id', 0)->take(3)->get();
        return view('product.all-product', compact('sliders', 'categories', 'products', 'productRecommends', 'categoriesList'));
    }
    public function showDetail($id)
    {
        $sliders = $this->slider->latest()->whereNull('deleted_at')->get();
        $categories = $this->category->where('parent_id', 0)->get();
        $products = Product::find($id);

        $productRecommends = $this->product->latest('views-count', 'desc')->take(12)->get();
        $categoriesList = $this->category->where('parent_id', 0)->take(3)->get();
        return view('product.detail', compact('sliders', 'categories', 'products', 'productRecommends', 'categoriesList'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Tìm kiếm sản phẩm theo tên gần đúng
        $products = Product::where('name', 'LIKE', '%' . $query . '%')->get();

        return view('product.search-results', compact('products', 'query'));
    }
}
