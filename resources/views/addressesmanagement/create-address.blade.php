@extends('layouts.app')

@section('template_title')
    {!! trans('addressesmanagement.create-new-address') !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! trans('addressesmanagement.create-new-address') !!}
                            <div class="pull-right">
                                <a href="{{ route('addresses') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('addressesmanagement.tooltips.back-addresses') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! trans('addressesmanagement.buttons.back-to-addresses') !!}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'addresses.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('house') ? ' has-error ' : '' }}">
                                {!! Form::label('house', trans('forms.create_address_label_house'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('house', NULL, array('id' => 'house', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_house'))) !!}
                                        <div class="input-group-append">
                                            <label for="house" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_house') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('house'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('house') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('street') ? ' has-error ' : '' }}">
                                {!! Form::label('street', trans('forms.create_address_label_street'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('street', NULL, array('id' => 'street', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_street'))) !!}
                                        <div class="input-group-append">
                                            <label for="street" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_street') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('quarter') ? ' has-error ' : '' }}">
                                {!! Form::label('quarter', trans('forms.create_address_label_quarter'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('quarter', NULL, array('id' => 'quarter', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_quarter'))) !!}
                                        <div class="input-group-append">
                                            <label for="quarter" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_quarter') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('quarter'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quarter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('city') ? ' has-error ' : '' }}">
                                {!! Form::label('city', trans('forms.create_address_label_city'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('city', NULL, array('id' => 'city', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_city'))) !!}
                                        <div class="input-group-append">
                                            <label for="city" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_city') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('region') ? ' has-error ' : '' }}">
                                {!! Form::label('region', trans('forms.create_address_label_region'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('region', NULL, array('id' => 'region', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_region'))) !!}
                                        <div class="input-group-append">
                                            <label for="region" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_region') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('region'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('region') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('country') ? ' has-error ' : '' }}">
                                {!! Form::label('country', trans('forms.create_address_label_country'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('country', NULL, array('id' => 'country', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_country'))) !!}
                                        <div class="input-group-append">
                                            <label for="country" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_country') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                                {!! Form::label('description', trans('forms.create_address_label_description'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('description', NULL, array('id' => 'description', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_description'))) !!}
                                        <div class="input-group-append">
                                            <label for="description" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_description') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('lat') ? ' has-error ' : '' }}">
                                {!! Form::label('lat', trans('forms.create_address_label_lat'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('lat', NULL, array('id' => 'lat', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_lat'))) !!}
                                        <div class="input-group-append">
                                            <label for="lat" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_lat') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('lat'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group has-feedback row {{ $errors->has('long') ? ' has-error ' : '' }}">
                                {!! Form::label('long', trans('forms.create_address_label_long'), array('class' => 'col-md-3 control-label')) !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('long', NULL, array('id' => 'long', 'class' => 'form-control', 'placeholder' => trans('forms.create_address_ph_long'))) !!}
                                        <div class="input-group-append">
                                            <label for="long" class="input-group-text">
                                                <i class="fa fa-fw {{ trans('forms.create_address_icon_long') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('long'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('long') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {!! Form::button(trans('forms.create_address_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
