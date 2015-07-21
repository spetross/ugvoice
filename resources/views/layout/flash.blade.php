@foreach (Flash::all() as $type => $message)
    <div class="ui floating <?= $type ?> message"><i class="close icon"></i>{{ $message }}</div>
@endforeach

@if (count($errors) > 0)
    <div class="ui floating error message">
    	<i class="close icon"></i>
        <div class="header"><strong>Whoops! Something went wrong</strong></div>
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif