<?php

namespace App\Http\Livewire\Setting;

use App\Constants\Status;
use App\Models\Email;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting as ModelsSetting;
use App\Models\SettingReqruitment;

class Setting extends Component
{
    use WithFileUploads;

    /** @var string */
    // req
    public $pas_min;
    public $req_status;
    // mail
    public $mail_encryption;
    public $mail_driver;
    public $mail_host;
    public $mail_port;
    public $mail_username;
    public $mail_password;
    public $mail_from_name;
    public $mail_from_address;
    // site
    public $site_name;
    public $site_description;
    public $site_landing_title;
    public $site_landing_description;
    public $site_logo;
    public $site_logo_text;

    public function mount()
    {
        $this->settingSite()->settingEmail()->settingReq();
    }

    protected function settingReq()
    {
        $req = SettingReqruitment::first();
        $this->pas_min = $req->pas_min;
        $this->req_status = Status::key($req->req_status);
    }

    protected function settingEmail(): self
    {
        $mail = Email::first();
        $this->mail_encryption = $mail->mail_encryption;
        $this->mail_driver = $mail->mail_driver;
        $this->mail_host = $mail->mail_host;
        $this->mail_port = $mail->mail_port;
        $this->mail_username = $mail->mail_username;
        $this->mail_password = $mail->mail_password;
        $this->mail_from_name = $mail->mail_from_name;
        $this->mail_from_address = $mail->mail_from_address;

        return $this;
    }

    protected function settingSite(): self
    {
        $setting = ModelsSetting::first();
        $this->site_name = $setting->site_name;
        $this->site_description = $setting->site_description;
        $this->site_landing_title = $setting->site_landing_title;
        $this->site_landing_description = $setting->site_landing_description;
        $this->site_logo = $setting->site_logo;
        $this->site_logo_text = $setting->site_logo_text;

        return $this;
    }

    public function setupReq()
    {
        $validated = $this->validate([
            'pas_min' => 'required',
            'req_status' => 'required'
        ]);

        try {
            SettingReqruitment::first()->update($validated);

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => 'Reqruitment berhasil diatur 🥳'
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function setupMail()
    {
        $validated = $this->validate([
            'mail_encryption' => 'required',
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_from_name' => 'required',
            'mail_from_address' => 'required',
        ]);

        try {
            Email::first()->update($validated);

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => 'Email berhasil diatur 🥳'
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function setupSite()
    {
        $validated = $this->validate([
            'site_name' => 'required',
            'site_description' => 'required',
            'site_landing_title' => 'required',
            'site_landing_description' => 'required',
            'site_logo' => 'required',
            'site_logo_text' => 'required',
        ]);
        
        try {
            if (is_object($this->site_logo)) {
                $filename = $this->site_logo->store('logo');
                $validated['site_logo'] = $filename;
            }

            ModelsSetting::first()->update($validated);

            $this->dispatchBrowserEvent('flash', [
                'color' => 'green',
                'message' => 'Situs berhasil diatur 🥳'
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.setting.index', [
            'title' => 'Pengaturan',
            'status' => Status::labels(),
        ])->extends('layouts.app');
    }
}
