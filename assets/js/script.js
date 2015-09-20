function simpleAjaxCall(url) {
    var res = null;
    $.ajax({
        type: "POST",
        url: url,
        async: false,
        beforeSend: function () {
            //functions to be executed before sending AJAX request
        },
        complete: function () {
            //functions to be executed after completing AJAX requests
        },
        success: function (data) {
            res = data;
        },
        error: function (data) {
            res = data;
        }
    });
    return res;
}


//$(document).ready(function() {
//    $('#saisieForm').formValidation({
//        framework: 'bootstrap',
//        icon: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
//        },
//        row: {
//            valid: 'field-success',
//            invalid: 'field-error'
//        },
//        fields: {
//            libelle: {
//                validators: {
//                    notEmpty: {
//                        message: 'The task name is required'
//                    },
//                    stringLength: {
//                        min: 6,
//                        max: 30,
//                        message: 'The task name must be more than 6 and less than 30 characters long'
//                    },
//                    regexp: {
//                        regexp: /^[a-zA-Z0-9_\.]+$/,
//                        message: 'The task name can only consist of alphabetical, number, dot and underscore'
//                    }
//                }
//            },
//            password: {
//                validators: {
//                    notEmpty: {
//                        message: 'The password is required'
//                    }
//                }
//            }
//        }
//    });
//});

