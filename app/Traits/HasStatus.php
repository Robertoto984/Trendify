<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasStatus
{

    public function statusLabel(): Attribute
    {
        return new Attribute(
            get: fn() => $this->is_active ? 'مفعلة' : 'غير مفعلة'
        );
    }

    public function statusBadgeClass(): Attribute
    {
        return new Attribute(
            get: fn() => $this->is_active
                ? 'bg-gradient-success'
                : 'bg-gradient-danger'
        );
    }

    public function isActiveLabel(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status ? 'مفعلة' : 'غير مفعلة'
        );
    }

    public function isActiveBadgeClass(): Attribute
    {
        return new Attribute(
            get: fn() => $this->status
                ? 'bg-gradient-success'
                : 'bg-gradient-danger'
        );
    }
}
