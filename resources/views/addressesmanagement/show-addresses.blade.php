@extends('layouts.app')

@section('template_title')
    {!! trans('addressesmanagement.showing-all-addresses') !!}
@endsection

@section('template_linked_css')
    @if(config('addressesmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('addressesmanagement.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .addresses-table {
            border: 0;
        }
        .addresses-table tr td:first-child {
            padding-left: 15px;
        }
        .addresses-table tr td:last-child {
            padding-right: 15px;
        }
        .addresses-table.table-responsive,
        .addresses-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {!! trans('addressesmanagement.showing-all-addresses') !!}
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('addressesmanagement.addresses-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    {{--<a class="dropdown-item" href="{{ url('/addresses/create') }}">--}}
                                        {{--<i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>--}}
                                        {{--{!! trans('addressesmanagement.buttons.create-new') !!}--}}
                                    {{--</a>--}}
                                    <a class="dropdown-item" href="{{ url('/addresses/deleted') }}">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        {!! trans('addressesmanagement.show-deleted-addresses') !!}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(config('addressesmanagement.enableSearchAddresses'))
                            @include('partials.search-addresses-form')
                        @endif

                        <div class="table-responsive addresses-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="address_count">
                                    {{ trans_choice('addressesmanagement.addresses-table.caption', 1, ['addressescount' => $addresses->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('addressesmanagement.addresses-table.id') !!}</th>
                                        <th>{!! trans('addressesmanagement.addresses-table.full') !!}</th>
                                        <th class="hidden-xs">{!! trans('addressesmanagement.addresses-table.w3w') !!}</th>
                                        <th class="hidden-xs">{!! trans('addressesmanagement.addresses-table.lat') !!}</th>
                                        <th class="hidden-xs">{!! trans('addressesmanagement.addresses-table.long') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('addressesmanagement.addresses-table.created') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('addressesmanagement.addresses-table.updated') !!}</th>
                                        <th>{!! trans('addressesmanagement.addresses-table.actions') !!}</th>
                                        <th class="no-search no-sort"></th>
                                        <th class="no-search no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="addresses_table">
                                    @foreach($addresses as $address)
                                        <tr>
                                            <td>{{$address->id}}</td>
                                            <td>{{$address->full}}</td>
                                            <td class="hidden-xs">{{$address->w3w}}</td>
                                            <td class="hidden-xs">{{$address->lat}}</td>
                                            <td class="hidden-xs">{{$address->long}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$address->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$address->updated_at}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('addresses/' . $address->id) }}" data-toggle="tooltip" title="Show">
                                                    {!! trans('addressesmanagement.buttons.show') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('addresses/' . $address->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                    {!! trans('addressesmanagement.buttons.edit') !!}
                                                </a>
                                            </td>
                                            <td>
                                                {!! Form::open(array('url' => 'addresses/' . $address->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button(trans('addressesmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Address', 'data-message' => 'Are you sure you want to delete this address?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('addressesmanagement.enableSearchAddresses'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('addressesmanagement.enablePagination'))
                                {{ $addresses->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($addresses) > config('addressesmanagement.datatablesJsStartCount')) && config('addressesmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('addressesmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('addressesmanagement.enableSearchAddresses'))
        @include('scripts.search-addresses')
    @endif
@endsection
