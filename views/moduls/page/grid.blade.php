@extends('lara::layouts.grid')

@section('thead')
    <th>ID</th>
    <th>Загаловок</th>
    <th>URL</th>
    <th>Шаблон</th>
    <th>Активен</th>
    <th style="text-align: right;">Упровление</th>
@stop

@section('tbody')
    <td>[[id]]</td>
    <td>[[title]]</td>
    <td>[[url]]</td>
    <td>[[template]]</td>
    <td>[[active]]</td>
    <td style="text-align: right;">
        [[link]]
        <a class="uk-button uk-button-large uk-button-primary" href="{{$url_controller}}/edit/[[id]]"><i class="uk-icon-pencil"></i></a>
        <button class="uk-button uk-button-large uk-button-danger" onclick="
                UIkit.modal('#x-row-remove-conform').show();
                $('#x-row-remove-conform .x-id').html([[id]])"><i class="uk-icon-trash"></i>
        </button>
    </td>
@stop

@section('fields')
<script>
    var fields = {
        id: function(val){
            return val.id;
        },
        title:function (val){
            return val.title;
        },
        url:function (val){
            return val.url;
        },
        template:function (val){
            return val.template;
        },
        active:function (val){
            if (val.active){
                return '<i class="uk-icon-check"></i>';
            }    
        },
        link: function(val) {
            if (val.menu === null || val.menu === undefined) return '';
            if (val.menu.page_id == val.id){
                return '<i style="margin-right: 15px;" class="uk-icon-link"></i>'
            }else{
                return '<i style="margin-right: 15px;" class="uk-icon-unlink"></i>';
            }  
        }
    }
</script>    
@stop
