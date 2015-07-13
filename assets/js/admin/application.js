// namespace
window.app = {
    handler: {}
};

// Allow for console.log to not break IE
if (typeof window.console == "undefined" || typeof window.console.log == "undefined") {
    window.console = {
        log: function () {
        },
        info: function () {
        },
        warn: function () {
        }
    };
}
if (typeof window.console.group == 'undefined' || typeof window.console.groupEnd == 'undefined' || typeof window.console.groupCollapsed == 'undefined') {
    window.console.group = function () {
    };
    window.console.groupEnd = function () {
    };
    window.console.groupCollapsed = function () {
    };
}
if (typeof window.console.markTimeline == 'undefined') {
    window.console.markTimeline = function () {
    };
}
window.console.clear = function () {
};

// ready event
app.ready = function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-REMOTE': 'true'
        }
    });

    $.fn.api.settings.successTest = function (response) {
        return response.success || false;
    };

    $.fn.api.settings.onComplete = function (response, element) {
        element.trigger('ajaxDone', [element, response])
    };

    $.fn.api.settings.onError = function (response) {
        alert(response)
    };

    var
        $document = $(document),
        $sticky = $('.ui.sticky'),
        $dropdown = $('.ui.dropdown'),
        $checkbox = $('.ui.checkbox'),
        $sortTable = $('.sortable.table'),
        $tabs = $('.ui.tabular.menu'),
        handler
        ;

    handler = {
        selectAll: function () {
            this.setSelectionRange(0, this.value.length);
        }
    }

    app.handler = handler;

    if ($.fn.tablesort !== undefined && $sortTable.size() > 0) {
        $sortTable
            .tablesort()
        ;
    }

    $dropdown
        .dropdown({
            transition: 'drop'
        })
    ;

    $checkbox
        .checkbox()
    ;
    /*
     $tabs
     .tab()
     ;*/

    $('.message .close').on('click', function () {
        $(this).closest('.message').fadeOut();
    });

    $(window).on('ajaxDone', function () {
        $('.ui.accordion').accordion('refresh');
        $('.ui.checkbox').checkbox();
        $('.message .close').on('click', function () {
            $(this).closest('.message').fadeOut();
        });
    });
}

// attach ready event
$(document)
    .ready(app.ready)
;
