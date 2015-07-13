<?php
$uploadConfig = array(
        'displayMode' => 'image-single',
        'imageHeight' => 200,
        'imageWidth' => 250,
        'singleFile' => false,
        'fileList' => json_encode([]),
        'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
        'uniqueId' => 'featured-images'
);
if ($organisation->logo) {
    $file = $organisation->logo;
    $file->thumb = $file->getThumb($uploadConfig['imageWidth'], $uploadConfig['imageHeight']);
    $uploadConfig['singleFile'] = $file;
    $uploadConfig['fileList'] = json_encode([$file]);
}
?>

@section('form.buttons')
        <!-- Save -->
<button
        class="ui basic primary submit icon button" type="submit"><i class="check icon"></i> Save
</button>
<button
        class="ui negative tiny icon organisation delete button" type="button"><i class="trash icon"></i> Delete
</button>
@stop

@section('content')
    {!! app('form')->model($organisation, ['action' => array('Admin\OrganisationsController@update', $organisation->id), 'class' => 'ui organisation form']) !!}
    @include('organisations.form')
    {!! app('form')->close() !!}
    <div class="ui tiny organisation modal" id="delete-organisation">
        <div class="header">
            Delete organisation
        </div>
        <div class="content">
            <p>Are you sure you want to delete this organisation: </p>
            <h5>{{ $organisation->name }}</h5>
        </div>
        <div class="actions">
            <div class="ui negative cancel button">
                No
            </div>
            <div class="ui positive right icon approve button">
                Yes
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.ui.organisation.modal')
                .modal({
                    onApprove: function () {
                        $(this).api({
                            url: '{{ action('Admin\OrganisationsController@destroy', $organisation->id) }}',
                            method: 'DELETE',
                            on: 'now',
                            onSuccess: function (response) {
                                window.location.href = '{{ action('Admin\OrganisationsController@index') }}'
                            }
                        })
                    }
                })
                .modal('attach events', '.ui.organisation.delete.button', 'show')
        ;
    </script>
@append