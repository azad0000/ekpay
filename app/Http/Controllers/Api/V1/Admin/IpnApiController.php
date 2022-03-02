<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\IpnResource;
use App\Models\Ipn;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpnApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ipn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IpnResource(Ipn::with(['txn_id_no', 'team'])->get());
    }

    public function show(Ipn $ipn)
    {
        abort_if(Gate::denies('ipn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IpnResource($ipn->load(['txn_id_no', 'team']));
    }
}
