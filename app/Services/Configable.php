<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Configable
{
    public static function getConfig(string $table)
    {
        if (Schema::hasTable($table)) {
            return DB::table($table)->first();
        }

        return false;
    }

    public static function upsert(string $table, array $request): bool
    {
        DB::beginTransaction();

        try {
            $query = DB::table($table)->first();
            if ($query) {
                $ret = DB::table($table)
                    ->where('id', $query->id)->update(
                        array_merge([
                            'updated_at' => now(),
                        ], $request)
                    );

                DB::commit();
                Artisan::call('config:clear');
                return $ret ? true : false;
            }

            $ret = DB::table($table)
                ->insert(
                    array_merge([
                        'created_at' => now(),
                    ], $request)
                );

            DB::commit();
            Artisan::call('config:clear');
            return $ret ? true : false;
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('Failed to toggle table', [
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
            ]);
            return false;
        }
    }
}
