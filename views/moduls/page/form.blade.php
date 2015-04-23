{{Config('master.life_cache')}}
<form class="uk-form" action="{{$url_controller}}/getdata/{{$model->id}}?_token={{csrf_token()}}" method="POST" data-x-form>
    <div id="tabs-1">
        <fieldset>
            <legend>Страница</legend>

            <table class="uk-table uk-table-hover" style="width: 350px;">
                
                <tr>
                    <td>
                        <lable>Загаловок:</lable>
                    </td>
                    <td>
                        <input type="text" placeholder="Загаловок" name="title" value="{{$model->title}}">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <lable>URL:</lable>
                    </td>
                    <td>
                        <input type="text" placeholder="URL" name="url" value="{{$model->url}}">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <lable>Пункт меню:</lable>
                    </td>
                    <td>
                        <input type="text" placeholder="Пункт меню" name="menu_id" value="{{$model->menu_id}}">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <lable>Шаблон:</lable>
                    </td>
                    <td>
                        <select name="template" value="{{$model->template}}">
                            @foreach (Config('lara-cms.master.template') as $key=>$val)
                                @if ($key == $model->template)
                                    <option selected value="{{$key}}">{{$val}}</option>
                                @else
                                    <option value="{{$key}}">{{$val}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="form-input-active">Активный</label>
                    </td>
                    <td>
                        <input type="checkbox" name="active" id="form-input-active" value="1" <?php if ($model->active) echo 'checked' ?>>
                        
                    </td>
                </tr>

            </table>
            
            <div class="uk-form-row">
                <input class="uk-button uk-button-success" type="submit" placeholder="" value="сохранить">
                <input type="hidden" name="id" value="{{$model->id}}">
            </div>
            
            <div class="uk-form-row">
                <lable>Содержимое:</lable>
                <textarea id="content" name="content" style="display: none">{!!$model->content!!}</textarea>
            </div>
            
        </fieldset>

        
        <div id="editor" style="height: 500px;font-size: 14px;"></div>
        <script>
            yepnope.injectJs('/bower_components/ace-builds/src-min/ace.js', function () {

                var e = ace.edit('editor');
                e.setTheme("ace/theme/chrome");
                e.setValue($('#content').val());
                e.getSession().setMode("ace/mode/html");


                ace.edit('editor').on('change', function (evnt) {
                    $('#content').val(e.getValue());
               });
            });
        </script>

</form>

<script>
    yepnope.injectJs('/bower_components/uikit/js/core/switcher.js');
    
    yepnope.injectJs('/bower_components/juk/juk-form.js',function(){
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('form').jukForm({
                start_load:false,
                submit_url: '{{$url_controller}}/update?_token={{csrf_token()}}',
                event_update_success: function() {
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