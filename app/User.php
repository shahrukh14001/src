<?php

namespace App;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }
    public static function findBy($start, $limit, $order, $dir, $search = null, $filter = null) {
        /*  Filter for Category this is disabled    */
        if ($search)
            return self::query()
                ->where( function ($query) use ($search) {
                    $query->orWhere('name', 'like', "%{$search}%");
                    $query->orWhere('description', 'like', "%{$search}%");
                    $query->orWhere('mobile', 'like', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->with('role')
                ->get();
        return self::query()
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->with('role')
            ->get();
    }

    public static function findByCount($search = null, $filter = null) {
        /*  Filter for Category this is disabled    */
        if ($search)
            return self::query()
                ->where( function ($query) use ($search) {
                    $query->orWhere('name', 'like', "%{$search}%");
                    $query->orWhere('description', 'like', "%{$search}%");
                    $query->orWhere('mobile', 'like', "%{$search}%");
                })
                ->count();
        return self::query()
            ->count();
    }
}
