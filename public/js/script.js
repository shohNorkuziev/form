//окно подтверждения действия
function openPopup(x) {
    document.querySelector('.popup'+x).style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}
function closePopup(x) {
    document.querySelector('.popup'+x).style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}
//перелистывание страниц
var prevBtn = document.querySelector(".previous");
var nextBtn = document.querySelector(".next");
var sendBtn = document.querySelector(".send");

function previous(currentPage, maxPage) {
    document.querySelector('.page-' + currentPage).style.display = 'none';
    document.querySelector('.page-' + (currentPage - 1)).style.display = 'block';

    if (currentPage - 1 > 1) {
        prevBtn.style.display = 'block';
        nextBtn.style.display = 'block';
        sendBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'block';
        sendBtn.style.display = 'none';
    }

    prevBtn.onclick = function() {
        previous(currentPage - 1, maxPage);
    };
    nextBtn.onclick = function() {
        next(currentPage - 1, maxPage);
    };
}

function next(currentPage, maxPage) {
    let inputs = document.getElementsByClassName('required-'+currentPage);
    let isValid = true;
    for (var i = 0; i < inputs.length; i++) {
        if (!inputs[i].checkValidity()) {
            isValid = false;
            inputs[i].reportValidity();
        }
    }
    if(isValid){
        document.querySelector('.page-' + currentPage).style.display = 'none';
        document.querySelector('.page-' + (currentPage + 1)).style.display = 'block';

        prevBtn.onclick = function() {
            previous(currentPage + 1, maxPage);
        };
        nextBtn.onclick = function() {
            next(currentPage + 1, maxPage);
        };

        if (currentPage + 1 < maxPage) {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
            sendBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'none';
            sendBtn.style.display = 'block';
        }
    }

}
//добавление страницы

const pageDiv = document.querySelector('.page-list');

function createPage() {
    const pageDiv = document.querySelector('.page-list');
    let currentDate = new Date();
    const newDiv = document.createElement('div');
    newDiv.className = 'form-view';
    let layout = `
        <div class="page-question page-question-1">
            <div class="form-group">
                <label for="question_text">Текст вопроса:</label><br>
                <textarea name="question_text" class="form-control" required></textarea>
            </div>
            <div class="form-group">
            <label for="question_text">Коментарий:</label><br>
            <textarea name="question_text" class="form-control" required></textarea>
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
                <div class="field-values-container">
                    <div class="field-value">
                        <input type="text" name="field_values[]" class="form-control" placeholder="Ответ" required>
                        <input type="number" name="points[]" class="form-control" placeholder="Балл" required>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="addFieldValue(this)">+</button>
            </div>
            <div class="form-group" id="fieldball" style="display:block;">
                <label for="points">Баллы за ответ:</label><br>
                <input name="points" type="number" class="form-control" required>
            </div>
        </div>`;
    newDiv.innerHTML = layout;
    pageDiv.appendChild(newDiv);
}
