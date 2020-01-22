function POST(url, data, success, loading) {

    if (loading === null || loading === '' || typeof loading === 'undefined') {

        loading = 'body';

    }

    $.ajax({

        type: "POST",

        url: Manager.BaseUrl + url,

        data: data,

        async: true,

        dataType: "json",

        headers: {

            RequestVerificationToken: $('input:hidden[name="__RequestVerificationToken"]').val()

        },

        success: success,

        beforeSend: function () {

            $(loading).loading({

                message: 'Yükleniyor...',

                stoppable: false,

                start: true

            });

        },

        complete: function myfunction() {

            $(loading).loading('stop');

        }

    }).fail(function (result) {

        $(loading).loading('stop');

    });

}


function GET(url, parameters, success, loading) {

    if (parameters === null || parameters === '' || typeof parameters === "undefined") {
        parameters = '';
    }

    if (loading === null || loading === '' || typeof loading === "undefined") {
        loading = false;
    }

    $.ajax({
        type: "GET",
        url: url + "?" + parameters,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        cache: false,
        headers: {

            //RequestVerificationToken: $('input:hidden[name="__RequestVerificationToken"]').val()

        },
        success: success,

        beforeSend: function () {

        },
        complete: function (result) {


        },
        done: function (result) {


        }

    }).fail(function (result) {


    });
}
