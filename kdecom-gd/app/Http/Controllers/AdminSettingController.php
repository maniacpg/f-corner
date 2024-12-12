<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSettingRequest;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;

class AdminSettingController extends Controller
{
    use DeleteModelTrait;
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $setting = $this->setting->latest()->paginate(10);
        return view('admin.setting.index', compact('setting'));
    }

    public function create()
    {
        return view('admin.setting.add');
    }

    public function store(AddSettingRequest $request)
    {
        $this->setting->create([
            'config_key' => request('config_key'),
            'config_value' => request('config_value'),
            'type_input' => $request->type,
        ]);
        return redirect()->route('settings.index');
    }

    public function edit($id)
    {
        $settings = $this->setting->find($id);
       return view('admin.setting.edit', compact('settings'));
    }
    public function update(Request $request, $id)
    {
        $this->setting->find($id)->update([
            'config_key' => request('config_key'),
            'config_value' => request('config_value')
        ]);
        return redirect()->route('settings.index');
    }
    public function delete($id)
    {
        return $this->deleteModeltrait($id, $this->setting);
    }
}
