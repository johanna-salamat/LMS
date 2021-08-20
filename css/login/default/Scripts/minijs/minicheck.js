
function NameInspection(ctr) {
    var content = $(ctr).val();
    var errorCtr = $("#e_" + ctr.id);
    var infoCtr = $("#i_" + ctr.id);
    if (content.length == 0) {
        if (errorCtr.length > 0) {
            errorCtr.show();
        }
        if (infoCtr.length > 0) {
            infoCtr.show();
        }

    } else {
        if (errorCtr.length > 0) {
            errorCtr.hide();
        }
        if (infoCtr.length > 0) {
            infoCtr.hide();
        }
    }
}

function TelInspection(ctr) {
    var content = $(ctr).val();
    content = $.trim(content);
    $(ctr).val(content);
    var errorCtr = $("#e_" + ctr.id);
    var infoCtr = $("#i_" + ctr.id);
    var reg = /^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$/;
    if (!reg.test(content)) {
        errorCtr.show();
        return false;
    }
    if (content.length == 0) {
        if (errorCtr.length > 0) {
            errorCtr.show();
        }
        if (infoCtr.length > 0) {
            infoCtr.show();
        }

    } else if (content.length < 11) {
        if (errorCtr.length > 0) {
            errorCtr.show();
        }
        if (infoCtr.length > 0) {
            infoCtr.show();
        }
    } else if (content.length > 11) {
        if (errorCtr.length > 0) {
            errorCtr.show();
        }
        if (infoCtr.length > 0) {
            infoCtr.show();
        }
    } else {
        if (errorCtr.length > 0) {
            errorCtr.hide();
        }
        if (infoCtr.length > 0) {
            infoCtr.hide();
        }
    }
    return true;
}



function numberInspection(ctr) {
    var content = $(ctr).val();
    var min = $(ctr).attr("min");
    var max = $(ctr).attr("max");
    var required = $(ctr).attr("required");
    var errproperty = $(ctr).attr("errproperty");
    var errorCtr = $("#e_" + ctr.id);
    var infoCtr = $("#i_" + ctr.id);
    if (content < min || content > max) {
        
        if (errorCtr.length > 0) {
            errorCtr.html(errproperty+"input wrong");
            errorCtr.show();
        }
        if (infoCtr.length > 0) {
            infoCtr.show();
        }
        return;
    } else if (checkNullOrEmpty(content) && required=='required') {
        if (errorCtr.length > 0) {
            errorCtr.show();
        }
        if (infoCtr.length > 0) {
            infoCtr.show();
        }

    } else {
        if (errorCtr.length > 0) {
            errorCtr.hide();
        }
        if (infoCtr.length > 0) {
            infoCtr.hide();
        }
    }
}


function checkNullOrEmpty(str) {
    var result = false;
    if (str == null)
        result = true;
    str = str.replace(/(^\s*)|(\s*$)/g, "");
    if (str.length == 0)
        result = true;
    return result;
}


function checkRegExp(str) {
    var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
    if (pattern.test(str)){
        return true;
    }
    return false;
}

//Check for special characters
function checkValueHashRxp(ctrlId) {
    var iu, iuu, regArray = new Array("◎", "■", "●", "№", "↑", "→", "↓" +
    "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "-", "+", "=", "|", "", "[", "]", "？", "~", "`" +
    "!", "<", ">", "‰", "→", "←", "↑", "↓", "¤", "§", "＃", "＆", "＆", "＼", "≡", "≠" +
    "≈", "∈", "∪", "∏", "∑", "∧", "∨", "⊥", "‖", "‖", "∠", "⊙", "≌", "≌", "√", "∝", "∞", "∮" +
    "∫", "≯", "≮", "＞", "≥", "≤", "≠", "±", "＋", "÷", "×", "/" +
    "╄", "╅", "╇", "┻", "┻", "┇", "┭", "┷", "┦", "┣", "┝", "┤", "┷", "┷", "┹", "╉", "╇", "【", "】" +
    "①", "②", "③", "④", "⑤", "⑥", "⑦", "⑧", "⑨", "⑩", "┌", "├", "┬", "┼", "┍", "┕", "┗", "┏", "┅", "—" +
    "〖", "〗", "←", "〓", "☆", "§", "□", "‰", "◇", "＾", "＠", "△", "▲", "＃", "℃", "※", ".", "≈", "￠");
    iuu = regArray.length;
    var obj = document.getElementById(ctrlId);
    for (iu = 1; iu <= iuu; iu++) {
        if (regArray[iu] != "") {
            if (obj.value.indexOf(regArray[iu]) != -1) {
                return true;
            }
        }
    }
    return false;
}


function checkRightDate() {
    
    var startdate = $("#Time").val();
    var arr = startdate.split("-");
    var starttime = new Date(arr[0], arr[1], arr[2]);
    var starttimes = starttime.getTime();

    var enddate = '';
    var myDate = new Date();
    var year = myDate.getFullYear();   
    enddate += year;   
    var month = (myDate.getMonth() + 1);      
    if (month < 10)
        enddate += '-0' + month;
    else
        enddate += '-' + month;
    var day = myDate.getDate();     
    if (day < 10)
        enddate += '-0' + day;
    else
        enddate += '-' + day;

    var arrs = enddate.split("-");
    var lktime = new Date(arrs[0], arrs[1], arrs[2]);
    var lktimes = lktime.getTime();

    if (starttimes > lktimes) {
        return true;
    }
    return false;
}

function GetFileObject(name) {
    try {
        var lenght = GetFileObjectList.length;
        for (var i = 0; i < lenght; i++) {
            var file = GetFileObjectList[i];
            if (file.name == $.trim(name) || file.key ==name)
                return file;
        }
        return GetFileObjectList[0];
    } catch (e) {
        return GetFileObjectList[0];
    }
}
function renderTime(date) {
    if (date == "" || date == null) {
        return false;
    }
    var da = new Date(parseInt(date.replace("/Date(", "").replace(")/", "").split("+")[0]));
    return da.getFullYear() + "-" + (da.getMonth() + 1) + "-" + da.getDate() + " " + da.getHours() + ":" + da.getSeconds() + ":" + da.getMinutes();
}
function formatDate(date, format) {
    if (!date) return false;
    if (!format) format = "yyyy-MM-dd";
    switch (typeof date) {
        case "string":
            date = new Date(date.replace(/-/g, "/"));
            break;
        case "number":
            date = new Date(date);
            break;
    }
    if (!date instanceof Date) return false;
    var dict = {
        "yyyy": date.getFullYear(),
        "M": date.getMonth() + 1,
        "d": date.getDate(),
        "H": date.getHours(),
        "m": date.getMinutes(),
        "s": date.getSeconds(),
        "MM": ("" + (date.getMonth() + 101)).substr(1),
        "dd": ("" + (date.getDate() + 100)).substr(1),
        "HH": ("" + (date.getHours() + 100)).substr(1),
        "mm": ("" + (date.getMinutes() + 100)).substr(1),
        "ss": ("" + (date.getSeconds() + 100)).substr(1)
    };
    return format.replace(/(yyyy|MM?|dd?|HH?|ss?|mm?)/g, function () {
        return dict[arguments[0]];
    });
}
function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' +
            num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num + '.' + cents);
}