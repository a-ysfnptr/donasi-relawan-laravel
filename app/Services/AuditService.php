<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditService
{
    public static function log(string $action, string $entity, $entityId, string $detail = ''): void
    {
        AuditLog::record(Auth::user(), $action, $entity, $entityId, $detail);
    }
}
