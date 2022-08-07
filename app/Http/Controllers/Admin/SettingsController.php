<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public static $settings = [
        'MAIL_MAILER' => 'Mailer',
        'MAIL_HOST' => 'Host',
        'MAIL_PORT' => "Port",
        'MAIL_USERNAME' => 'Username',
        'MAIL_PASSWORD' => "Password",
        'MAIL_ENCRYPTION' => "Encryption",
        'MAIL_FROM_ADDRESS' => "Mail from address",
        'MAIL_FROM_NAME' => "Mail from name",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $settings = collect();
        foreach ($this::$settings as $s => $x) {
            $setting['message'] = $x;
            $setting['type'] = $s;
            $setting['value'] = env($s);
            $settings->add($setting);
        }
        return view('admin.components.setting.index', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $inputs = $request->except("_token");
        foreach ($inputs as $input => $value) {
            if (array_key_exists($input, $this::$settings)) {
                Setting::where("type", $input)->update(['value' => $value]);
                changeEnvironmentVariable($input, $value);
            } else {
                return redirect()->route("settings.index")->withErrors("Invalid values");
            }
        }
        return redirect()->route('settings.index')->with(['success' => 'Settings ' . __("messages.update")]);
    }
}
