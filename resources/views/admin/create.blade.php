@extends('wrap')

@section('title', 'Создание формы')

@section('content')
<div class="background" style="background-image: url('{{asset('public/storage/'.$data['background'])}}')"></div>
<h1>Создание формы</h1>
<form class="form-create" method="POST"  action="{{ route('save.form.data') }}">
    @method('POST')
    @csrf
    <div class="form-create-header">
        <div>
            <label for="title"><h2>Название </h2></label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="theme_id"><h2>Фон</h2></label>
            <select name="theme_id" id="theme_id" required>
                <option value="" disabled selected>-</option>
                @foreach ($data['theme'] as $item)
                <option value="{{$item['id']}}" class="option-background">{{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <br>
            <input type="submit" value="Создать форму">
        </div>
    </div>
    <div class="page-list">
        <div class="form-view">
            <div class="page-question page-question-1">
                <div class="form-group">
                    <label for="question_text">Текст вопроса:</label><br>
                    <textarea name="question_text" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="question_comment">Коментарий:</label><br>
                    <textarea name="question_comment" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="required">Обязательный вопрос:</label><br>
                    <select name="required" class="form-control" required>
                        <option value="1">Да</option>
                        <option value="0">Нет</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="field_type">Тип поля:</label><br>
                    <select name="field_type" class="form-control" required onchange="toggleFieldValues(this)">
                        <option value="text">Текстовое поле</option>
                        <option value="select">Выпадающий список</option>
                        <!-- Другие варианты типов полей -->
                    </select>
                </div>
                <div class="form-group" id="field_values_group" style="display:none;">
                    <label for="field_values">Значения:</label><br>
                    <div class="field-values-container" style="display: block;"> <!-- Добавляем стиль display: block; -->
                        <div class="field-value">
                            <input type="text" name="field_values[]" class="form-control" placeholder="Ответ" required>
                            <input type="number" name="points[]" class="form-control" placeholder="Балл" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addFieldValue(this)">+</button>
                </div>
                <div class="form-group" id="fieldball" style="display:blcok;">
                    <label for="points">Баллы за ответ:</label><br>
                    <input name="points" type="number" class="form-control" required>
                </div>
            </div>
        </div>
    </div>
    <div class="button-form button-page" onclick="createPage()">Добавить страницу</div>
</form>


<script>
    function toggleFieldValues(selectElement) {
        var fieldValuesGroup = selectElement.parentNode.parentNode.querySelector('#field_values_group');
        var fieldBall = selectElement.parentNode.parentNode.querySelector('#fieldball');
        if (selectElement.value === 'select') {
            fieldValuesGroup.style.display = 'block';
            fieldBall.style.display = 'none';
        } else {
            fieldValuesGroup.style.display = 'none';
            fieldBall.style.display = 'block';

        }
    }

    function addFieldValue(buttonElement) {
        var fieldValuesContainer = buttonElement.parentNode.querySelector('.field-values-container');
        var fieldValueTemplate = `
            <div class="field-value">
                <input type="text" name="field_values[]" class="form-control" placeholder="Ответ" required>
                <input type="number" name="points[]" class="form-control" placeholder="Балл" required>
            </div>`;
        fieldValuesContainer.insertAdjacentHTML('beforeend', fieldValueTemplate);
    }


</script>
@endsection
