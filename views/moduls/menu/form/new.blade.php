<form class="uk-form" action="{{$url_controller}}/getdata/{{$id}}?_token={{csrf_token()}}" method="POST" data-x-form>
    <fieldset>
        <legend>Пользователь</legend>
        
        <div class="uk-form-row">
            <input type="text" placeholder="Загаловок" name="title">
        </div>
        
        <div class="uk-form-row">
            <input type="text" placeholder="URL" name="url">
        </div>
        
        <div class="uk-form-row">
            <input type="text" placeholder="ID страници" name="page_id" >
        </div>
        
        <div class="uk-form-row">
            <input type="checkbox" name="active" id="form-input-active" value="1">
            <label for="form-input-active">Активный</label>
        </div>
        
        

        <div class="uk-form-row">
            <input class="uk-button uk-button-success" type="submit" placeholder="" value="сохранить">
        </div>
    </fieldset>
</form>

<script>
    yepnope.injectJs('/bower_components/juk/juk-form.js',function(){
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('form').jukForm({
                start_load: false,
                submit_url: '{{$url_controller}}/update?_token={{csrf_token()}}',
                event_update_success: function() {
                    var modal = UIkit.modal("#x-model");
                    modal.hide();
                    juk.event.reload_table.action();
                    return true;
                },
                event_run_ajax: function() {
                    $('form').jukLoader('set');
                },
                event_complete_ajax: function() {
                    $('form').jukLoader('remove');
                }
            })
        });;
    });
</script>