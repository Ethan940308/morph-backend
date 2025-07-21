<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function show($type){
        $record = Content::where('content_type', $type)->firstOrFail();
        
        return success_response(new ContentResource($record));
    }
}
