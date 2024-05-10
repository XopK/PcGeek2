$(function () {
    $("#postTags").autocomplete({
        source: function (request, response) {
            var term = request.term.toLowerCase();
            $.ajax({
                url: '/' + $('#postTags').data(
                    'tags'), // Здесь используем data-tags для получения URL
                dataType: 'json',
                data: {
                    term: term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 0,
        select: function (event, ui) {
            var currentValue = $("#postTags").val();
            var selectedTag = ui.item.value;
            var updatedValue = currentValue.trim();
            if (updatedValue) {
                updatedValue += ", ";
            }
            updatedValue += selectedTag;
            $("#postTags").val(updatedValue);
            return false;
        }
    }).focus(function () {
        $(this).autocomplete("search", "");
    });

    $(document).ready(function () {
        // Функция для дублирования блока
        $('#duplicateButton').click(function () {
            var clonedBlock = $('.component-block').last()
                .clone(); // Клонируем последний блок
            clonedBlock.find('input, select').val(''); // Очищаем значения input и select
            clonedBlock.find('.alert')
                .remove(); // Удаляем блок с сообщением об ошибке, если он есть
            $('.component-block').last().after(
                clonedBlock); // Вставляем клонированный блок после последнего блока
        });

        // Функция для загрузки компонентов
        function loadComponents(categoryId, container) {
            $.ajax({
                url: '/components/' + categoryId,
                type: 'GET',
                success: function (data) {
                    var availableComponents = data.map(function (component) {
                        return {
                            label: component.title_component,
                            value: component.id
                        };
                    });

                    container.find('.form-control').autocomplete({
                        source: function (request, response) {
                            var term = request.term.toLowerCase();
                            var filteredComponents = availableComponents
                                .filter(function (component) {
                                    return component.label.toLowerCase()
                                        .indexOf(term) !== -1;
                                });
                            response(filteredComponents.slice(0, 12));
                        },
                        select: function (event, ui) {
                            $(this).val(ui.item.label);
                            $(this).closest('.component-block').find(
                                '#component_id').val(ui.item.value);
                            return false;
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Загрузка компонентов для первого блока при загрузке страницы
        loadComponents($('#pcComponents').val(), $('.component-block').first());

        // Загрузка компонентов при изменении значения в селекте категории
        $(document).on('change', '.component-block select', function () {
            var categoryId = $(this).val();
            var container = $(this).closest('.component-block');
            loadComponents(categoryId, container);
        });
    });


    $('#pcComponents').change(function () {
        var categoryId = $(this).val();
        loadComponents(categoryId);
    });


    $('#pcComponents').trigger('change');

});
