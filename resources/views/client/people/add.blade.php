<div class="ui centered container grid">
    <div class="column" style="max-width: 400px;">
        <div class="ui top attached header">
            <i class="user add icon"></i> Add New Counselor
        </div>
        <div class="attached ui segment">
            {!! Theme::partial('flash') !!}
            {!! app('form')->open(['class' => 'ui form']) !!}
            <div class="required field">
                {!! app('form')->label('name') !!}
                {!! app('form')->text('name', old('name')) !!}
            </div>
            <div class="required field">
                {!! app('form')->label('email') !!}
                {!! app('form')->email('email', old('email')) !!}
            </div>
            <div class="text-align-center">
                <button type="submit" class="ui submit sucess button">Submit</button>
            </div>
            {!! app('form')->close() !!}
        </div>
        <div class="bottom attached ui message">
            A confirmation email will be sent for further signup process
        </div>
    </div>
</div>
