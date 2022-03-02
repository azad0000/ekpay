<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Company;
use App\Models\Team;
use App\Models\Transaction;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Transaction::with(['company', 'team'])->select(sprintf('%s.*', (new Transaction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_show';
                $editGate = 'transaction_edit';
                $deleteGate = 'transaction_delete';
                $crudRoutePart = 'transactions';

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
            $table->editColumn('cust_id_no', function ($row) {
                return $row->cust_id_no ? $row->cust_id_no : '';
            });
            $table->editColumn('cust_name', function ($row) {
                return $row->cust_name ? $row->cust_name : '';
            });
            $table->editColumn('cust_mobo_no', function ($row) {
                return $row->cust_mobo_no ? $row->cust_mobo_no : '';
            });
            $table->editColumn('cust_email', function ($row) {
                return $row->cust_email ? $row->cust_email : '';
            });
            $table->editColumn('cust_mail_addr', function ($row) {
                return $row->cust_mail_addr ? $row->cust_mail_addr : '';
            });
            $table->editColumn('merchant_trnx_id_no', function ($row) {
                return $row->merchant_trnx_id_no ? $row->merchant_trnx_id_no : '';
            });
            $table->editColumn('merchant_trnx_amt', function ($row) {
                return $row->merchant_trnx_amt ? $row->merchant_trnx_amt : '';
            });
            $table->editColumn('trnx_currency', function ($row) {
                return $row->trnx_currency ? Transaction::TRNX_CURRENCY_RADIO[$row->trnx_currency] : '';
            });
            $table->editColumn('merchant_ord_id_no', function ($row) {
                return $row->merchant_ord_id_no ? $row->merchant_ord_id_no : '';
            });
            $table->editColumn('merchant_ord_det', function ($row) {
                return $row->merchant_ord_det ? $row->merchant_ord_det : '';
            });
            $table->addColumn('company_shortname', function ($row) {
                return $row->company ? $row->company->shortname : '';
            });

            $table->editColumn('payment_url', function ($row) {
                return $row->payment_url ? $row->payment_url : '';
            });
            $table->editColumn('secure_token', function ($row) {
                return $row->secure_token ? $row->secure_token : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company']);

            return $table->make(true);
        }

        $companies = Company::get();
        $teams     = Team::get();

        return view('admin.transactions.index', compact('companies', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('shortname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactions.create', compact('companies'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());

        //create slug - Rana
        $slug = Str::slug($transaction->merchant_trnx_id_no, '-');
        $url = URL::to('/make-payment/'.$slug);

        Transaction::where('id',$transaction->id)->update(['payment_url' => $url]);

        return redirect()->route('admin.transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('shortname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction->load('company', 'team');

        return view('admin.transactions.edit', compact('companies', 'transaction'));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index');
    }

    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('company', 'team');

        return view('admin.transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionRequest $request)
    {
        Transaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
