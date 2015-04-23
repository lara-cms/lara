@foreach ($rows as $val)
<tr>
    <td>{{$val->id}}</td>
    <td>{{$val->makeTitle()}}</td>
    <td>{{$val->makeUrl()}}</td>
    <td>
        @if ($val->active)
            <i class="uk-icon-check"></i>
        @endif    
    </td>
    <td style="text-align: right;">
        <script>
            table.parent_up = <?php echo ($val->parent and ($val->parent->parent_id)) ? $val->parent->parent_id : 0 ; ?>;
        </script>

        @if ($val->page and ($val->id == $val->page->menu_id))
        <a href="/lara/page/edit/{{$val->page->id}}" class="uk-button uk-button-large"><i class="uk-icon-link"></i></a>
        
        @elseif ($val->page)
        <a href="/lara/page/edit/{{$val->page->id}}" class="uk-button uk-button-large"><i class="uk-icon-unlink"></i></a>
        @endif 
        

        <button class="uk-button uk-button-large" data-table-parent="{{$val->id}}"><i class="uk-icon-<?php echo (sizeof($val->childs)) ? 'folder' : 'file-o' ;?>"></i></button>
        <button class="uk-button uk-button-large uk-button-primary" data-x-model="{{$url_controller}}/edit/{{$val->id}}"><i class="uk-icon-edit"></i></button>
        <button class="uk-button uk-button-large uk-button-danger" onclick="
                            UIkit.modal('#x-row-remove-conform').show();
                            $('#x-row-remove-conform .x-id').html({{$val->id}})"><i class="uk-icon-trash"></i></button>
        
        <button class="uk-button uk-button-large" onclick="table_move({{$val->id}})"><i class="uk-icon-cut "></i></button>
    </td>
</tr>
@endforeach