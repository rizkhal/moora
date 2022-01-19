<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use Inertia\Response;
use App\Models\SettingEmail;
use App\Services\Configable;
use App\Models\SettingReqruitment;
use App\Http\Requests\SettingEmailRequest;

class GeneralController extends Controller
{
    public function index(): Response
    {
        $status = collect(Status::cases())->mapWithKeys(fn ($object): array => [$object->value => $object->name])->all();

        return inertia('setting/general', [
            'status' => $status,
            'email' => SettingEmail::first(),
            'reqruitment' => SettingReqruitment::first(),
        ]);
    }

    public function email(SettingEmailRequest $request)
    {
        Configable::upsert('setting_emails', $request->validated());
        return redirect()->back()->with('success', 'Email smtp berhasil diperbarui');
    }
}
