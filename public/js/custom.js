function open_popup(url, parameter, f_top, f_left, f_width, f_height, f_toolbar, f_scrollbar, f_resize, target) {
    // left 설정 시, 듀얼모니터일 경우 가로 너비를 듀얼로 사용하기때문에 , 계산을 통해서 진행
    var popWidth  = f_width; // 파업사이즈 너비
    var winWidth  = document.body.clientWidth;  // 현재창의 너비
    var winX      = window.screenX || window.screenLeft || 0;// 현재창의 x좌표
    var w = winX + (winWidth - popWidth) / 2;

    window.open(url + (parameter ? "?" + parameter : ""), (target==="" ? "_blank" : target),
        "toolbar="+(f_toolbar==="" ? "yes" : f_toolbar) +
        ",scrollbars="+(f_scrollbar==="" ? "yes" : f_scrollbar) +
        ",resizable="+(f_resize==="" ? "yes" : f_resize) +
        ",top="+f_top+
        ",left="+w+
        ",width="+f_width+
        ",height="+f_height);
}

var js = {
    blank_check:function(blank_id, blank_field) {
        var id = $("#"+blank_id);
        if (id.val() === "") {
            alert(blank_field + "을(를) 선택하여 주세요.");
            id.focus();

            return false;
        }

        return true;
    },
    go_url:function(url) {
        location.href=url;
    },
    regex:function (value, rules, replacer) {
        if(!replacer) replacer = "";
        return value && rules ? $.trim(value).replace(rules, replacer): "";
    },
    special_chars:function(value) {
        value = value.replace(/[ㄱ-ㅎㅏ-ㅣ가-힣A-Za-z?!@#$%^&*()=;{}\[\]\-`' ]/gi, "");
        return js.regex(value, /[^0-9][:][,]/gi);
    },
    ajax_call:function(method, url, datas, dataType, refresh, location_url, ret) {
        refresh = typeof refresh !== 'undefined' ? refresh : false;
        ret = ret ? ret : false;
        location_url = location_url ? location_url : "";

        var retval = "";
        $.ajax({
            async: (!ret),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: method,
            url:  url,
            data: datas,
            dataType: dataType,
            success:function (args) {
                if (dataType !== "json") {
                    if (ret) {
                        retval = args;
                    }
                } else {
                    if (args["status"] === "ok") {
                        if (ret) {
                            retval = args['result'];
                        }
                        if (refresh) {
                            if(args['stop']){
                                return;
                            }
                            if (location_url!=="") {
                                location.href = location_url;
                                return;
                            }
                            if (self.opener) {
                                opener.location.reload();
                                self.close();
                            } else {
                                self.location.reload();
                            }
                        }
                    } else {
                        if (args["msg"]!=="")
                            alert(args["msg"]);
                    }
                }
            },
            error:function (args) {
                alert(args.responseText);
            }
        });
        if (ret) {
            return retval;
        }
    }
}
