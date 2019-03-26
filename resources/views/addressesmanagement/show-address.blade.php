@extends('layouts.app')

@section('template_title')
  {!! trans('addressesmanagement.showing-address', ['name' => $address->w3w]) !!}
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">

        <div class="card">

          <div class="card-header text-white @if ($address->activated == 1) bg-success @else bg-danger @endif">
            <div style="display: flex; justify-content: space-between; align-items: center;">
              {!! trans('addressesmanagement.showing-address-title', ['name' => $address->w3w]) !!}
              <div class="float-right">
                <a href="{{ route('addresses') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('addressesmanagement.tooltips.back-addresses') }}">
                  <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                  {!! trans('addressesmanagement.buttons.back-to-addresses') !!}
                </a>
              </div>
            </div>
          </div>

          <div class="card-body">
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
                    <a href="{{ url('/addresses/'.$address->id.'/edit') }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ trans('addressesmanagement.editAddress') }}">
                      <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> {{ trans('addressesmanagement.editAddress') }} </span>
                    </a>
                    {!! Form::open(array('url' => 'addresses/' . $address->id, 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => trans('addressesmanagement.deleteAddress'))) !!}
                      {!! Form::hidden('_method', 'DELETE') !!}
                      {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">' . trans('addressesmanagement.deleteAddress') . '</span>' , array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Address', 'data-message' => 'Are you sure you want to delete this address?')) !!}
                    {!! Form::close() !!}
                  </div>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

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
  @if(config('usersmanagement.tooltipsEnabled'))
    @include('scripts.tooltips')
  @endif
@endsection
