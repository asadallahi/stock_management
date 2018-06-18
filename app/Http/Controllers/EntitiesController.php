<?php

namespace App\Http\Controllers;

use App\Entity;
use Carbon\Carbon;
use Illuminate\Http\Request;
    use Yajra\Datatables\Datatables;

class EntitiesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('entities.index');
    }

    public function getData()
    {
        return Datatables::of(Entity::query())->make(true);
    }

    public function create()
    {
        return view('entities.create');
    }

    public function store(Request $request)
    {
        $entity = new Entity();
        $entity->license_id = 1;
        $entity->user_id = 1;
        $entity->name = $request->name;
        $entity->preview = '';
        $entity->deep_link = '';
        $entity->created_by = 1;
        $entity->expire_time = $request->expire_time;
        $entity->name = $request->name;
        if ($entity->save())
        {
            $insert_id = $entity->id;
            $preview_path = $request->file('preview')->storeAS('public/preview', $insert_id);
            $deep_link_path = $request->file('deep_link')->storeAS('public/deep_link', $insert_id);

            $entity->preview=$preview_path;
            $entity->deep_link=$deep_link_path;
            if($entity->update()){
                return 'ok';
            }
        }


    }
}