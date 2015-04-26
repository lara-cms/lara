<h2>Страница</h2>

<div class="uk-grid">
    <div class="uk-width-1-2">
        @section('left_form')
        <form id="form-page" class="uk-form" action="{{$url_controller}}/getdata/{{$model->id}}?_token={{csrf_token()}}" method="POST" data-x-form>
                <fieldset>
                    
                    <table class="uk-table uk-table-hover">

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
        </form>
        @show  
    </div>
    <div class="uk-width-1-2">
        @section('right_form')
       
        @show                
    </div>
</div>






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
@section('data_form')
<script>
    
    var startTpl = $('#form-page [name=template').val();
    
    var dataForm = function($form){
        var arr1 = {};
        var arr2= {page_field:{}};
        
        var page = $form.serializeArray();
        
        var page_field = {};
        page_field = $('#form-page-field').serializeArray();

        
        jQuery.each(page, function (index, val) {
            arr1[val['name']] = val['value'];
        });
        
        jQuery.each(page_field, function (index, val) {
            arr2.page_field[val['name']] = val['value'];
        });

        return $.extend(arr1,arr2);
    }
</script>    
@show  


<script>
    yepnope.injectJs('/bower_components/uikit/js/core/switcher.js');
    
    yepnope.injectJs('/bower_components/juk/juk-form.js',function(){
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('form').jukForm({
                start_load:false,
                submit_url: '{{$url_controller}}/update?_token={{csrf_token()}}',
                data: dataForm,
                event_update_success: function() {
                    
                    var newTpl = $('#form-page [name=template').val();
                    
                    if (newTpl !== startTpl){
                        location.reload();
                    }
                    
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