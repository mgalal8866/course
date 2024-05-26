<?php

namespace App\Livewire\Dashboard\Setting;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting as ModelsSetting;
use Livewire\WithFileUploads;

class Setting extends Component
{
    use WithFileUploads;
    public $data, $data2,$image1;

    public function save($set)
    {
        dd($this->image1);
        foreach ($this->data[$set] as $key => $value) {
            $sett =  ModelsSetting::where('key', $key)
                ->update(['value' => $value]);
            if (array_key_exists($key, $this->data2) ) {
                // dd($this->data2 );
                if($this->data2[$key]['image'] != null){

                    $dataX = $this->saveImageAndThumbnail($this->data2[$key]['image'], false, null, null, 'home');
                    // dd($dataX['image'],$this->data2[$key]['image'],$key );
                    $sett->update(['value' => $dataX['image']]);
                }
            }

        }
        dd($this->data[$set]);
        $keys = array_keys($this->data[$set]);
        $sequentialKeys = array_values($keys);
        Cache::forget($set);
        getsetting($set, $sequentialKeys);
    }
    public function updatedData($value, $nested)
    {
        // === true  ? 1 : ($value == false ? 0 : $value)
        $nestedData = explode(".", $nested);
        // dd( $value );
        // if($value  ==1 ){

        // };
    }
    public function reloadesetting()
    {

        foreach ($this->data as $key => $value) {

            Cache::forget($key);
            foreach ($this->data[$key] as $key => $value) {
                ModelsSetting::where('key', $key)
                    ->update(['value' => $value ]);
            }
        }
    }
    public function render()
    {

        $this->data2['section2_image'] = ['image' => null];
        $this->data2['section4_image'] = ['image' => null];

        $this->data['footer_setting']   = getsetting('footer_setting', ['phone', 'address', 'mail', 'facebook', 'instegram', 'telegram', 'linkedin', 'youtube', 'description', 'copyright']);
        $this->data['section1_setting'] = getsetting('section1_setting', ['section1_status', 'section1_title', 'section1_sub_title', 'section1_body']);
        $this->data['section2_setting'] = getsetting('section2_setting', ['section2_status', 'section2_title', 'section2_image', 'section2_body']);
        $this->data['section3_setting'] = getsetting('section3_setting', ['section3_status', 'section3_title']);
        $this->data['section4_setting'] = getsetting('section4_setting', ['section4_status', 'section4_title', 'section4_body', 'section4_image']);
        $this->data['section5_setting'] = getsetting('section5_setting', ['section5_status', 'section5_title', 'section5_sub_title']);
        $this->data['section6_setting'] = getsetting('section6_setting', ['section6_status', 'section6_title', 'section6_sub_title']);
        $this->data['section7_setting'] = getsetting('section7_setting', ['section7_status', 'section7_title', 'section7_sub_title']);
        $this->data['section8_setting'] = getsetting('section8_setting', ['section8_status', 'section8_title', 'section8_sub_title']);

        return view('dashboard.setting.setting');
    }
}
