
$.fn.greedhelper = {

    uuidv4: function () {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            let r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    },

    comparer: function (index) {
        return function (a, b) {
            var valA = $.fn.greedhelper.getCellValue(a, index), valB = $.fn.greedhelper.getCellValue(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
        }
    },
    getCellValue: function (row, index) {
        return $(row).children('td').eq(index).text()
    },

    sort: function (id, title) {
        $("body").on('click', '#' + id, function () {

            const upDownIcon = this.asc ? "down" : "up";

            $("#" + id).html(`${title} <i class="fa fa-angle-${upDownIcon} aria-hidden="true"></i>`);

            const table = $(this).parents('table').eq(0);
            let rows = table.find('tr:gt(0)').toArray().sort($.fn.greedhelper.comparer($(this).index()));
            this.asc = !this.asc;

            if (!this.asc) {
                rows = rows.reverse();
            }

            for (let i = 0; i < rows.length; i++) {
                table.append(rows[i]);
            }
        });

    },

    get: function (url, parameters, success, loading) {

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

};


$.fn.greed = function (opts) {
    let elm = $(this);

    let options = $.extend({
        url: '',
        highlightRow: true,
        editButton: null, //func
        deleteButton: null, //func
        cols: [],
        data: [],
        success: null //func
    }, opts);

    $.fn.greedhelper.get(options.url, {}, function (data) {
       setBody(data);
    });

    elm.addClass("greed");

    if (options.highlightRow) {
        $(function () {
            $("tr:not(:has(th))").mouseover(function () {
                $(this).addClass("hover");
            });
            $("tr:not(:has(th))").mouseleave(function () {
                $(this).removeClass("hover");
            });
        });
    }


    let tableHeader = "";

    tableHeader += "<thead><tr>";

    $.map(options.cols, function (col, colIndex) {
        const colSize = typeof col.size === "undefined" ? 50 : col.size;
        const display = typeof col.hide === "undefined" ? 'table-cell' : col.hide ? 'none' : 'table-cell';
        const sort = typeof col.sort === "undefined" ? false : col.sort;
        const uuid = $.fn.greedhelper.uuidv4();

        tableHeader += `<th id="${uuid}" style="width: ${colSize}; display:${display}">${col.title}</th>`;

        if (sort) {
            $.fn.greedhelper.sort(uuid, col.title);
        }
    });

    if (typeof options.editButton === "function") {
        tableHeader += `<th style="width: 60px;">Action</th>`;
    }

    tableHeader += "<tr></thead>";
    elm.append(tableHeader);


    function setBody(data) {
        let tableBody = '';
        $.map(data, function (row, rowIndex) {
            tableBody += "<tr>";

            $.map(options.cols, function (col, colIndex) {
                const display = typeof col.hide === "undefined" ? 'table-cell' : col.hide ? 'none' : 'table-cell';
                if (display === 'table-cell') {
                    tableBody += `<td>${row[col.key]}</td>`;
                }
            });


            tableBody += '<th style="width: 60px;">';

            if (typeof options.editButton === "function") {
                const actionId = "act" + $.fn.greedhelper.uuidv4();
                tableBody += `<i  id="${actionId}" class="fa fa-pencil-square-o" aria-hidden="true"></i> `;
                $("body").on('click', "#" + actionId, function () {
                    options.editButton(row, rowIndex);
                });
            }

            if (typeof options.deleteButton === "function") {
                const actionId = "act" + $.fn.greedhelper.uuidv4();
                tableBody += `<i  id="${actionId}" class="fa fa-trash" aria-hidden="true"></i> `;
                $("body").on('click', "#" + actionId, function () {
                    options.deleteButton(row, rowIndex);
                });
            }

            tableBody += '</th>';

            tableBody += "</tr>";
        });
        elm.append(tableBody);
    }

};
