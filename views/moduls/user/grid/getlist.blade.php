@foreach ($rows as $val)
<tr>
    <td>{{$val->id}}</td>
    <td>{{$val->name}}</td>
    <td>{{$val->email}}</td>
    <td>
        @if ($val->active)
            <i class="uk-icon-check"></i>
        @endif    
    </td>
    <td style="text-align: right;">
        <button class="uk-button uk-button-large uk-button-primary" data-x-model="{{$url_controller}}/edit/{{$val->id}}"><i class="uk-icon-pencil"></i></button>
        <button class="uk-button uk-button-large uk-button-danger" onclick="
                            UIkit.modal('#x-row-remove-conform').show();
                            $('#x-row-remove-conform .x-id').html({{$val->id}})"><i class="uk-icon-trash"></i></button>
    </td>
</tr>
@endforeach