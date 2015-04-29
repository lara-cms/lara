@extends('lara::layouts.grid')

@section('thead')
    <th>Имя файла</th>
    <th>Первью</th>
    <th style="text-align: right;">Упровление</th>
@stop

@section('tbody')
    <td>[[name]]</td>
    <td>[[image]]</td>
    <td style="text-align: right;">
        <a class="uk-button uk-button-large uk-button-primary" href="{{$url_controller}}/edit/[[id]]"><i class="uk-icon-pencil"></i></a>
        <button class="uk-button uk-button-large uk-button-danger" onclick='
                UIkit.modal("#x-row-remove-conform").show();
                remove_file([[id]]);'><i class="uk-icon-trash"></i>
        </button>
    </td>
@stop

@section('fields')
<script>
    var remove_file_var = {};

    function remove_file(val) {
        $('#x-row-remove-conform .x-id').val(remove_file_var[val]);
        $('#x-row-remove-conform .name').html(remove_file_var[val]);
    }
    
    var fields = {
        id: function(val){
            remove_file_var[val.id] = val.name;
            return val.id;
        },name: function(val){
            return val.name;
        },
        image: function(val){
            return '<img src="/'+val.url+'" style="height: 80px;">'
        }
    }
</script>    
@stop


@section('modal')
<div id="x-row-remove-conform" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <h2>Подтвердите удаление</h2>
        <p class="name"></p>
        <textarea style="display:none" class="x-id"></textarea>
        <div class="uk-modal-footer">
            <button class="uk-button uk-button-primary" onclick="
                     jQuery.ajax({
                        type: 'POST',
                        url: '{{$url_controller}}/remove?_token={{csrf_token()}}',
                        data: {name:$('#x-row-remove-conform .x-id').val()},
                        dataType: 'json',
                        success : function(){
                            UIkit.modal('#x-row-remove-conform').hide();
                            $('#table').jukTable('reload');
                        }
                    });
                    ">Удалить</button>
            <button class="uk-button uk-button-danger" onclick="UIkit.modal('#x-row-remove-conform').hide()">Отменить</button>
        </div>
    </div>
</div>
@show