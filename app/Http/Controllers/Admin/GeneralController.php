<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGeneralRequest;
use App\Http\Requests\StoreGeneralRequest;
use App\Http\Requests\UpdateGeneralRequest;
use App\Models\General;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('general_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $generals = General::all();

        return view('admin.generals.index', compact('generals'));
    }

    public function create()
    {
        abort_if(Gate::denies('general_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.generals.create');
    }

    public function store(StoreGeneralRequest $request)
    {
        $general = General::create($request->all());

        return redirect()->route('admin.generals.index');
    }

    public function edit(General $general)
    {
        abort_if(Gate::denies('general_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.generals.edit', compact('general'));
    }

    public function update(UpdateGeneralRequest $request, General $general)
    {
        $general->update($request->all());

        return redirect()->route('admin.generals.index');
    }

    public function show(General $general)
    {
        abort_if(Gate::denies('general_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.generals.show', compact('general'));
    }

    public function destroy(General $general)
    {
        abort_if(Gate::denies('general_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $general->delete();

        return back();
    }

    public function massDestroy(MassDestroyGeneralRequest $request)
    {
        General::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
