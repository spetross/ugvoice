@foreach (Flash::all() as $type => $message)
    <div class="ui floating <?= $type ?> message"><i class="close icon"></i>{{ $message }}</div>
@endforeach

@if (count($errors) > 0)
    <div class="ui floating error message text-left">
        <div class="header"><strong>Whoops!</strong></div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif