<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Company::with(['team'])->select(sprintf('%s.*', (new Company())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'company_show';
                $editGate = 'company_edit';
                $deleteGate = 'company_delete';
                $crudRoutePart = 'companies';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('shortname', function ($row) {
                return $row->shortname ? $row->shortname : '';
            });
            $table->editColumn('mer_reg', function ($row) {
                return $row->mer_reg ? $row->mer_reg : '';
            });
            $table->editColumn('mer_pas_key', function ($row) {
                return $row->mer_pas_key ? $row->mer_pas_key : '';
            });
            $table->editColumn('domain_url', function ($row) {
                return $row->domain_url ? $row->domain_url : '';
            });
            $table->editColumn('s_uri', function ($row) {
                return $row->s_uri ? $row->s_uri : '';
            });
            $table->editColumn('f_uri', function ($row) {
                return $row->f_uri ? $row->f_uri : '';
            });
            $table->editColumn('c_uri', function ($row) {
                return $row->c_uri ? $row->c_uri : '';
            });
            $table->editColumn('ipn_channel', function ($row) {
                return $row->ipn_channel ? Company::IPN_CHANNEL_SELECT[$row->ipn_channel] : '';
            });
            $table->editColumn('ipn_email', function ($row) {
                return $row->ipn_email ? $row->ipn_email : '';
            });
            $table->editColumn('ipn_uri', function ($row) {
                return $row->ipn_uri ? $row->ipn_uri : '';
            });
            $table->editColumn('mac_addr', function ($row) {
                return $row->mac_addr ? $row->mac_addr : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });
            $table->editColumn('has_ekpay_id_no', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->has_ekpay_id_no ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'active', 'has_ekpay_id_no']);

            return $table->make(true);
        }

        return view('admin.companies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->all());

        return redirect()->route('admin.companies.index');
    }

    public function edit(Company $company)
    {
        abort_if(Gate::denies('company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->load('team');

        return view('admin.companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // dd($request->all());
        $company->update($request->all());

        return redirect()->route('admin.companies.index')->with('success','Company data update successfully');
    }

    public function show(Company $company)
    {
        abort_if(Gate::denies('company_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->load('team', 'companyUsers');

        return view('admin.companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        abort_if(Gate::denies('company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyRequest $request)
    {
        Company::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
