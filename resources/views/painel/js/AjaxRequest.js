class AjaxRequest {

    constructor(id, attr = 'id') {

        this._id = id;
        this._element = this.getElementsByAttribute(attr, this._id);
        this._form = document.getElementById(this._id);

        this.is_form = this.getElementsType();

        this._type = 'POST';
        this._headers = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
        this._url = $(this._element).attr("action") ||
            $(this._element).attr("href") ||
            $(this._element).attr("url") || '/';
        this._data = this.is_form ? new FormData(this._form) : $(this._element).attr("data-json");
        this._dataType = 'json';
        this._cache = false;
        this._contentType = false;
        this._processData = false;
        this._beforeSend = {};
        this._success = {};
        this._error = {};

        return this;

    }

    send() {

        $.ajax({
            type: this._type,
            headers: this._headers,
            url: this._url,
            data: this._data,
            dataType: this._dataType,
            cache: this._cache,
            contentType: this._contentType,
            processData: this._processData,
            context: this,
            beforeSend: function () {

                $(this._element).find(':input[type=submit],button').prop('disabled', true);
                $(this._element).find("[type=submit]").addClass('load_frame');
                $(this._element).find('.form-group.field').removeClass('has-error');

                if (this._beforeSend && {}.toString.call(this._beforeSend) === '[object Function]') {
                    this._beforeSend();
                }

            },
            success: function (response) {

                $(this._element).find(':input[type=submit],button').prop('disabled', false);
                $(this._element).find("[type=submit]").removeClass('load_frame');

                if (this._success && {}.toString.call(this._success) === '[object Function]') {
                    this._success();
                }

                if (response.redirect) {
                    redirect(response.redirect);
                }

                if (response.message) {
                    notifier.success(response.message);
                }

                if (response.messages) {
                    $.each(response.messages, function (i, message) {
                        notifier.success(message);
                        return false;
                    });
                }

            },
            error: function (err) {

                $(this._element).find(':input[type=submit],button').prop('disabled', false);
                $(this._element).find("[type=submit]").removeClass('load_frame');

                if (this._error && {}.toString.call(this._error) === '[object Function]') {
                    this._error();
                }

                if (err.status == 422) { // when status code is 422, it's a validation issue

                    $.each(err.responseJSON.errors, function (i, error) {
                        notifier.warning(error[0], err.responseJSON.message);
                        return false;
                    });

                    // you can loop through the errors object and show it to the user
                    $.each(err.responseJSON.errors, function (i, error) {
                        var field = $(document).find('[name="' + i + '"]').parent('.form-group.field');
                        $(field).addClass('has-error');
                        $(field).children('span').empty().html(error[0]);
                    });

                } else if (err.status === 419) { // when status code is 419, it's a expire session issue
                    notifier.error(err.responseJSON.message);

                } else { // when status code is >= 500, it's a server erro
                    notifier.error('Tente novamente ou informe o administrador.', 'Erro interno do servidor.');
                }

                if (err.responseJSON.messages) {
                    $.each(err.responseJSON.messages, function (i, message) {
                        notifier.error(message);
                        return false;
                    });
                }

            },
        });

        return false;
    }

    addData(name, value, filename = '') {
        this._data.append(name, value, filename);
        return this;
    }

    setType(value) {
        this._type = value;
        return this;
    }

    setHeaders(value) {
        this._headers = value;
        return this;
    }

    setUrl(value) {
        this._url = value;
        return this;
    }

    setDataType(value) {
        this._dataType = value;
        return this;
    }

    setCache(value) {
        this._cache = value;
        return this;
    }

    setContentType(value) {
        this._contentType = value;
        return this;
    }

    setProcessData(value) {
        this._processData = value;
        return this;
    }

    onBeforeSend(value) {
        this._beforeSend = value;
        return this;
    }

    onSuccess(value) {
        this._success = value;
        return this;
    }

    onError(value) {
        this._error = value;
        return this;
    }

    getElementsByAttribute(attr, value) {
        var match = [];
        /* Get the droids we are looking for*/
        var elements = document.getElementsByTagName("*");
        /* Loop through all elements */
        for (var ii = 0, ln = elements.length; ii < ln; ii++) {
            if (elements[ii].nodeType === 1) {
                if (elements[ii].name != null) {
                    /* If a value was passed, make sure it matches the elements */
                    if (value) {
                        if (elements[ii].getAttribute(attr) === value)
                            match.push(elements[ii]);
                    } else {
                        /* Else, simply push it */
                        match.push(elements[ii]);
                    }
                }
            }
        }
        return match;
    };

    getElementsType() {

        return this._element[0].nodeName == "FORM";
    }
}
