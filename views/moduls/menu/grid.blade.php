<div id="table" data-table-parent="0">
    <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <div class="uk-grid">
            <div class="uk-width-1-2">
                <button class="uk-button uk-button-primary" data-x-model="{{$url_controller}}/form-new">Добавить</button>
                <button class="uk-button" data-table-reload>Обновить</button>
                <button class="uk-button" data-table-up ><i class="uk-icon-reply"></i></button>
            </div>
            <div class="uk-width-1-2">
                <div data-table-move-panel style="text-align: right;display:none">
                    <button class="uk-button" data-table-move-method="clear"><i class="uk-icon-close "></i></button>
                    <button class="uk-button" data-table-move-method="this-append"><i class="uk-icon-paste "></i></button>
                </div>
            </div>
        </div>
    </div>


    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed"
        data-x-url="{{$url_controller}}/getlist/{{$parent_id or 0}}?_token={{csrf_token()}}">
        <caption>название</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Загаловок</th>
                <th>URL</th>
                <th>Активен</th>
                <th  style="text-align: right;">Упровление</th>
            </tr>
        </thead>
        <tfoot>
            <tr style="text-align: right;">
                <td>int</td>
                <td>varchar</td>
                <td>varchar</td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>[[id]]</td>
                <td>[[title]]</td>
                <td>[[url]]</td>
                <td>[[active]]</td>
                <td  style="text-align: right;">
                    [[link_page_id]]
                    <button class="uk-button uk-button-large" data-table-parent="[[id]]"><i class="uk-icon-arrow-circle-o-down"></i></button>
                    <button class="uk-button uk-button-large uk-button-primary" data-x-model="{{$url_controller}}/edit/[[id]]"><i class="uk-icon-edit"></i></button>
                    <button class="uk-button uk-button-large uk-button-danger" onclick="
                                        UIkit.modal('#x-row-remove-conform').show();
                                        $('#x-row-remove-conform .x-id').html([[id]])"><i class="uk-icon-trash"></i></button>

                    <button class="uk-button uk-button-large" data-table-move="[[id]]"><i class="uk-icon-cut"></i></button>
                    
                </td>
            </tr>
        </tbody>
    </table>
    
    <div data-table-move-modal class="uk-modal">
        <div class="uk-modal-dialog">
            <a class="uk-modal-close uk-close"></a>

                <button class="uk-button uk-width-1-1" data-table-move-method="top"><i class="uk-icon-arrow-up "></i></button>
                <button class="uk-button uk-width-1-1" data-table-move-method="append"><i class="uk-icon-paste "></i></button>
                <button class="uk-button uk-width-1-1" data-table-move-method="bottom"><i class="uk-icon-arrow-down "></i></button>
       
        </div>
    </div>
    
</div>


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
                            juk.event.reload_table.action();
                        }
                    });
                    ">Удалить</button>
            <button class="uk-button uk-button-danger" onclick="UIkit.modal('#x-row-remove-conform').hide()">Отменить</button>
        </div>
    </div>
</div>


<script>

$.when(
    //juk.loadJsCss('/js/jsuikit/ext/juktable.js'),
    juk.loadJsCss('/bower_components/juk/lara/table.js'),
    juk.loadJsCss('/bower_components/juk/juk-modal.js')
).done(function () {
    
    lara.table({
        el: '#table',
        url_controller: '{{$url_controller}}',
        url: '{{$url_controller}}/getlist/',
        token: '{{csrf_token()}}',
        fields: {
            id: function(val) {
                return val.id;
            },
            title: function(val) {
                return val.make_title;
            },
            url: function(val) {
                return val.make_url;
            },
            active: function(val) {
                return val.active;
            },
            page_id: function(val) {
                return val.page_id;
            },
            link_page_id: function(val) {
                
                if (val._sunc_page)
                {
                    var link = 'link';
                }
                else
                {
                    var link = 'unlink';
                }
                
                if (val.page_id){
                    return '<a href="/lara/page/edit/'+val.page_id+'" class="uk-button uk-button-large"><i class="uk-icon-'+link+'"></i></a>';
                }
                return '';
            }
        }
    });
    
});
</script>