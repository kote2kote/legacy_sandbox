function requiredCheck(strVal, strErr) {
  if (strVal == '' || strVal == undefined) {
    return strErr + 'は必須入力です \n';
  } else {
    return '';
  }
}
function requiredRadioCheck(objElm, strErr) {
  flag = false;
  for (i = 0; i < objElm.length; i++) {
    if (objElm[i].checked) {
      flag = true;
    }
  }
  if (!flag) {
    return strErr + 'は必須入力です \n';
  } else {
    return '';
  }
}
function lengthCheck(strVal, intMax, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    if (strVal.length > intMax) {
      return strErr + 'は' + intMax + '桁以下で入力してください \n';
    } else {
      return '';
    }
  }
}
function ZenCheck(strVal, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    cnt = 0;
    for (i = 0; i < strVal.length; i++) {
      if (escape(strVal.charAt(i)).length >= 4) {
        cnt += 2;
      } else {
        cnt++;
      }
    }
    if (cnt != strVal.length * 2) {
      return strErr + 'は全角（2バイト文字）で入力してください \n';
    } else {
      return '';
    }
  }
}
function HanCheck(strVal, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    cnt = 0;
    for (i = 0; i < strVal.length; i++) {
      if (escape(strVal.charAt(i)).length >= 4) {
        cnt += 2;
      } else {
        cnt++;
      }
    }
    if (cnt != strVal.length) {
      return strErr + 'は半角（1バイト文字）で入力してください \n';
    } else {
      return '';
    }
  }
}
function numberTypeCheck(strVal, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    if (isNaN(strVal)) {
      return strErr + 'は数値で入力してください \n';
    } else {
      return '';
    }
  }
}
function dateTypeCheck(strVal, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    var objReg = new RegExp('^[0-9]{4}/[0-9]{2}/[0-9]{2}$', 'gi');
    if (!objReg.test(strVal)) {
      return strErr + 'は日付形式で入力してください \n';
    } else {
      var strYear = strVal.substring(0, 4);
      var strMonth = strVal.substring(5, 7);
      var strDay = strVal.substring(8, 10);
      var tmpDat = new Date(strYear, strMonth - 1, strDay);
      if (
        strYear != tmpDat.getFullYear() ||
        strMonth - 1 != tmpDat.getMonth() ||
        strDay != tmpDat.getDate()
      ) {
        return strErr + 'は日付形式で入力してください \r';
      } else {
        return '';
      }
    }
  }
}
function rangeCheck(strVal, intMax, intMin, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    if (isNaN(strVal)) {
      return strErr + 'は数値で入力してください \n';
    } else {
      intVal = parseInt(strVal, 10);
      if (intVal < intMin || intVal > intMax) {
        return strErr + 'は' + intMin + '以上、かつ' + intMax + '以下で入力してください \n';
      } else {
        return '';
      }
    }
  }
}
function regExCheck(strVal, strPtn, strErr) {
  if (strVal == '' || strVal == undefined) {
    return '';
  } else {
    var objReg = new RegExp(strPtn, 'gi');
    if (!objReg.test(strVal)) {
      return strErr + 'を正しい形式で入力してください \n';
    } else {
      return '';
    }
  }
}
