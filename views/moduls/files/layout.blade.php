@extends('lara::layouts.master')

@section('content')
    <div id="content-inner">
    
    </div>
@stop


@section('right_panel')
@stop


@section('script')
<script>
    $.ajax({
        url: '{{$url_controller}}/{{$get_inner or 'grid'}}',
        success: function(data){
            $('#content-inner').html(data);
        }
    });
</script>
@stop