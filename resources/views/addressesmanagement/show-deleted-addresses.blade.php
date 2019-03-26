@extends('layouts.app')

@section('template_title')
    Showing Deleted Addresses
@endsection

@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
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
            margin-bottom: .15em;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Showing Deleted Users
                            </span>
                            <div class="float-right">
                                <a href="{{ route('addresses') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('addressesmanagement.tooltips.back-addresses') }}">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    {!! trans('addressesmanagement.buttons.back-to-addresses') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($addresses) === 0)
                            <tr>
                                <p class="text-center margin-half">
                                    No Records Found
                                </p>
                            </tr>
                        @else
                            <div class="table-responsive users-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="address_count">
                                        {{ trans_choice('addressesmanagement.addresses-table.caption', 1, ['addressescount' => $addresses->count()]) }}
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th class="hidden-xxs">ID</th>
                                            <th>Full Address</th>
                                            <th class="hidden-xs">What3Word</th>
                                            <th class="hidden-xs">Latitude</th>
                                            <th class="hidden-xs">Longitute</th>
                                            <th class="hidden-xs hidden-sm hidden-md">Deleted</th>
                                            <th>Actions</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($addresses as $address)
                                            <tr>
                                                <td class="hidden-xxs">{{$address->id}}</td>
                                                <td>{{$address->full}}</td>
                                                <td class="hidden-xs">{{$address->w3w}}</td>
                                                <td class="hidden-xs">{{$address->lat}}</td>
                                                <td class="hidden-xs">{{$address->long}}</td>
                                                <td class="hidden-xs hidden-sm hidden-md">{{$address->deleted_at}}</td>
                                                <td>
                                                    {!! Form::model($address, array('action' => array('AddressSoftDeletesController@update', $address->id), 'method' => 'PUT', 'data-toggle' => 'tooltip')) !!}
                                                        {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-block btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore Address')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('addresses/deleted/' . $address->id) }}" data-toggle="tooltip" title="Show Address">
                                                        <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    {!! Form::model($address, array('action' => array('AddressSoftDeletesController@destroy', $address->id), 'method' => 'DELETE', 'class' => 'inline', 'data-toggle' => 'tooltip', 'title' => 'Destroy Address Record')) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button('<i class="fa fa-user-times" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm inline','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Address', 'data-message' => 'Are you sure you want to delete this address?')) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    @if (count($addresses) > 10)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection
