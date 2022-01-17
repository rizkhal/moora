<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\SettingEmail;
use App\Services\Configable;
use App\Http\Requests\SettingEmailRequest;

class GeneralController extends Controller
{
    public function index(): Response
    {
        return inertia('setting/general', [
            'email' => SettingEmail::first(),
        ]);
    }

    public function email(SettingEmailRequest $request)
    {
        Configable::upsert('setting_emails', $request->validated());
        return redirect()->back()->with('success', 'Email smtp berhasil diperbarui');
    }
}
