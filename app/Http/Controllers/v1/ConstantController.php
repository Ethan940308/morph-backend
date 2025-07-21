<?php

namespace App\Http\Controllers\v1;

use App\Enums\ContentType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    public function index()
    {
        return success_response([
            'system' => [
                'version' => '0.0.1'
            ],
            'content_type' => $this->getEnumDetails(ContentType::class),
        ]);
    }

    private function getEnumDetails($enum_class)
    {
        $enums = array_map(function ($enum) {
            return ['value' => $enum->value, 'key' => $enum->name, 'description' => $enum->description()];
        }, $enum_class::cases());
        
        $result = [];
        foreach ($enums as $enum) {
            array_push($result, [
                'key' => $enum['key'],
                'value' => $enum['value'],
                'description' => $enum['description'] ?? null
            ]);
        }
        return $result;
    }
}
