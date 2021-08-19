<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostReportCreateRequest;
use App\Jobs\SendReportEmailToAdmin;
use App\Jobs\SentReportEmailToAdmin;

class PostReportController extends Controller
{
    /**
     * @param PostReportCreateRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(PostReportCreateRequest $request)
    {
        $report = $request->commit();
        $image = $request->report_image;
        if (isset($image)){
            $report->addMediaFromBase64($image)
                ->toMediaCollection('report-image');
        }
        SendReportEmailToAdmin::dispatch($report);

        return $this->response->array([
            'error' => false,
            'message' => 'Report request successfully created'
        ]);
    }
}
