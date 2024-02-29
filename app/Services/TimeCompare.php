<?php

namespace App\Services;
use Carbon\Carbon;

class TimeCompare
{
    public static function getStatus($updated_at, $deleted_at, $inputTime)
    {
        $status = "created";

        if ($updated_at && Carbon::parse($updated_at)->timestamp < $inputTime) {
            $status = "updated";
        }

        if ($deleted_at && Carbon::parse($deleted_at)->timestamp < $inputTime) {
            $status = "deleted";
        }

        return $status;
    }
}