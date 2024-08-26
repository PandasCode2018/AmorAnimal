<?php

namespace App\Http\Traits;

trait withTours
{
    public function showTours(array $steps)
    {
        $this->dispatch('tutorial',  $steps);
    }

    public function showInicio($steps)
    {
        $this->showTours($steps);
    }
}
