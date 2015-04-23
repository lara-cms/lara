<script>
yepnope.injectJs('/js/jsuikit/juk-modal.js');

yepnope.injectJs('/js/jsuikit/juk-table.js',function(){
    yepnope.injectJs('/js/jsuikit/juk-loader.js',function(){
        table_reload ();
    });
});

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


yepnope.injectJs('/js/spin.js',function(){
    yepnope.injectJs('/js/jsuikit/juk-loader.js',function(){

    });
});
</script>

<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <button class="uk-button uk-button-primary" data-x-model="{{$url_controller}}/form-new">Добавить</button>
    <button class="uk-button" onclick="table_reload()">Обновить</button>
</div>


<table id="table" class="uk-table uk-table-hover uk-table-striped uk-table-condensed"
    data-x-url="{{$url_controller}}/getlist/?_token={{csrf_token()}}"
>
    <caption>название</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Почта</th>
            <th>Активен</th>
            <th  style="text-align: right;">Упровление</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td>int</td>
            <td>varchar</td>
            <td>varchar</td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
    <tbody>

    </tbody>
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
                            table_reload ();
                        }
                    });
                    ">Удалить</button>
            <button class="uk-button uk-button-danger" onclick="UIkit.modal('#x-row-remove-conform').hide()">Отменить</button>
        </div>
    </div>
</div>
