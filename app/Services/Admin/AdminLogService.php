<?php
namespace App\Services\Admin;

use App\Models\AdminLog;
use Exception;

class AdminLogService
{
    public function logAction($adminId, $action, $tableName, $recordId, $description, $originalData = null, $newData = null)
    {
        
        try {
            $changes = [];
            
            // \Log::debug('Original Data:', (array) $originalData);
            // \Log::debug('New Data:', (array) $newData);

            if ($originalData && $newData) {
                foreach ($newData as $key => $newValue) {
                    $oldValue = $originalData[$key] ?? null;

                    \Log::debug("Checking field '{$key}': Old Value: {$oldValue}, New Value: {$newValue}");
                    
                    if ($oldValue !== $newValue) {
                        $changes[$key] = [
                            'old' => $oldValue,
                            'new' => $newValue,
                        ];
                    }
                }
            }

            // \Log::debug('Changes after comparison:', $changes);

            AdminLog::create([
                'admin_id' => $adminId,
                'action' => $action,
                'table_name' => $tableName,
                'record_id' => $recordId,
                'description' => $description,
                'changes' => !empty($changes) ? json_encode($changes) : null,
            ]);

        } catch (Exception $e) {
            \Log::error('Error adding AdminLog: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            throw new Exception('Error adding AdminLog: ' . $e->getMessage());
        }
    }
}
