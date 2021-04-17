<?php

namespace App\DynamicTable\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DynamicTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data,$model)
    {
       $this->data=$data;
       $this->columns=$model::dynamicTableColumns();


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.dynamic-table',['data'=>$this->data,'columns'=>$this->columns]);
    }
}
