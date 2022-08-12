function requiredCheck(strVal,strErr) {
	if(strVal=="" || strVal==undefined){
		return strErr + "��ɬ�����ϤǤ� \n";
	}else{
		return "";
	}
}
function requiredRadioCheck(objElm,strErr) {
	flag=false;
	for(i=0;i<objElm.length;i++){
		if(objElm[i].checked){flag=true;}
	}
	if(!flag){
		return strErr + "��ɬ�����ϤǤ� \n";
	}else{
		return "";
	}
}
function lengthCheck(strVal,intMax,strErr) {
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		if(strVal.length>intMax){
			return strErr + "��" + intMax + "��ʲ������Ϥ��Ƥ������� \n"
		}else{
			return "";
		}
	}
}
function ZenCheck(strVal,strErr){
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		cnt=0;
		for(i=0;i<strVal.length;i++){
			if(escape(strVal.charAt(i)).length>=4){
				cnt+=2;
			}else{
				cnt++;
			}
		}
		if(cnt!=strVal.length*2){
			return strErr + "�����ѡ�2�Х���ʸ���ˤ����Ϥ��Ƥ������� \n";
		}else{
			return "";
		}
	}
}
function HanCheck(strVal,strErr){
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		cnt=0;
		for(i=0;i<strVal.length;i++){
			if(escape(strVal.charAt(i)).length>=4){
				cnt+=2;
			}else{
				cnt++;
			}
		}
		if(cnt!=strVal.length){
			return strErr + "��Ⱦ�ѡ�1�Х���ʸ���ˤ����Ϥ��Ƥ������� \n";
		}else{
			return "";
		}
	}
}
function numberTypeCheck(strVal,strErr){
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		if(isNaN(strVal)){
			return strErr + "�Ͽ��ͤ����Ϥ��Ƥ������� \n";
		}else{
			return "";
		}
	}
}
function dateTypeCheck(strVal,strErr){
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		var objReg=new RegExp("^[0-9]{4}/[0-9]{2}/[0-9]{2}$","gi");
		if(!objReg.test(strVal)){
			return strErr + "�����շ��������Ϥ��Ƥ������� \n";
		}else{
			var strYear =strVal.substring(0,4);
			var strMonth=strVal.substring(5,7);
			var strDay  =strVal.substring(8,10);
			var tmpDat  =new Date(strYear,strMonth-1,strDay);
			if(strYear!=tmpDat.getFullYear() || strMonth-1!=tmpDat.getMonth() || strDay!=tmpDat.getDate()){
				return strErr + "�����շ��������Ϥ��Ƥ������� \r";
			}else{
				return "";
			}
		}
	}
}
function rangeCheck(strVal,intMax,intMin,strErr){
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		if(isNaN(strVal)){
			return strErr + "�Ͽ��ͤ����Ϥ��Ƥ������� \n";
		}else{
			intVal=parseInt(strVal,10);
			if(intVal<intMin || intVal>intMax){
				return strErr + "��" + intMin + "�ʾ塢����" + intMax + "�ʲ������Ϥ��Ƥ������� \n";
			}else{
				return "";
			}
		}
	}
}
function regExCheck(strVal,strPtn,strErr){
	if(strVal=="" || strVal==undefined){
		return ""
	}else{
		var objReg=new RegExp(strPtn,"gi");
		if(!objReg.test(strVal)){
			return strErr + "�����������������Ϥ��Ƥ������� \n";
		}else{
			return "";
		}
	}
}
