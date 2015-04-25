<script>
yepnope.injectJs('/bower_components/juk/juk-modal.js');

function table_reload () {
    $('#table').jukTable('reload',{
        event_run_ajax: function () {
            $('#table').jukLoader('set');
        },
        event_complete_ajax: function () {
            $('#table').jukLoader('remove');
        }
    });
}

jQuery.fn.jukTable = function (conf)
{
    var $this = null;
    var $config = {};
    
    this.config = null;
    
    if (this.config){
        $config = this.config;
    }

    var $view = function (value){
        
        if ($config.tpl === null){
            $config.tpl = $this.find($config.view_container).html();
            $this.find($config.view_container).empty();
        }
        var rezult = '';
        jQuery.each(value, function (index, val) {
            var tpl_val = [];
            var tpl_key = [];
             jQuery.each($config.fields, function (i, v) {
                tpl_key.push('[[' + i + ']]');
                tpl_val.push(v(val));
            });
            rezult = rezult + juk.str_replace(tpl_key, tpl_val, $config.tpl);
         });
         
        $this.find($config.view_container).html(rezult);
    }
    
    var $connect = function (){
        $config.preload().done(function() {;
        jQuery.ajax({
            type: 'POST',
            url: $config.url,
            dataType: 'json',
            data:$config.filter(),
            success: $config.success
        }).done($config.done);
    });
    }
   
   
    return this.each(function ()
    {
        $this = $(this);
        
        if (conf == 'reload'){
            $config = juk.var.jukTable[this.id]['config'];
            $connect();
        }else{
            var config = jQuery.extend({
                url: '/',
                view_container: 'tbody',
                tpl: null,
                fields: {},
                preload:function(){},
                done:function(){},
                success:function(json){
                    $view(json.rows);
                },
                filter:function(){}
            }, conf);

            $config = config;    

            if (juk.var.jukTable === undefined){
                juk.var.jukTable = {}
            }
            juk.var.jukTable[this.id] = {};
            juk.var.jukTable[this.id]['config'] = config;
            
            $connect();
        }
    });
}


</script>

<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <button class="uk-button uk-button-primary" data-x-model="{{$url_controller}}/form-new">Добавить</button>
    <button class="uk-button" onclick="$('#table').jukTable('reload')">Обновить</button>
</div>


<table id="table" class="uk-table uk-table-hover uk-table-striped uk-table-condensed"
    data-x-url="{{$url_controller}}/getlist/?_token={{csrf_token()}}"
>
    <caption>название</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Загаловок</th>
            <th>URL</th>
            <th>Шаблон</th>
            <th>Активен</th>
            <th style="text-align: right;">Упровление</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
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
        </tr>
    </tbody>
    
    <tfoot>
        <tr>
            <td>int</td>
            <td>varchar</td>
            <td>varchar</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
    
</table>




<div id="x-row-remove-conform" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <h2>Подтвердите удаление №<span class="x-id"></span></h2>
        <div class="uk-modal-footer">
            <button class="uk-button uk-button-primary" onclick="
                     jQuery.ajax({
                        type: 'POST',
                        url: '{{$url_controller}}/remove/'+$('#x-row-remove-conform .x-id').html()+'?_token={{csrf_token()}}',
                        dataType: 'json',
                        success : function(){
                            UIkit.modal('#x-row-remove-conform').hide();
                            $('#table').jukTable('reload');
                        }
                    });
                    ">Удалить</button>
            <button class="uk-button uk-button-danger" onclick="UIkit.modal('#x-row-remove-conform').hide()">Отменить</button>
        </div>
    </div>
</div>


<script>

$('#table').jukTable({
    url: "{{$url_controller}}/getlist/?_token={{csrf_token()}}",
    filter: function(){
        return $('#filter-form').serializeArray();
    },       
    preload: function(){
        var d = $.Deferred();
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('#table').jukLoader('set');
            d.resolve();
        });
        return d;
    },
    done: function (json){
        yepnope.injectJs('/bower_components/juk/juk-loader.js',function(){
            $('#table').jukLoader('remove');
        });
    },    
    fields: {
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
});

</script>