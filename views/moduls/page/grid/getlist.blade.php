@foreach ($rows as $val)
<tr>
    <td>{{$val->id}}</td>
    <td>{{$val->title}}</td>
    <td>{{$val->url}}</td>
    <td>{{$val->templateName()}}</td>
    <td>
        @if ($val->active)
            <i class="uk-icon-check"></i>
        @endif    
    </td>
    <td style="text-align: right;">
        
        @if ($val->menu)
            @if ($val->menu->page_id == $val->id) 
            <i style="margin-right: 15px;" class="uk-icon-link"></i>
            @else
            <i style="margin-right: 15px;" class="uk-icon-unlink"></i>
            @endif
        @endif
        
        <a class="uk-button uk-button-large uk-button-primary" href="{{$url_controller}}/edit/{{$val->id}}"><i class="uk-icon-pencil"></i></a>
        <button class="uk-button uk-button-large uk-button-danger" onclick="
                            UIkit.modal('#x-row-remove-conform').show();
                            $('#x-row-remove-conform .x-id').html({{$val->id}})"><i class="uk-icon-trash"></i></button>
    </td>
</tr>
@endforeach