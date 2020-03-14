<?php

namespace App\Http\Controllers\Web\Documents;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentListController extends Controller
{
    public function index(Request $request) {
        $columns = array(
            0 => 'name',
            1 => 'description',
            2 => 'url',
            3 => 'status'
        );

        $start  = $request->all()['start'];
        $limit  = $request->all()['length'];
        $order  = $columns[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $recordsTotal = $recordsFiltered = Document::query()->count();

        if (empty($search)) {
            $itemData   = Document::findBy($start, $limit, $order, $dir);
        } else {
            $itemData           = Document::findBy($start, $limit, $order, $dir, $search);
            $recordsFiltered    = Document::findByCount($search);
        }

        return [
            'draw'  => $request->all()['draw'],
            'recordsTotal'   => $recordsTotal,
            'recordsFiltered'   => $recordsFiltered,
            'data'              => $itemData ? $itemData->map( function ($document) {
                return [
                    'name'          => $document->name ? $document->name : '-',
                    'description'   => $document->description ? $document->description : '-',
                    'url'           => $document->url ? $this->getUrl($document->url) : '-',
                    'status'        => $document->status ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>',
                    'actions'       => $this->getActions($document->id)
                ];
            }) : [],
        ];
    }

    private function getActions($id) {
        $edit =  '<span class="btn-box-tool pointer" data-toggle="tooltip" title="Edit Document"><a href="'.route('documents.show', $id).'"><i class="fa fa-lg fa-pen-square text-primary"></i></a></span>';
        $delete = '<span class="delete-document btn-box-tool pointer" data-id="'.$id.'" data-toggle="tooltip" title="Edit Board"><a href="javascript:void(0)"><i class="fa fa-lg fa-trash text-red"></i></a></span>';
        return $edit . $delete;
    }

    private function getUrl($url) {
        return '<span class="copy-url btn-box-tool" title="'.$url.'"><i class="fa fa-lg fa-copy"></i></span>';
    }
}
