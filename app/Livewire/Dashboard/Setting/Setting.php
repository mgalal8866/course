<?php

namespace App\Livewire\Dashboard\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting as ModelsSetting;

class Setting extends Component
{
    public $data;

    public function save($set)
    {
        foreach ($this->data[$set] as $key => $value) {
            ModelsSetting::where('key', $key)
                ->update(['value' => $value]);
        }
        $keys = array_keys($this->data[$set]);
        $sequentialKeys = array_values($keys);
        Cache::forget($set);
        getsetting($set, $sequentialKeys);
    }
    public function reloadesetting()
    {

        foreach ($this->data as $key => $value) {

            Cache::forget($key);
            foreach ($this->data[$key] as $key => $value) {
                ModelsSetting::where('key', $key)
                    ->update(['value' => $value]);
            }
        }

    }
    public function render()
    {
        $this->data['footer_setting']   = getsetting('footer_setting', ['phone', 'address', 'mail', 'facebook', 'instegram', 'telegram', 'linkedin', 'youtube', 'description', 'copyright']);
        $this->data['section1_setting'] = getsetting('section1_setting', ['section1_status', 'section1_title', 'section1_sub_title', 'section1_body']);
        $this->data['section2_setting'] = getsetting('section2_setting', ['section2_status', 'section2_title', 'section2_image', 'section2_body']);
        $this->data['section3_setting'] = getsetting('section3_setting', ['section3_status', 'section3_title']);
        $this->data['section4_setting'] = getsetting('section4_setting', ['section4_status', 'section4_title', 'section4_body', 'section4_image']);
        $this->data['section5_setting'] = getsetting('section5_setting', ['section5_status', 'section5_title', 'section5_sub_title']);
        return view('dashboard.setting.setting');
    }
}
