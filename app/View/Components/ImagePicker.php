<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImagePicker extends Component
{
    public $type;
    public $preloadMedia;


    public function __construct($type, $preloadMedia='')
    {
        $this->type = $type;
        $this->preloadMedia = $preloadMedia;
    }
    public function render()
    {
        return view('components.image-picker');
    }
}
