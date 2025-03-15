<?php

namespace App\Traits;


trait Guarded
{
    public function initializeGuarded()
    {
        $this->guarded = ['id'];
    }
}
