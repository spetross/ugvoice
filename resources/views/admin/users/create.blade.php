@section('content')
    <div class="full-container">
        @include('layout.flash')
        <form class="ui form" method="post" action="{{ action('Admin\UsersController@store') }}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="two fields">
                <div class="required field">
                    <label>First name</label>
                    <input placeholder="First Name" name="first_name" value="{{ old('first_name') }}" type="text">
                </div>
                <div class="required field">
                    <label>Last name</label>
                    <input placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" type="text">
                </div>
            </div>
            <div class="required field">
                <label>Email</label>
                <input placeholder="Email Address" name="email" value="{{ old('email') }}" type="email">
            </div>
            <div class="field">
                <label>Assign Role</label>
                <select placeholder="Select group" class="ui search dropdown" name="groups[]" multiple="">
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ $group->is_new_user_default ? 'selected' : null }}>{{ ucfirst($group->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="ui grid">
                <div class="centered row">
                    <div class="column">
                        <button class="icon ui button"><i class="icon check"></i>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
