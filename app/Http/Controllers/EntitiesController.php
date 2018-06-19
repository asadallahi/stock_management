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

    public function index(Request $request)
    {
        $messages = null;

        if ($request->has('result'))
        {
            $messages['type'] = intval($request->result);
            $messages['key'] = $request->result_key;
        }

        return view('entities.index', compact('messages'));
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

            $entity->preview = $preview_path;
            $entity->deep_link = $deep_link_path;
            if ($entity->update())
            {
                return redirect()->route('entities.index', ['result' => true, 'result_key' => 'Image Saved']);

            }

            return redirect()->route('entities.index', ['result' => false, 'result_key' => 'Error!!! Image Could not be Saved']);
        }


    }

    public function edit($id)
    {
        $entity = Entity::findOrFail($id);

        return view('entities.create', compact('entity'));
    }

    public function update($id, Request $request)
    {
        $entity = Entity::findOrFail($id);
        $entity->name = $request->name;
        $entity->expire_time = $request->expire_time;
        if ($request->preview !== null)
        {
            $preview_path = $request->file('preview')->storeAS('public/preview', $id);
        }
        if ($request->deep_link !== null)
        {
            $deep_link_path = $request->file('deep_link')->storeAS('public/deep_link', $id);
        }

        if ($entity->update())
        {
            return redirect()->route('entities.index', ['result' => true, 'result_key' => 'Image Updated']);

        }

        return redirect()->route('entities.index', ['result' => true, 'result_key' => 'Error!!! Image Could not be updated']);

    }

    public function destroy($id)
    {
        $entity = Entity::findOrFail($id);
        if ($entity->delete())
        {
            return redirect()->route('entities.index', ['result' => true, 'result_key' => 'Image Deleted']);
        }
            return redirect()->route('entities.index', ['result' => false, 'result_key' => 'Error!!! Image could not be Deleted']);
    }
}