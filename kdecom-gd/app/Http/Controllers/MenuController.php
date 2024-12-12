<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Components\MenuRecusive;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    private $menu;

    public function __construct( Menu $menu)
    {
        $this->menu = $menu;
    }
    public function getMenu($parentId)
    {
        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        $optionSelect = $recusive->RecusiveMenu($parentId);
        return $optionSelect;
    }
    public function index()
    {
        $menus = $this->menu->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $optionSelect = $this->getMenu($parentId = '');

        return view('admin.menus.add', compact('optionSelect'));
    }

    public function store(Request $request)
    {

        // Tạo menu mới
        $menu = Menu::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => Str::slug($request->input('name')),
        ]);

        $optionSelect = $this->getMenu($parentId = '');

        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'message' => 'Menu đã được lưu thành công!',
            'menu' => $menu,
            'optionSelect' => $optionSelect
        ]);
    }
    public function edit($id)
    {
        $menuFollowIdEdit = $this->menu->find($id);
        $optionSelect = $this->getMenu($menuFollowIdEdit->parent_id);
        return view('admin.menus.edit', compact('optionSelect', 'menuFollowIdEdit'));
    }
    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'slug' => Str::slug($request->input('name')),
        ]);

        // Lấy lại danh sách menu sau khi thêm
        $optionSelect = $this->getMenu($parentId = '');
        // Trả về phản hồi JSON
        return response()->json([
            'success' => true,
            'optionSelect' => $optionSelect
        ]);
    }
    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}
