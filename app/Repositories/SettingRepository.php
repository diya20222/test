<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

use App\Models\Setting;
use App\Models\Aboutus;

use App\Contracts\SettingContract;

class SettingRepository implements SettingContract
{
    public function updateSetting($data)
    {
        DB::beginTransaction();
        try {
            $setting = Setting::find($data['setting_id']);

            if (isset($data['logo'])) {
                $image = uploadFile($data['logo'], 'image');
                $imagePathName = public_path() . '/storage/image/' . $setting->getRawOriginal('logo');
                if (File::exists($imagePathName)) {
                    File::delete($imagePathName);
                    $data['logo_updated']  = $image;
                }
            } else {
                $data['logo_updated'] = $setting->getRawOriginal('logo');
            }
            $updateRow = [
                'website' => $data['website'],
                'service_time' => $data['service_time'],
                'linkedln' => $data['linkedln'],
                'twitter' => $data['twitter'],
                'logo' => $data['logo_updated'],
                'facebook' => $data['facebook'],
            ];
            $setting->update($updateRow);
            DB::commit();
            return $setting;
        } catch (\Throwable $e) {
            Log::info($e);
            DB::rollBack();
        }
    }
    public function updateAboutus($data)
    {
        DB::beginTransaction();
        try {
            $aboutus = Aboutus::find($data['aboutus_id']);

            if (isset($data['image'])) {
                $image = uploadFile($data['image'], 'aboutus');
                $imagePathName = public_path() . '/storage/aboutus/' . $aboutus->getRawOriginal('image');
                if (File::exists($imagePathName)) {
                    File::delete($imagePathName);
                    $data['image_updated']  = $image;
                }
            } else {
                $data['image_updated'] = $aboutus->getRawOriginal('image');
            }
            $updateRow = [
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $data['image_updated'],
            ];
           
            $aboutus->update($updateRow);
            DB::commit();
            return $aboutus;
        } catch (\Throwable $e) {
            Log::info($e);
            DB::rollBack();
        }
    }
}

