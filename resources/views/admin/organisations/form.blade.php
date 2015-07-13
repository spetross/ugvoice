<?php
$countries = [
        'Uganda' => 'Uganda',
        'Kenya' => 'Kenya',
        'Tanzania' => 'Tanzania',
        'Rwanda' => 'Rwanda'
]
?>
<div class="ui segment">
    <div class="required field{{ $errors->has('name') ? ' error' : '' }}">
        {!! app('form')->label('title', trans('forms.organisation.fields.name.label'), ['class' => 'control-label']) !!}
        {!! app('form')->text('name', old('name'), ['required' => true, 'placeholder' => trans('forms.organisation.fields.name.placeholder'), 'autocomplete' => 'off']) !!}
        {!! $errors->first('name', '<div class="ui red pointing prompt label">:message</div>') !!}
    </div>
</div>
<div class="ui two column stackable grid">
    <div class="column">
        <div class="ui segment bordered-top bordered-bottom bordered-pink">
            <div class="required field{{ $errors->has('description') ? ' error' : '' }}">
                {!! app('form')->label('description', trans('forms.organisation.fields.description.label'), ['class' => 'control-label']) !!}
                {!! app('form')->textarea('description', old('description'), ['required' => true, 'placeholder' => trans('forms.organisation.fields.description.placeholder'), 'rows' => 6, 'autocomplete' => 'off']) !!}
                {!! $errors->first('description', '<div class="ui red pointing prompt label">:message</div>') !!}
                <div class="ui black pointing prompt label">{{trans('forms.organisation.fields.description.comment')}}</div>
            </div>
            <div class="field{{ $errors->has('mission') ? ' error' : '' }}">
                {!! app('form')->label('mission', trans('forms.organisation.fields.mission.label')) !!}
                {!! app('form')->textarea('mission', old('mission'), ['placeholder' => trans('forms.organisation.fields.mission.placeholder'), 'rows' => 1, 'autocomplete' => 'off']) !!}
                {!! $errors->first('mission', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field{{ $errors->has('objectives') ? ' error' : '' }}">
                {!! app('form')->label('objectives', trans('forms.organisation.fields.objectives.label'), ['class' => 'control-label']) !!}
                {!! app('form')->textarea('objectives', old('mission'), ['placeholder' => trans('forms.organisation.fields.objectives.placeholder'), 'rows' => 2, 'autocomplete' => 'off']) !!}
                {!! $errors->first('objectives', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field">
                {!! app('form')->label('logo', trans('forms.organisation.fields.logo.label'), ['class' => 'control-label']) !!}
                <div class="field">
                    @include('partials.fileupload.image_single', $uploadConfig)
                </div>
            </div>
        </div>
        <div class="ui error message"></div>
    </div>
    <div class="column">
        @include('layout.flash')
        <div class="ui segment bordered-top bordered-danger" style="overflow:hidden">
            <div class="required field {{ $errors->has('email') ? ' error' : '' }}">
                <label><i class="uk-icon-envelope"></i>{{trans('forms.organisation.fields.email.label')}}</label>
                {!! app('form')->email('email', old('email'), ['required' => true, 'placeholder' => trans('forms.organisation.fields.email.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('email', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field {{ $errors->has('website') ? ' error' : '' }}">
                <label><i class="uk-icon-globe"></i>{{trans('forms.organisation.fields.website.label')}}</label>
                {!! app('form')->url('website', old('website'), ['placeholder' => trans('forms.organisation.fields.website.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('website', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field {{ $errors->has('country') ? ' error' : '' }}">
                <label><i class="uk-icon-phone-square"></i>{{trans('forms.organisation.fields.country.label')}}</label>
                {!! app('form')->select('country', $countries, old('country'), ['id' => 'countries', 'class' => 'ui selection dropdown', 'placeholder' => trans('forms.organisation.fields.country.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('country', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="required field {{ $errors->has('phone') ? ' error' : '' }}">
                <label><i class="uk-icon-phone-square"></i>{{trans('forms.organisation.fields.phone.label')}}</label>
                {!! app('form')->text('phone', old('phone'), ['id' => 'phone', 'placeholder' => trans('forms.organisation.fields.phone.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('phone', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field {{ $errors->has('cc-phone') ? ' error' : '' }}">
                <label><i class="uk-icon-phone-square"></i>{{trans('forms.organisation.fields.phone.label')}}</label>
                {!! app('form')->text('cc-phone', old('cc-phone'), ['id' => 'cc-phone', 'placeholder' => trans('forms.organisation.fields.phone.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('cc-phone', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="required field {{ $errors->has('address') ? ' error' : '' }}">
                <label><i class="uk-icon-map-marker"></i>{{trans('forms.organisation.fields.address.label')}}</label>
                {!! app('form')->textarea('address', old('address'), ['placeholder' => trans('forms.organisation.fields.address.placeholder'), 'rows' => 3, 'autocomplete' => 'off']) !!}
                {!! $errors->first('address', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field {{ $errors->has('facebook') ? ' error' : '' }}">
                <label><i class="uk-icon-facebook"></i>{{trans('forms.organisation.fields.facebook.label')}}</label>
                {!! app('form')->text('facebook', old('facebook'), ['placeholder' => trans('forms.organisation.fields.facebook.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('facebook', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field {{ $errors->has('twitter') ? ' error' : '' }}">
                <label><i class="uk-icon-twitter"></i>{{trans('forms.organisation.fields.twitter.label')}}</label>
                {!! app('form')->text('twitter', old('twitter'), ['placeholder' => trans('forms.organisation.fields.twitter.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('twitter', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
            <div class="field {{ $errors->has('google') ? ' error' : '' }}">
                <label><i class="uk-icon-google-plus"></i>{{trans('forms.organisation.fields.google-plus.label')}}
                </label>
                {!! app('form')->text('google', old('google'), ['placeholder' => trans('forms.organisation.fields.google-plus.placeholder'), 'autocomplete' => 'off']) !!}
                {!! $errors->first('google', '<div class="ui red pointing prompt label">:message</div>') !!}
            </div>
        </div>
    </div>
</div>

<div class="form-buttons loading-indicator-container">
    @section('form.buttons')
        <button
                type="submit"
                data-request="onSave"
                data-load-indicator="Saving..."
                data-request-before-update="$el.trigger('unchange.uk.changeMonitor')"
                data-hotkey="ctrl+s, cmd+s"
                data-stripe-load-indicator=""
                class="ui large blue submit button">
            {{ trans('forms.buttons.save') }}
        </button>
    @show
</div>
@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('vendor') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.autoellipsis.js') }}"></script>
    <script src="{{ asset('library/mustache/mustache.min.js') }}"></script>
    <script src="{{ asset('library/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendor') }}"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('.ui.organisation.form')
                    .form({
                        inline: true,
                        on: 'blur',
                        fields: {
                            name: {
                                identifier: 'name',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter organisation name'
                                    }
                                ]
                            },
                            description: {
                                identifier: 'description',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please provide a description'
                                    }
                                ]
                            },
                            website: {
                                identifier: 'website'
                            },
                            email: {
                                identifier: 'email',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please enter organisation contact e-mail'
                                    },
                                    {
                                        type: 'email',
                                        prompt: 'Please enter a valid e-mail'
                                    }
                                ]
                            },
                            ccEmail: {
                                identifier: 'cc-email',
                                optional: true,
                                rules: [
                                    {
                                        type: 'email',
                                        prompt: 'Please enter a valid e-mail'
                                    }
                                ]
                            },
                            phone: {
                                identifier: 'phone',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please provide atleast one contact number'
                                    },
                                    {
                                        type: 'integer',
                                        prompt: 'Invalid phone number'
                                    },
                                    {
                                        type: 'integer',
                                        prompt: 'Invalid phone number'
                                    },
                                    {
                                        type: 'length[9]',
                                        prompt: 'Please provide a valid phone number'
                                    },
                                    {
                                        type: 'maxLength[15]',
                                        prompt: 'Please provide a valid phone number'
                                    },
                                    {
                                        type: 'different[cc-phone]',
                                        prompt: 'Phone numbers should be different'
                                    }
                                ]
                            },
                            ccPhone: {
                                identifier: 'cc-phone',
                                optional: true,
                                rules: [
                                    {
                                        type: 'integer',
                                        prompt: 'Invalid phone number'
                                    },
                                    {
                                        type: 'length[9]',
                                        prompt: 'Please provide a valid phone number'
                                    },
                                    {
                                        type: 'maxLength[15]',
                                        prompt: 'Please provide a valid phone number'
                                    },
                                    {
                                        type: 'different[phone]',
                                        prompt: 'Phone numbers should be different'
                                    }
                                ]
                            },
                            address: {
                                identifier: 'address',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'Please provide organisation address'
                                    }
                                ]
                            }
                        }
                    })
            ;
        });
    </script>
@append
