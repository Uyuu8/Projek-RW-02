<?php

namespace App\Observers;

use App\Models\Warga;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class WargaObserver
{
    // ✅ CREATE
    public function created(Warga $warga)
    {
        AuditLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'create',
            'model_type' => Warga::class,
            'model_id'   => $warga->id,
            'new_values' => $warga->getAttributes(),
        ]);
    }

    // ✅ UPDATE
    public function updating(Warga $warga)
    {
        AuditLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'update',
            'model_type' => Warga::class,
            'model_id'   => $warga->id,
            'old_values' => $warga->getOriginal(),
            'new_values' => $warga->getDirty(),
        ]);
    }

    // ✅ DELETE
    public function deleted(Warga $warga)
    {
        AuditLog::create([
            'user_id'    => Auth::id(),
            'action'     => 'delete',
            'model_type' => Warga::class,
            'model_id'   => $warga->id,
            'old_values' => $warga->getOriginal(),
        ]);
    }
}

