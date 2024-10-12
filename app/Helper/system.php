<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

function imageUrl($img, $size = '')
{
    return (!empty($size)) ? url('/image/' . $size . '/' . $img) : url('/image/' . $img);
}

function fileUrl($file)
{
    return url('files/' . $file);
}

function getAdmin()
{

    if (Auth::guard('admin')->check()) {
        return Auth::guard('admin')->user();
    }
    return null;

}
function locales()
{
    $arr = [];
    foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $arr[$key] = __($key);
    }
    return $arr;
}

function filterData($items)
{
    $pagination = \Input::get('pagination');
    $query = \Input::get('query');
    $search = isset($query['generalSearch']) ? $query['generalSearch'] : null;
    // if ($pagination['perpage'] == -1 || $pagination['perpage'] == null) {
    //     $pagination['perpage'] = 10;
    // }
    if (isset($search)) {
        $items->filter($search);
    }
    $itemsCount = $items->count();
    $items = $items->take(10)->skip(10 * 0)->get();
    $pagination['total'] = $itemsCount;
    $pagination['pages'] = ceil($itemsCount / 10);
    $data['meta'] = $pagination;
    $data['data'] = $items;
    return $data;
}

function getSeting($key)
{
    $setting = Setting::where('key', $key)->first();

    return @$setting->value;
}

function cutString($text, $length)
{
    $text = strip_tags($text);

    $text = str_replace("&nbsp;", " ", $text);

    if (strlen($text) > $length) {
        return mb_substr($text, 0, $length) . '...';
    } else {
        return $text;
    }
}

function changeDateFormate($date, $date_format = 'Y-m-d')
{
    if (app()->isLocale('ar')) {
        \Carbon\Carbon::setLocale('ar');
    } else {
        \Carbon\Carbon::setLocale('en');
    }
    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($date_format);
}

function getVersionAssets()
{
    return env('VERSION_ASSETS');
}


function MenusCheck($menus)
{
    $items = array_filter($menus, function ($item) {
        return $item['permission_check'] == true;
    });
    return $items;
}

