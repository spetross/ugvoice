@section('content')
    <div class="table-responsive-vertical">
        <!-- Table starts here -->
        <table id="table" class="ui compact sortable definition table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Created</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr>
                    <td data-title="ID" class="collapsing">{{ $group->id }}</td>
                    <td data-title="Name">{{ $group->name }}</td>
                    <td data-title="Created">{{ $group->created_at->format('F j, Y g:i:s a') }}</td>
                    <td data-title="Action" class="collapsing">
                        <a href="{{ action('Admin\GroupsController@edit', $group->id) }}"
                           class="ui tiny icon primary button">
                            <i class="edit icon"></i><span class="visible-xs-inline padding-left-5">Edit</span>
                        </a>
                        <a class="ui tiny icon red button">
                            <i class="remove icon"></i><span class="visible-xs-inline padding-left-5">Delete</span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot class="full-width">
            <tr>
                <th colspan="4">
                    <a href="{{ action('Admin\GroupsController@create') }}"
                       class="ui right floated small primary icon button">
                        <i class="plus icon"></i> Add Group
                    </a>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
@stop

