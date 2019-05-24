function paramToObj(name, value) {
    if (value === undefined) value = '';
    if (typeof value == 'object') return value;

    try {
        return JSON.parse(JSON.stringify(eval("({" + value + "})")));
    }
    catch (e) {
        throw new Error('Error parsing the '+name+' attribute value. '+e);
    }
}

$(document).ready(function() {
    // Хэшируем открытую вкладку
    $('a[href^="#"][data-toggle="tab"]').click(function() {
        location.hash = $(this).attr('href');
    });

    // Открываем активную вкладку при открытии страницы
    if (location.hash.length > 2) {
        let link = $(`a[href="${location.hash}"][data-toggle="tab"]`);
        if (link.length === 1) {
            link.click();
        }
    }

    // Проставляем id в label[for] для richeditor
    $('form textarea[id^="RichEditor-"]').each(function(key, val) {
        let id = 'Form-field-' + val.name.split('[')[0] + '-',
            el = val.id.split('-');
        id += el[el.length - 1];
        el = $(`label[for="${id}"]`);
        if (el.length) {
            el.attr('for', val.id);
        }
    });

    // Фокус на select2
    $(document).on('focus', '.select2', function (e) {
        if (e.originalEvent) {
            $(this).siblings('select:not([disabled])').select2('open');
        }
    });

    // Фокус на RichEditor
    $('label[for]').click(function(e){
        let el = $('#' + $(this).attr('for'));
        if (!el.is(':visible') && el.parents('.field-richeditor').length === 1) {
            el.froalaEditor('events.focus');
        }
    });

    if ($.fn.formWidget != null) {
        let selectMultipleClass = '.select2-selection.select2-selection--multiple .select2-selection__rendered';
        let disableDoubleClick = function(e){
            if (
                !(e.target.tagName === 'SPAN' && e.target.classList.contains('select2-selection__choice__remove'))
                && !(e.target.tagName === 'INPUT' && e.target.classList.contains('select2-search__field'))
            ) {
                e.preventDefault();
                e.stopPropagation();
            }
        };
        let setSelectPreview = function(selector){
            selector.each(function(key, val) {
                let $this = $(val);
                if ($this.parents('.form-group-preview').length) {
                    $this.attr('disabled', 'disabled');
                }
            });
        };
        let inputMask = function(selector){
            selector.inputmask();
        };

        let bindDependants = $.fn.formWidget.prototype.constructor.Constructor.prototype.bindDependants;
        $.fn.formWidget.prototype.constructor.Constructor.prototype.bindDependants = function() {
            bindDependants.bind(this)();
            $(selectMultipleClass).unbind('click', disableDoubleClick).bind('click', disableDoubleClick);
            setSelectPreview(this.$form.find('select.custom-select'));
            inputMask(this.$form.find('[data-inputmask]'));
        };
        $(selectMultipleClass).unbind('click', disableDoubleClick).bind('click', disableDoubleClick);
        setSelectPreview($('select.custom-select'));
        inputMask($('form input[data-inputmask]'));
    }

    if ($.oc.relationBehavior != null) {
        $.oc.relationBehavior.clickViewListRecord = function(recordId, relationId, sessionKey){
            let newPopup = $('<a />'),
                $container = $('#'+relationId),
                requestData = paramToObj('data-request-data', $container.data('request-data'));

            let data = {
                'manage_id': recordId,
                '_session_key': sessionKey
            };
            let form = $(`#${relationId}`).parents('form').first();
            if (form.length) {
                form = form.serializeArray();
                for (let i = 0; i < form.length; i++) {
                    if (form[i].name.substr(0, 1) !== '_') {
                        data[form[i].name] = form[i].value;
                    }
                }
            }
            newPopup.popup({
                handler: 'onRelationClickViewList',
                size: 'huge',
                extraData: $.extend({}, requestData, data)
            })
        }
    }
});