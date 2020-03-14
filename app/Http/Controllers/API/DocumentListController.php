<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentListController extends Controller
{
    public function index(User $user) {
        if ($user) {
            if ($user->status) {
                return response()->json([
                    'status'    => [
                        'Code'      => 200,
                        'Message'   => 'User documents get successfully',
                        'Results'   => Category::count() ? Category::all()->map( function ($category) {
                            return [
                                'name'              => $category->name,
                                'description'       => $category->description ? $category->description : '--',
                                'Documents'         => $category->documents ? $category->documents->map( function ($document) {
                                    return [
                                        'name'          => $document->name,
                                        'description'   => $document->description,
                                        'url'           => $document->url,
                                        'status'        => $document->status ? 'Yes' : 'No',
                                    ];
                                }) : [],
                            ];
                        }) : [],
                    ]
                ]);
            }
            return response()->json([
                'status'    => [
                    'Code'      => 200,
                    'Message'   => 'Your request for digital documents is pending please check back soon.', // If status is not active then popup this message //
                    'Results'   => []
                ]
            ]);
        }
        return response()->json([
            'status'    => [
                'Code'      => 403,
                'Message'   => 'Invalid request',
                'Results'   => []
            ]
        ]);
    }
}
