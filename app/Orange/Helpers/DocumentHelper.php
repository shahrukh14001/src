<?php

namespace App\Orange\Helpers;

use App\Models\Document;

class DocumentHelper {
    public function create($attributes) {
        \DB::beginTransaction();
        try {
            if(!$this->validDocument($attributes)) {
                if($document = $this->newDocument($attributes)) {
                    \DB::commit();
                    return $document;
                }
                throw new \Exception("Failed to create document, please try again");
            }
            throw new \Exception("Oops, Document already in use. please try again");
        } catch(\Exception $e) {
            \DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }
    private function validDocument($attributes) {
        return Document::query()
            ->where('name', $attributes['name'])
            ->where('url',  $attributes['url'])
            ->count();
    }

    private function newDocument($attributes) {
        return Document::query()->create($attributes);
    }
}
