<form class="uk-form" action="{{$url_controller}}/getdata/{{$id}}?_token={{csrf_token()}}" method="POST" data-x-form>
    <fieldset>
        <legend>Пользователь</legend>
        
        <div class="uk-form-row">
            <label><strong>Загаловок:</strong> <?php if ($model->page) {echo $model->page->title;}?></label>
        </div>
        
        <div class="uk-form-row">
            <label><strong>URL:</strong> <?php if ($model->page) {echo $model->page->url;}?></label>
        </div>
        
        <div class="uk-form-row">
            <p>Загаловок:</p>
            <input type="text" placeholder="Загаловок" name="title" value="{{$model->title}}">
        </div>
        
        
        <div class="uk-form-row">
            <p>URL:</p>
            <input type="text" placeholder="Url" name="url" value="{{$model->url}}">
        </div>
        
        <div class="uk-form-row">
            <p>ID Страници:</p>
            <input type="text" placeholder="ID Страници" name="page_id" value="{{$model->page_id}}">
        </div>
        
        <div class="uk-form-row">
            <label for="form-input-active">Активный</label>
            <input type="checkbox" name="active" id="form-input-active" value="1" <?php if ($model->active) echo 'checked' ?>>
        </div>
        

        <div class="uk-form-row">
            <input class="uk-button uk-button-success" type="submit" placeholder="" value="сохранить">
            
            <input type="hidden" name="id" value="{{$model->id}}">
        </div>
    </fieldset>
</form>

<script>
    yepnope.injectJs('/bower_components/juk/juk-form.js',function(){
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('form').jukForm({
                start_load:false,
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