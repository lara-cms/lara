@extends('lara::layouts.page.form')

@section('right_form')
<form id="form-page-field" class="uk-form" method="POST">
    <fieldset>

        <table class="uk-table uk-table-hover">

            <tr>
                <td>
                    <lable>Цена:</lable>
                </td>
                <td>
                    <input type="text" placeholder="Загаловок" name="price" value="{{$model->getField('price')}}">
                </td>
            </tr>

            <tr>
                <td>
                    <lable>Картинка:</lable>
                </td>
                <td>
                    <input type="text" placeholder="Image" name="image" value="{{$model->getField('image')}}">
                </td>
            </tr>
            
            <tr>
                <td>
                    <lable>Описание:</lable>
                </td>
                <td>
                    <textarea placeholder="Описание" name="desc" >{{$model->getField('desc')}}</textarea>
                </td>
            </tr>
            
        </table>

    </fieldset>
</form>
@stop