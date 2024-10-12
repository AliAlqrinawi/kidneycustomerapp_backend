<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\DB;

class SettingRepository
{

    public function index()
    {

        $data['settings'] = new Setting();

        $data['socials'] = SocialMedia::all();

        return $data;
    }

    public function update($request)
    {

        DB::beginTransaction();
        try {
            $setting = new Setting();

            $keys = SocialMedia::all()->pluck('key')->toArray();
            $socialItems = $request->only($keys);
            $settingItems = $request->except(array_merge($keys, ['_token', '_method', 'file', 'name_ar', 'link']));

            foreach ($settingItems as $i => $input) {
                $setting->updateOrCreate(['key' => $i], ['value' => (isset($input)) ? $input : '']);
            }

            foreach ($socialItems as $i => $input) {
                $social = SocialMedia::where('key', $i)->first();
                if (!isset($social)) {
                    $message = __('message.unexpected_error');
                    $status = false;
                }
                $social->updateItem($input);
            }

            $message = __('message.operation_accomplished_successfully');
            $status = true;

            DB::commit();
        } catch (\Exception $e) {
            $message = __('message.unexpected_error');
            $status = false;
            DB::rollback();
        }
        $response = [
            'message' => $message,
            'status' => $status,
        ];

        return $response;
    }
}
