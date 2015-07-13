@section('content')
    <div class="table-responsive-vertical">
        <!-- Table starts here -->
        <table id="table" class="ui compact sortable definition table">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Contact</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @forelse($organisations as $organisation)
                <tr>
                    <td data-title="Action" class="collapsing">
                        <a href="{{ action('Admin\OrganisationsController@show', $organisation->id) }}"
                           class="ui tiny icon blue button">
                            <i class="eye icon"></i><span class="visible-xs-inline padding-left-5">Show</span>
                        </a>
                        <a class="ui tiny icon green button"
                           href="{{ action('Admin\OrganisationsController@edit', $organisation->id) }}">
                            <i class="edit icon"></i><span class="visible-xs-inline padding-left-5">Edit</span>
                        </a>
                    </td>
                    <td data-title="Name">{{ ucwords($organisation->name) }}</td>
                    <td data-title="Contact">{{ $organisation->email }}</td>
                    <td data-title="Created">{{ $organisation->created_at->format('F j, Y') }}</td>
                </tr>
            @empty
                <tr class="no-data">
                    <td colspan="4">
                        No Organisations
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@stop

