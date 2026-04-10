<?php

namespace App\Helpers;

use App\Models\Department;
use App\Models\Branches;

class Helper
{
    public static function getLocationName($type, $id)
    {
        if ($type === 'department') {
            $record = Department::find($id);
            return $record ? $record->departmentName : 'N/A';
        } else {
            $record = Branches::find($id);
            return $record ? $record->branchName : 'N/A';
        }
    }
}