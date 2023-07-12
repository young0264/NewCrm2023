/**
 *  validate 함수들
 * */
function phoneNumber() {
    $(document).on("keyup", ".phoneNumber", function () {
        console.log(this);
        $(this).val($(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})$/, "$1-$2-$3").replace("--", "-"));
        var pattern = /^(?:\d{3}-\d{3,4}-\d{4}|\d{2,3}-\d{3,4}-\d{4})$/;
        const MOBILE_CNT = 2;
        for (let i = 1; i <= MOBILE_CNT; i++) {
            if (document.getElementById("f_mobile" + i).value.match(pattern)) {
                document.getElementById("f_mobile" + i).style.borderColor = "blue";
            } else {
                document.getElementById("f_mobile" + i).style.borderColor = "red";
            }
        }
    });
}

function email() {
    $(document).on("keyup", ".email", function () {
        var pattern = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
        const EMAIL_CNT = 2;
        for (let i = 1; i <= EMAIL_CNT; i++) {
            if (document.getElementById("f_email" + i).value.match(pattern)) {
                document.getElementById("f_email" + i).style.borderColor = "blue";
            } else {
                document.getElementById("f_email" + i).style.borderColor = "red";
            }
        }
    });
}
