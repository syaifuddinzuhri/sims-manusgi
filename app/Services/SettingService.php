<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get(){
        try{
            return Setting::first();
        }catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }

    public function update($payload){
        try{
            $setting = $this->get();
            if(!$setting){
                Setting::create($payload);
            } else {
                $setting->update($payload);
            }
            return ;
        }catch (\Exception $e) {
            throw $e;
            report($e);
            return $e;
        }
    }
}
