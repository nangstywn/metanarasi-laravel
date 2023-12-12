function costumSelect2Paginate(placeholder, object, url, parameters = null) {
    object.select2({
        placeholder: placeholder,
        ajax: {
            url: url,
            data: function (params) {
                var query = {
                    search: params.term,
                    page: params.page || 1
                }
                if (parameters !== null) {
                    query = $.extend(query, $.parseJSON(parameters));
                }
                return query
            },
            dataType: 'json',
            delay: 250,
            processResults: function (data) {

                return {
                    results: data.data,
                    pagination: {
                        more: (data.current_page == data.last_page) ? null : data.current_page + 1
                    }
                }
            },
            cache: true
        }
    });
}