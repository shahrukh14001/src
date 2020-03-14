<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    protected $guarded = ['id'];

    public static function findBy($start, $limit, $order, $dir, $search = null, $filter = null) {
        /*Filter for Category this is disabled*/
        if ($search)
            return self::query()
                ->where( function ($query) use ($search) {
                    $query->orWhere('name', 'like', "%{$search}%");
                    $query->orWhere('description', 'like', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        return self::query()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
    }

    public static function findByCount($search = null, $filter = null) {
        /*Filter for Category this is disabled*/
        if ($search)
            return self::query()
                ->where( function ($query) use ($search) {
                    $query->orWhere('name', 'like', "%{$search}%");
                    $query->orWhere('description', 'like', "%{$search}%");
                })
                ->count();
        return self::query()
            ->count();
    }


}
