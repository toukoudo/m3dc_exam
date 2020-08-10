$(function () {

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "選択してください");

    $("#nameForm").validate({
        rules: {
            todohuken: {
                valueNotEquals: "msg"
            },
            family_name: {
                required: true,
                maxlength: 5
            },
            name: {
                required: true,
                maxlength: 50
            },
            attendees: {
                required: true,
                digits: true
            }
        },
        messages: {
            todohuken: {
                equalTo: "選択してください"
            },
            family_name: {
                maxlength: "50文字以下で入力してください",
                required: "必須項目です"
            },
            name: {
                maxlength: "50文字以下で入力してください",
                required: "必須項目です"                
            },
            attendees: {
                digits: "数字のみ入力してください",
                required: "必須項目です"                
            }
        },
        errorClass: "error_msg",
        wrapper: "li"
    });
});
