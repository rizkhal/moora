<?php

namespace App\Providers;

use App\Services\Configable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('setting_emails')) {
            if ($conf = Configable::getConfig('setting_emails')) {
                Config::set('mail.mailers.smtp.host', $conf->host);
                Config::set('mail.mailers.smtp.port', $conf->port);
                Config::set('mail.mailers.smtp.username', $conf->username);
                Config::set('mail.mailers.smtp.password', $conf->password);
                Config::set('mail.mailers.smtp.encryption', $conf->encryption);

                Config::set('mail.from.name', $conf->from_name);
                Config::set('mail.from.address', $conf->from_address);
            }
        }
    }
}
