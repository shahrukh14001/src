<?php

namespace App\Http\Controllers\Web;

use App\Models\Document;
use App\Orange\Helpers\DocumentHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{

    public function __construct() {
        return $this->middleware('can:super_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index() {
        return view('document.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     * @throws \Exception
     */
    public function store(Request $request) {
        try {
            (new DocumentHelper())->create($request->only(['name', 'description', 'category_id', 'url', 'thumbnail_url']));

            return response()->json([
                'status'    => [
                    'response'  => 'success',
                    'code'      => 200,
                    'message'   => 'Document created successfully',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => [
                    'response'  => 'error',
                    'code'      => 403,
                    'message'   => $e->getMessage(),
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $document
     * @return mixed
     */
    public function show(Document $document) {
        return view('document.show', ['document' => $document]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $document
     * @return mixed
     */
    public function destroy(Document $document) {
        try {
            if($document) {
                if($document->delete()) {
                    return response()->json([
                        'status'    => [
                            'code'      => 200,
                            'response'  => 'success',
                            'error'     => '',
                            'message'   => 'Document deleted successfully'
                        ]
                    ]);
                }
            }
            throw new \Exception('Invalid request, please try again');
        } catch (\Exception $exception) {
            return response()->json([
                'status'    => [
                    'code'      => 403,
                    'response'  => 'error',
                    'message'   => 'Invalid request',
                    'error'     => $exception->getMessage()
                ]
            ]);
        }
    }
}
