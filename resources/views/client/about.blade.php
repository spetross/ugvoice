@extends('client.layout')

@section('content')
    <div class="uk-margin-top">
        <h3 class="ui top attached header">About</h3>
        <div class="bottom attached ui basic segment padding-5">

            <div class="ui fluid card">
                <div class="content">
                    <div class="header">Short Info</div>
                    <div class="description">{{ $client->description }}</div>
                </div>
                <a href="{{ $client->website }}" class="ui bottom attached button">
                    <i class="globe icon"></i>
                    Visit Webiste
                </a>
            </div>

            <div class="ui purple tall stacked segment no-margin margin-top-10">
                <dl class="contacts uk-description-list-horizontal">
                    <dt>Tel</dt>
                    <dd><i class="square phone icon"></i> {{ $client->phone }} </dd>
                    <dt>Email</dt>
                    <dd><i class="square envelope icon"></i> {{ $client->email }} </dd>
                </dl>

                <a href="{{ $client->facebook }}" class="ui social facebook icon button">
                    <i class="facebook icon"></i>
                </a>
                <a href="{{ $client->twitter }}" class="ui social twitter icon button">
                    <i class="twitter icon"></i>
                </a>
                <a href="{{ $client->google }}" class="ui social google plus icon button">
                    <i class="google plus icon"></i>
                </a>
            </div>

            <div class="margin-top-10">
                <h3 class="ui top attached header">Address</h3>

                <div class="ui bottom attached segment no-margin">
                    {{$client->address}}
                </div>
            </div>

            <div class="margin-top-10">
                <h3 class="ui header">
                    <i class="alternate envelope icon"></i>

                    <div class="content">
                        Contact
                        <div class="sub header">Contact us directly</div>
                    </div>
                </h3>
                <div id="contacts">
                    <form autocomplete="off" role="form" class="ui form {{ $errors->count() >= 1 ? 'error' : '' }}"
                          method="post">
                        <div class="ui error message">
                            <div class="header">We had some issues</div>
                            <ul class="list">
                                @foreach($errors->all('<li>:message</li>') as $message)
                                    {!! $message !!}
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_handler" value="onContact">

                        <div class="field">
                            <label for="inputEmail">Email address</label>
                            <input type="text" name="email" id="inputEmail"
                                   value="{{old('email', Auth::check() ? Auth::user()->email : null)}}"
                                   placeholder="Enter Your Email">
                        </div>
                        <div class="field">
                            <label for="inputName">Name</label>
                            <input type="text" value="{{old('name', Auth::check() ? ucwords(Auth::user()->name) : null)}}"
                                   name="name" id="inputName" placeholder="Your Name">
                        </div>
                        <div class="field">
                    <textarea name="message" id="inputMessage" placeholder="Your message here"
                              rows="10">{{old('message')}}</textarea>
                        </div>
                        <div class="field">
                            <div class="padding-left-30 padding-right-30">
                                <button type="submit" class="ui large fluid positive icon labeled button"><i
                                            class="forward mail icon"></i>Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

