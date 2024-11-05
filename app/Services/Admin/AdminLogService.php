<?php
namespace App\Services\Admin;

use App\Models\AdminLog;
use Exception;

class AdminLogService
{
    public function logAction($adminId, $action, $tableName, $recordId, $description)
    {
        try {
            AdminLog::create([
                'admin_id' => $adminId,
                'action' => $action,
                'table_name' => $tableName,
                'record_id' => $recordId,
                'description' => $description,
            ]);
        } catch (Exception $e) {
            throw new Exception('Error adding adminLog: ' . $e->getMessage());
        }
    }
}
