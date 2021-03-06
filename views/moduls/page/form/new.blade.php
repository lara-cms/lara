<form id="model-form" class="uk-form" action="{{$url_controller}}/getdata/{{$id}}?_token={{csrf_token()}}" method="POST" data-x-form>
    <fieldset>
        <legend>Страница</legend>
        
        <div class="uk-form-row">
            <input type="text" placeholder="Загаловок" name="title">
        </div>
        
        <div class="uk-form-row">
            <input type="text" placeholder="URL" name="url">
        </div>
        
        <div class="uk-form-row">
            <input type="text" placeholder="Пункт меню" name="menu_id">
        </div>
        
        <div class="uk-form-row">
            <select name="template">
                @foreach (Config('lara-cms.master.template') as $key=>$val)
                    <option value="{{$key}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="uk-form-row">
            <input type="checkbox" name="active" id="form-input-active" value="1">
            <label for="form-input-active">Активный</label>
        </div>
        
        

        <div class="uk-form-row">
            <input class="uk-button uk-button-success" type="submit" placeholder="" value="сохранить">
            
            <input type="hidden" name="id">
        </div>
    </fieldset>
</form>

<script>
    
    
    var get_parent = $('#filter-form [name=get_parent]').val();
    $('#model-form [name=menu_id]').val(get_parent);


    yepnope.injectJs('/bower_components/juk/juk-form.js',function(){
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('#model-form').jukForm({
                start_load: false,
                submit_url: '{{$url_controller}}/update?_token={{csrf_token()}}',
                event_update_success: function() {
                    var modal = UIkit.modal("#x-model");
                    modal.hide();
                    table_reload ();
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