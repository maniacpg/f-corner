<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function createPermission()
    {
        return view('admin.permission.add');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'module_parent' => 'required|string',
            'module_child' => 'required|array', // Sử dụng 'array' nếu bạn muốn nhiều module con
            'module_child.*' => 'string' // Kiểm tra từng phần tử trong mảng
        ]);

        // Lấy key từ request
        $moduleKeyParent = $validatedData['module_parent'];

        // Lấy display_name tương ứng từ cấu hình
        $moduleDisplayNameParent = config("permissions.table_module.$moduleKeyParent");

        // Kiểm tra xem giá trị có hợp lệ không
        if (is_null($moduleDisplayNameParent)) {
            return redirect()->back()->withErrors(['error' => 'Module không hợp lệ.']);
        }

        // Tạo permission cho module cha
        $permission = Permission::create([
            'name' => $moduleKeyParent,
            'display_name' => $moduleDisplayNameParent,
            'parent_id' => 0,
            'key_code' => ''
        ]);

        // Lặp qua các module con
        foreach ($validatedData['module_child'] as $moduleKeyChild) {
            $moduleDisplayNameChild = config("permissions.module_child.$moduleKeyChild");

            // Kiểm tra xem giá trị có hợp lệ không
            if (is_null($moduleDisplayNameChild)) {
                continue; // Bỏ qua nếu module con không hợp lệ
            }

            // Tạo permission cho module con
            Permission::create([
                'name' => $moduleKeyChild.$moduleKeyParent,
                'display_name' => $moduleDisplayNameChild. ' '. $moduleDisplayNameParent,
                'parent_id' => $permission->id,
                'key_code' => $moduleKeyParent . '_' . $moduleKeyChild
            ]);
        }

        return redirect()->back()->with('success', 'Module đã được lưu thành công!');
    }
}
