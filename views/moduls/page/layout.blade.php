@extends('lara::layouts.master')


@section('content')
    <div id="content-inner">
    
    </div>
@stop


@section('right_panel')
    <h2>Фильтр</h2>
    
    <form id="filter-form">
        <input type="text" name="template">
        <input type="text" name="get_parent" value="{{Input::get('get_parent','')}}">
    </form>

@stop


@section('script')
<script>
    $.ajax({
        url: '{{$url_controller}}/grid',
        success: function(data){
            $('#content-inner').html(data);
        }
    });
</script>
@stop