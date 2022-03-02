<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ipn;
use App\Models\Team;
use App\Models\Transaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IpnController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('ipn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ipn::with(['txn_id_no', 'team'])->select(sprintf('%s.*', (new Ipn())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'ipn_show';
                $editGate = 'ipn_edit';
                $deleteGate = 'ipn_delete';
                $crudRoutePart = 'ipns';

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
            $table->addColumn('txn_id_no_merchant_trnx_id_no', function ($row) {
                return $row->txn_id_no ? $row->txn_id_no->merchant_trnx_id_no : '';
            });

            $table->editColumn('msg_code', function ($row) {
                return $row->msg_code ? $row->msg_code : '';
            });
            $table->editColumn('msg_det', function ($row) {
                return $row->msg_det ? $row->msg_det : '';
            });

            $table->editColumn('dgtl_sign', function ($row) {
                return $row->dgtl_sign ? $row->dgtl_sign : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });
            $table->editColumn('ekpay_txn_id_no', function ($row) {
                return $row->ekpay_txn_id_no ? $row->ekpay_txn_id_no : '';
            });
            $table->editColumn('pi_trnx_id_no', function ($row) {
                return $row->pi_trnx_id_no ? $row->pi_trnx_id_no : '';
            });
            $table->editColumn('pi_charge', function ($row) {
                return $row->pi_charge ? $row->pi_charge : '';
            });
            $table->editColumn('ekpay_charge', function ($row) {
                return $row->ekpay_charge ? $row->ekpay_charge : '';
            });
            $table->editColumn('pi_discount', function ($row) {
                return $row->pi_discount ? $row->pi_discount : '';
            });
            $table->editColumn('total_ser_charge', function ($row) {
                return $row->total_ser_charge ? $row->total_ser_charge : '';
            });
            $table->editColumn('ekpay_charge_discount', function ($row) {
                return $row->ekpay_charge_discount ? $row->ekpay_charge_discount : '';
            });
            $table->editColumn('promo_discount', function ($row) {
                return $row->promo_discount ? $row->promo_discount : '';
            });
            $table->editColumn('total_pabl_amt', function ($row) {
                return $row->total_pabl_amt ? $row->total_pabl_amt : '';
            });

            $table->editColumn('pi_name', function ($row) {
                return $row->pi_name ? $row->pi_name : '';
            });
            $table->editColumn('pi_type', function ($row) {
                return $row->pi_type ? $row->pi_type : '';
            });
            $table->editColumn('pi_number', function ($row) {
                return $row->pi_number ? $row->pi_number : '';
            });
            $table->editColumn('pi_gateway', function ($row) {
                return $row->pi_gateway ? $row->pi_gateway : '';
            });
            $table->editColumn('is_settled', function ($row) {
                return $row->is_settled ? Ipn::IS_SETTLED_RADIO[$row->is_settled] : '';
            });
            $table->editColumn('settlement', function ($row) {
                return $row->settlement ? $row->settlement : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'txn_id_no']);

            return $table->make(true);
        }

        $transactions = Transaction::get();
        $teams        = Team::get();

        return view('admin.ipns.index', compact('transactions', 'teams'));
    }

    public function show(Ipn $ipn)
    {
        abort_if(Gate::denies('ipn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ipn->load('txn_id_no', 'team');

        return view('admin.ipns.show', compact('ipn'));
    }
}
