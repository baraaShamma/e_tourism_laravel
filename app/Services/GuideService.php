<?php

namespace App\Services;

use App\Models\User;

class GuideService
{
    public function getGuide()
    {
        return User::where('type_user', 'guide')->get();
    }

    public function deleteGuide($guide)
    {
        return $guide->delete();
    }
}
