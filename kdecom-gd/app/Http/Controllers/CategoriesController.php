<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    use DeleteModelTrait;
    private $category;

    public function __construct(Category $category)
    {

        $this->category = $category;
    }

    public function create()
    {
        $htmlOption = $this->getCate($parentId = '');

        return view('admin.category.add', compact('htmlOption'));
    }

    public function index()
    {
        $categories = $this->category->latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => request('name'),
            'parent_id' => request('parent_id'),
            'slug' => Str::slug(request('name')),
        ]);
        // Lấy tất cả danh mục sau khi thêm mới
        $htmlOption = $this->getCate($parentId = '');

        // Trả về dữ liệu vừa lưu và danh sách danh mục mới
        return response()->json([
            'success' => true,
            'name' => $this->category->name,
            'parent_id' => $this->category->parent_id,
            'htmlOption' => $htmlOption,
        ]);
    }

    public function getCate($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecursive($parentId);
        return $htmlOption;
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCate($category->parent_id);

        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update( $id, Request $request)
    {

        $this->category->find($id)->update([
            'name' => request('name'),
            'parent_id' => request('parent_id'),
            'slug' => Str::slug(request('name')),
        ]);

        // Lấy danh sách danh mục sau khi cập nhật
        $htmlOption = $this->getCate($parentId = '');

        return response()->json([
            'success' => true,
            'htmlOption' => $htmlOption,
        ]);
    }

    public function delete($id)
    {
        return $this->deleteModeltrait($id, $this->category);
    }
}
