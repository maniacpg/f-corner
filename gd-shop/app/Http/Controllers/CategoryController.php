<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index($slug, $categoryId)
    {

        $categoriesList = $this->category->where('parent_id', 0)->take(3)->get();
        $products = $this->product->where('category_id', $categoryId)->paginate(15);
        $categories = $this->category->where('parent_id', 0)->get();
        $categoryChild = $this->category->find($categoryId);
        return view('product.category.list', compact('categoriesList', 'products', 'categories', 'categoryChild'));
    }
}
