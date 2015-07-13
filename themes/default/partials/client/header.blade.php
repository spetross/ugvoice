<div class="top attached ui center aligned header">
    {{ ucwords($client->name) }}
</div>
<div class="attached ui center aligned segment no-padding">
    <img src="/assets/img/placeholder.svg" class="ui centered image">
</div>

{{--
@section('header.bottom')
    <div class="center aligned ui top attached header">
        About us
    </div>
    <div class="ui bottom attached segment">
        {{ str_limit($client->description, 200) }}
    </div>
@show

--}}
