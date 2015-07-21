<?php
$uploadConfig = [
        'displayMode' => 'image-single',
        'imageHeight' => 150,
        'imageWidth' => 150,
        'singleFile' => false,
        'fileList' => json_encode([]),
        'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
        'uniqueId' => 'User-Avatar'
]
?>
<style>
    .redactor-toolbar {
        z-index: 9;
    }
</style>

@extends('user.layout')

@section('content')

<div class="form-errors margin-bottom-10">
    @include('layout.flash')
</div>
{!! app('form')->model($user, ['action' => 'UserController@update', 'class' => 'ui form', 'files' => true, 'id' => 'edit-profile-form']) !!}
<div class="tabbable">

    <div class="ui top attached tabular menu">
        <a class="active item" data-tab="info" href="#tab-info">
            <i class="pencil square icon"></i>
            Basic Info
        </a>

        <a class="item" data-tab="password" href="#tab-password">
            <i class="key icon"></i>
            Password
        </a>

        <a class="item" data-tab="settings" href="#tab-settings">
            <i class="cog icon"></i>
            Settings
        </a>
    </div>
    <div class="ui active bottom attached tab segment" data-tab="info" id="tab-info">
        <div class="ui stackable grid">
            <div class="six wide center aligned tablet column">
                <div class="field ui center aligned basic segment">
                    @include('partials.fileupload.image_single', $uploadConfig)
                </div>
            </div>
            <div class="ten wide tablet column">
                <div class="inline field">
                    <label class="" for="form-field-username">Username</label>
                    <input class="" name="username" type="text" id="form-field-username" placeholder="Username"
                           value="{{ old('username', $user->username) }}"/>
                </div>
                <div class="field">
                    <label for="form-field-username">Email</label>

                    <div class="ui left icon input">
                        <i class="left mail icon"></i>
                        <input type="text" name="email" id="form-field-email" placeholder="Email"
                               value="{{ old('email', $user->email) }}"/>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label for="form-field-first">First Name</label>
                        <input name="first_name" type="text" id="form-field-first" placeholder="First Name"
                               value="{{ old('first_name', $user->first_name) }}"/>
                    </div>
                    <div class="field">
                        <label for="form-field-last">Last Name</label>
                        <input name="last_name" type="text" id="form-field-last" placeholder="Last Name"
                               value="{{ old('last_name', $user->last_name) }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui simple divider"></div>

        <div class="two fields">
            <div class="field">
                <label class="">Gender</label>
                {!!
                    app('form')
                    ->select('genre',
                        ['male' => 'Male', 'female' => 'Female'],
                        old('genre'),
                        ['class' => 'ui selection dropdown'])
                !!}
            </div>

            <div class="field">
                <label class="" for="form-field-birth-date">Birth Date</label>
                <input class="input-medium date-picker" name="birth_date"
                       value="{{ old('birth_date', $user->birth_date) }}" id="form-field-birth-date" type="text"
                       data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"/>
            </div>
        </div>

        <div class="field">
            <label for="form-field-user-bio">About me</label>
            <textarea id="form-field-user-bio" name="bio">{!! old('bio', $user->bio) !!}</textarea>
        </div>

        <div class="ui simple divider"></div>

        <div class="field">
            <label for="form-field-facebook">Facebook</label>

            <div class="ui left icon input">
                <i class="blue facebook icon"></i>
                <input type="text" name="facebook" value="{{ old('facebook', $user->facebook) }}"
                       id="form-field-facebook"/>
            </div>
        </div>

        <div class="field">
            <label for="form-field-twitter">Twitter</label>

            <div class="ui left icon input">
                <input type="text" name="twitter" value="{{ old('twitter', $user->twitter) }}" id="form-field-twitter"/>
                <i class="light-blue twitter icon"></i>
            </div>
        </div>

        <div class="field">
            <label for="form-field-gplus">Google+</label>

            <div class="ui left icon input">
                <i class="red left google plus icon"></i>
                <input type="text" name="google_plus" value="{{ old('google_plus', $user->google_plus) }}"
                       id="form-field-gplus"/>
            </div>
        </div>
    </div>
    <div class="ui bottom attached tab segment" data-tab="password" id="tab-password">
        <div class="field">
            <label for="form-field-pass1">New Password</label>
            <input name="password" type="password" id="form-field-pass1"/>
        </div>

        <div class="field">
            <label for="form-field-pass2">Confirm Password</label>
            <input name="password_confirmation" type="password" id="form-field-pass2"/>
        </div>
    </div>
    <div class="ui bottom attached tab segment" data-tab="settings" id="tab-settings">
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" id="form-field-user-privacy" name="settings[private_profile]" title="Hide your identity"/>
                <label> Hide your identity</label>
            </div>
        </div>

        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" id="form-field-setup-email-updates" name="settings[email_updates]" title=""/>
                <label> Email me new updates</label>
            </div>
        </div>

        <div class="two fields">
            <div class="seven wide field">
                <div class="ui read-only checkbox">
                    <input
                            type="checkbox"
                            checked="checked"
                            title="" />
                    <label>Keep a history of my conversations</label>
                </div>
                <div class="ui pointing info label">
                    <i>Conversations are kept for a limited time</i>
                </div>
            </div>
            <div class="five wide field">
                <label for="form-field-setup-conversations-limit">Number of Days</label>

                <div class="ui right labeled left icon input">
                    <i class="tags icon"></i>
                    <input name="settings[conversation_limit]" id="form-field-setup-conversations-limit"
                           value="{{ old('settings[limit]', 30) }}" type="text" maxlength="3"/>
                    <span class="ui tag label">
                        days
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="center aligned ui segment form-actions">
    <div class="field">
        <button class="submit uk-button uk-button-primary" type="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Save
        </button>
        &nbsp; &nbsp;
        <button class="reset uk-button" type="reset">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Reset
        </button>
    </div>
</div>
{!! app('form')->close() !!}


<script>
    jQuery(function ($) {
        $('#form-field-user-bio').redactor();
    })
</script>

@stop


