@section('content')
    <div class="table-responsive">
        <!-- Table starts here -->
        <table id="table" class="sortable ui compact definition striped red table">
            <thead>
            <tr>
                <th></th>
                <th>Email</th>
                <th>Name</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td data-title="Action" class="collapsing">
                        <a href="{{ action('Admin\UsersController@show', $user->id) }}"
                           class="ui mini icon primary button">
                            <i class="eye medium icon"></i><span class="visible-xs-inline padding-left-5">Show</span>
                        </a>
                    </td>
                    <td data-title="Email">{{ $user->email }}</td>
                    <td data-title="Name">{{ $user->name }}</td>
                    <td data-title="Created">{{ $user->created_at->format('F j, Y g:i:s a') }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="full-width">
            <tr>
                <th colspan="4">
                    <a href="{{ action('Admin\UsersController@create') }}"
                       class="ui right floated small primary icon button">
                        <i class="user icon"></i> Add User
                    </a>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
@stop

