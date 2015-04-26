@extends('lara::layouts.grid')

@section('thead')
    <th>ID</th>
    <th>Имя</th>
    <th>Почта</th>
    <th>Активен</th>
    <th style="text-align: right;">Упровление</th>
@stop

@section('tbody')
    <td>[[id]]</td>
    <td>[[name]]</td>
    <td>[[email]]</td>
    <td>[[active]]</td>
    <td style="text-align: right;">
        <button class="uk-button uk-button-large uk-button-primary" data-x-model="{{$url_controller}}/edit/[[id]]"><i class="uk-icon-pencil"></i></button>
        <button class="uk-button uk-button-large uk-button-danger" onclick="
                            UIkit.modal('#x-row-remove-conform').show();
                            $('#x-row-remove-conform .x-id').html([[id]])"><i class="uk-icon-trash"></i></button>
    </td>

@stop

@section('fields')
<script>
    var fields = {
        id: function(val){
            return val.id;
        },
        name:function (val){
            return val.name;
        },
        email:function (val){
            return val.email;
        },
        active:function (val){
            if (val.active){
                return '<i class="uk-icon-check"></i>';
            }    
        }
    }
</script>    
@stop
