<?php

namespace App\View\Components\User;

use App\Models\City;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Form extends Component
{
    public User $user;
    public bool $isUpdate;
    public Collection $cities;
    public Collection $departments;

    public function __construct(
        User $user = null,
        bool $isUpdate = false,
        Collection $cities = null,
        Collection $departments = null,
    )
    {
        $this->user = $user;
        $this->isUpdate = $isUpdate;
        $this->cities = $cities ?? collect();
        $this->departments = $departments ?? collect();
    }

    public function render(): View|Closure|string
    {
        return view('components.user.form');
    }
}
