<!-- Table starts here -->
<table id="table" class="ui compact sortable table">
    <thead>
    <tr>
        <th></th>
        <th>Title</th>
        <th>Published</th>
        <th>Created</th>
    </tr>
    </thead>
    <tbody>
    @forelse($articles as $post)
        <tr>
            <td data-title="Action" class="collapsing">
                <a href="{{ action('Admin\ArticlesController@edit', $post->id) }}" class="ui tiny icon primary button">
                    <i class="edit icon"></i><span class="visible-xs-inline padding-left-5">Edit</span>
                </a>
            </td>
            <td data-title="Title">{{ ucfirst($post->title) }}</td>
            <td data-title="Published">{{ $post->published }}</td>
            <td data-title="Created">{{ $post->created_at->format('F j, Y g:i:s a') }}</td>
        </tr>
    @empty
        <tr class="no-data">
            <td colspan="4">
                No Articles
            </td>
        </tr>
    @endforelse
    </tbody>
</table>