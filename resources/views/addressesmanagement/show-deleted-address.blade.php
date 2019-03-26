@extends('layouts.app')

@section('template_title')
  Showing Deleted Address {{ $address->w3w }}
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">

        <div class="card">

          <div class="card-header bg-danger text-white">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              {!! trans('addressesmanagement.addressesDeletedPanelTitle') !!}
              <div class="float-right">
                <a href="{{ url('/addresses/deleted/') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('addressesmanagement.addressesBackDelBtn') }}">
                  <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                  <span class="sr-only">
                    {!! trans('addressesmanagement.addressesBackDelBtn') !!}
                  </span>
                </a>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-sm-4 col-md-6">
              <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                {{ $address->w3w }}
              </h4>
              <p class="text-center text-left-tablet">
                <strong>
                  {{ $address->full }} {{ $address->last_name }}
                </strong>
                @if($address->lat && $address->long)
                  <br />
                  <span class="text-center" data-toggle="tooltip" data-placement="top" title="{{ trans('addressesmanagement.tooltips.latlong-address', ['lat' => $address->lat, 'long' => $address->long]) }}">
                      {{ $address->lat }} {{ $address->long }}
                    </span>
                @endif
              </p>

              <div class="text-center text-left-tablet mb-4">
                {!! Form::model($address, array('action' => array('AddressSoftDeletesController@update', $address->id), 'method' => 'PUT', 'class' => 'form-inline')) !!}
                {!! Form::button('<i class="fa fa-refresh fa-fw" aria-hidden="true"></i> Restore Address', array('class' => 'btn btn-success btn-block btn-sm mt-1 mb-1', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore Address')) !!}
                {!! Form::close() !!}

                {!! Form::model($address, array('action' => array('AddressSoftDeletesController@destroy', $address->id), 'method' => 'DELETE', 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'title' => 'Permanently Delete Address')) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('<i class="fa fa-user-times fa-fw" aria-hidden="true"></i> Delete Address', array('class' => 'btn btn-danger btn-sm ','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Permanently Delete Address', 'data-message' => 'Are you sure you want to permanently delete this address?')) !!}
                {!! Form::close() !!}

              </div>

            </div>
          </div>

          <div class="clearfix"></div>
          <div class="border-bottom"></div>
          @if ($address->deleted_at)
            <div class="col-sm-5 col-xs-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelDeletedAt') }}
              </strong>
            </div>

            <div class="col-sm-7 text-warning">
              {{ $address->deleted_at }}
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

          @endif

          @if ($address->house)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelHouse') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->house }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->street)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelStreet') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->street }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->quarter)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelQuarter') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->quarter }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->city)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelCity') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->city }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->region)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelRegion') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->region }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->country)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelCountry') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->country }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->description)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelDescription') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->description }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          <div class="col-sm-5 col-6 text-larger">
            <strong>
              {{ trans('addressesmanagement.labelStatus') }}
            </strong>
          </div>
          <div class="col-sm-7">
            @if ($address->activated == 1)
              <span class="badge badge-success">
                    Activated
                  </span>
            @else
              <span class="badge badge-danger">
                    Not-Activated
                  </span>
            @endif
          </div>
          <div class="clearfix"></div>
          <div class="border-bottom"></div>

          @if ($address->created_at)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelCreatedAt') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->created_at }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

          @if ($address->updated_at)
            <div class="col-sm-5 col-6 text-larger">
              <strong>
                {{ trans('addressesmanagement.labelUpdatedAt') }}
              </strong>
            </div>
            <div class="col-sm-7">
              {{ $address->updated_at }}
            </div>
            <div class="clearfix"></div>
            <div class="border-bottom"></div>
          @endif

        </div>

      </div>
    </div>
  </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.tooltips')

@endsection
