@extends('lara::layouts.master')


@section('content')
    <div id="content-inner">
    
    </div>
@stop


@section('right_panel')
    

    <p>Этот элемент будет добавлен к главному сайдбару.</p>
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