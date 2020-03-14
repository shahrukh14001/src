<?php

namespace App\Http\Controllers\Web\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    public function index(Request $request) {
        $columns = array(
            0 => 'name',
            1 => 'email',
            2 => 'mobile',
            3 => 'role'
        );

        $start  = $request->all()['start'];
        $limit  = $request->all()['length'];
        $order  = $columns[$request->input('order.0.column')];
        $dir    = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $recordsTotal = $recordsFiltered = User::query()->count();

        if (empty($search)) {
            $itemData   = User::findBy($start, $limit, $order, $dir);
        } else {
            $itemData           = User::findBy($start, $limit, $order, $dir, $search);
            $recordsFiltered    = User::findByCount($search);
        }

        return [
            'draw'  => $request->all()['draw'],
            'recordsTotal'   => $recordsTotal,
            'recordsFiltered'   => $recordsFiltered,
            'data'              => $itemData ? $itemData->map( function ($user) {
                return [
                    'name'          => $user->name,
                    'email'        => $user->email,
                    'mobile'        => $user->mobile,
                    'role'          => $user->role->name == 'Guest User' ? '<span class="label label-default">Viewer</span>' : '<span class="label label-primary">Super Admin</span>',
                    'actions'       => $user->status ? '<span class="label label-success" onclick="changeStatus('.$user->id.', 0)" style="cursor: pointer">Enabled</span>' : '<span class="label label-danger" onclick="changeStatus('.$user->id.', 1)" style="cursor: pointer">Disabled</span>',
                ];
            }) : [],
        ];
    }
}
