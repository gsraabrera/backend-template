<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Services\ActivityLogService;

class ActivityLogController extends Controller
{
            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ActivityLogService $activityLogService)
    {
        return response()->json(
            [
             'activity_logs' => $activityLogService->filter($request),
            ], 200
        );
        
    }
}
