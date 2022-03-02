<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSettlementRequest;
use App\Http\Requests\UpdateSettlementRequest;
use App\Models\Company;
use App\Models\Settlement;
use App\Models\Team;
use App\Models\Transaction;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SettlementController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('settlement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Settlement::with(['company', 'transactions', 'team'])->select(sprintf('%s.*', (new Settlement())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'settlement_show';
                $editGate = 'settlement_edit';
                $deleteGate = 'settlement_delete';
                $crudRoutePart = 'settlements';

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
            $table->addColumn('company_shortname', function ($row) {
                return $row->company ? $row->company->shortname : '';
            });

            $table->editColumn('transaction', function ($row) {
                $labels = [];
                foreach ($row->transactions as $transaction) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $transaction->merchant_trnx_id_no);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('total_pabl_amount', function ($row) {
                return $row->total_pabl_amount ? $row->total_pabl_amount : '';
            });
            $table->editColumn('total_paid_amount', function ($row) {
                return $row->total_paid_amount ? $row->total_paid_amount : '';
            });
            $table->editColumn('paid_by', function ($row) {
                return $row->paid_by ? $row->paid_by : '';
            });
            $table->editColumn('payment_medium', function ($row) {
                return $row->payment_medium ? $row->payment_medium : '';
            });
            $table->editColumn('payment_ref', function ($row) {
                return $row->payment_ref ? $row->payment_ref : '';
            });
            $table->editColumn('attachments', function ($row) {
                if (!$row->attachments) {
                    return '';
                }
                $links = [];
                foreach ($row->attachments as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Settlement::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company', 'transaction', 'attachments']);

            return $table->make(true);
        }

        $companies    = Company::get();
        $transactions = Transaction::get();
        $teams        = Team::get();

        return view('admin.settlements.index', compact('companies', 'transactions', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('settlement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('shortname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactions = Transaction::pluck('merchant_trnx_id_no', 'id');

        return view('admin.settlements.create', compact('companies', 'transactions'));
    }

    public function store(StoreSettlementRequest $request)
    {
        $settlement = Settlement::create($request->all());
        $settlement->transactions()->sync($request->input('transactions', []));
        foreach ($request->input('attachments', []) as $file) {
            $settlement->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachments');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $settlement->id]);
        }

        return redirect()->route('admin.settlements.index');
    }

    public function edit(Settlement $settlement)
    {
        abort_if(Gate::denies('settlement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('shortname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactions = Transaction::pluck('merchant_trnx_id_no', 'id');

        $settlement->load('company', 'transactions', 'team');

        return view('admin.settlements.edit', compact('companies', 'settlement', 'transactions'));
    }

    public function update(UpdateSettlementRequest $request, Settlement $settlement)
    {
        $settlement->update($request->all());
        $settlement->transactions()->sync($request->input('transactions', []));
        if (count($settlement->attachments) > 0) {
            foreach ($settlement->attachments as $media) {
                if (!in_array($media->file_name, $request->input('attachments', []))) {
                    $media->delete();
                }
            }
        }
        $media = $settlement->attachments->pluck('file_name')->toArray();
        foreach ($request->input('attachments', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $settlement->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachments');
            }
        }

        return redirect()->route('admin.settlements.index');
    }

    public function show(Settlement $settlement)
    {
        abort_if(Gate::denies('settlement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settlement->load('company', 'transactions', 'team');

        return view('admin.settlements.show', compact('settlement'));
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('settlement_create') && Gate::denies('settlement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Settlement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
