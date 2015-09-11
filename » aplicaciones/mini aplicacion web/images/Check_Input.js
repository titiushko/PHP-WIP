// change this to true if you need a debug alert report
var debugging = false;

function check_pwd_eq(element1,element2,errmsg)
{
	if (element1.value == element2.value)
		{
		return true;
		}
	else
		{
		//window.alert("Incorrect password, please input again!");
		window.alert(errmsg);
		//element1.value="";
		//element2.value="";
		//element1.focus();
		//element1.blur();
		element1.select();
		return false;
		}
}

//validate name for address,service,zone,user...
function checkname(field,err_blank,err_invalid)
{
	left_trim(field);
	right_trim(field);

	if (field.value =="" | field.value == null)
	{
		//window.alert("name is required!");
		window.alert(err_blank);
		field.focus();
		field.select();
		return false;
	}
	
	
	if (checkOtherChar(field.value, err_invalid)==false)
	{
		field.focus();
		field.select();
		return false;
	}
	return true;
}
       
//check if a field is blank, if it is, then display prompt message
function checkvoid(field,err_msg)
{
  if (field.value == "" || field.value == null)
  {
   window.alert(err_msg);
   field.focus();
   return false;
  }
  return true;
}

function check_pppoe_auth(uname, passw, uname_err, passw_err)
{
  if (uname.match(/[^ -~]+/)) {
    alert(uname_err);
    return false;
  }

  if (passw.match(/[^ -~]+/)) {
    alert(passw_err);
    return false;
  }
  return true;
}

function leftTrim(str) {
	var index = 0;
	while (str.charAt(index) == ' ') {
		index ++;
	}
	return str.substring(index, str.length);
}

function rightTrim(str) {
	var index = str.length;
	while (str.charAt(index - 1) == ' ') {
		index --;
	}
	return str.substring(0, index);
}

function fullTrim(str) {
	leftTrim(rightTrim(str));
}

function left_trim(field)
{
 var tmp_string = field.value;
 while (''+tmp_string.charAt(0) == ' ')
 tmp_string = tmp_string.substring(1,tmp_string.length);

 field.value = tmp_string;
 
}

function right_trim(field)
{
 var tmp_string = field.value;

 while (''+tmp_string.charAt(tmp_string.length-1) == ' ')
 tmp_string = tmp_string.substring(0,tmp_string.length-1);

 field.value = tmp_string;
}

function trimSpace(obj)
{
    left_trim(obj);
    right_trim(obj);
}

function populate(f_year,f_mon,f_day) 
{
  timeA = new Date(f_year.value, f_mon.options[f_mon.selectedIndex].value,1);
  timeDifference = timeA - 86400000;
  timeB = new Date(timeDifference);
  var daysInMonth = timeB.getDate();


  for (var i = 0; i < f_day.length; i++) 
  {
   f_day.options[i] = null;
  }
  
  for (var i = 0; i < daysInMonth; i++) {
    if (i<9)
      f_day.options[i] = new Option('0'+(i+1));
    else
      f_day.options[i] = new Option(i+1);
  }
  f_day.options[0].selected = true;
}

//Add the selected items from the source to destination list
function addSrcToDestList(srcList,destList)
{
 var len=destList.length;   
 var i;
 var found;

 for (i=0; i < srcList.length; i++) {
	if ((srcList.options[i] != null) && (srcList.options[i].selected)) {
	   found = false;
	   for (var count=0; count < len; count++){
		if (destList.options[count] != null) {
		   if (srcList.options[i].text == destList.options[count].text) {
			found = true;
			break;
			} //end if
		   } // end if
	   }
	if (found != true) {
	  destList.options[len] = new Option(srcList.options[i].text);
	  srcList.options[i].className = "grey";
	  
	  len++;
	  } //end if
	} //end if
 } //end for
}

//delete from the destination list.
function deleteFromDestList(srcList,destList)
{
 var len = destList.options.length;
 var lensrc = srcList.length;
 var i;
 var d;

 if (destList.selectedIndex == -1) return;
 if (destList.options[destList.selectedIndex].id == "sep_dst_0") return;
 if (destList.options[destList.selectedIndex].id == "sep_dst_1") return;

 for (i=(len-1); i >=0; i--) {
   if ((destList.options[i] != null ) && (destList.options[i].selected == true)) {
	for (d=0; d < lensrc; d++) {
	     if (srcList.options[d].text == destList.options[i].text) {
	         	  srcList.options[d].className = "normal";
		}
	} //end for
	destList.options[i] = null;
	} // end if
   } // end for
}

function catValue(oTable)
{
 var CountRows = oTable.rows.length - 5;
 var oProtocol1, oProtocol2;
 var oPort1;
 var oPort2;
 var oPort3;
 var oPort4;
 var value1 = "";
 var value2 = "";
 var i;

 for(i=0; i<CountRows; i++){
    oProtocol1 = eval("document.getElementsByName('transport" + i +"')").item(0);
    oProtocol2 = eval("document.getElementsByName('transport" + i +"')").item(1);
    oPort1 = eval("document.getElementsByName('dlow" + i + "')").item(0);
    oPort2 = eval("document.getElementsByName('dhigh" + i + "')").item(0);
    oPort3 = eval("document.getElementsByName('slow" + i + "')").item(0);
    oPort4 = eval("document.getElementsByName('shigh" + i + "')").item(0);

    if (oProtocol1.checked == true){
        if (value1 == ""){
		value1 = value1 + "TCP/";
	}
	else{
		value1 = value1 +",";
	}
	if (oPort1.value == oPort2.value){
		value1 = value1 + oPort1.value;
        }
	else{
		value1 = value1 + oPort1.value + "-" + oPort2.value;
	}
	if (oPort3.value == oPort4.value){
		value1 = value1 + ":"+ oPort3.value;
        }
	else{
		value1 = value1 + ":"+ oPort3.value + "-" + oPort4.value;
	}
    }
    if (oProtocol2.checked == true){
	if (value2 == ""){
		value2 = value2 + "UDP/";
	}
	else{
		value2 = value2 +",";
	}

	if (oPort1.value == oPort2.value){
		value2 = value2 + oPort2.value;
        }
	else{
		value2 = value2 + oPort1.value + "-" + oPort2.value;
	}
	if (oPort3.value == oPort4.value){
		value2 = value2 + ":"+ oPort3.value;
        }
	else{
		value2 = value2 + ":"+ oPort3.value + "-" + oPort4.value;
	}
    }
  }

    document.forms[0].srv_value1.value = value1;
    document.forms[0].srv_value2.value = value2;
}

function verifyport(cntrl,errmsg1,errmsg2)
    {
    	var	val = 0;

    	port_str = cntrl.value;
	if (port_str == "") {
		//window.alert("Port can not be empty.");
		window.alert(errmsg1);
    		return false;
	}
    	val = toNumber(port_str, 0, port_str.length);

    	if (val <= 0 || val > 65535)
    	{
    	         	
        //        alertWinPort(port_str);
	//window.alert(port_str+ "  is not a valid port.");
		window.alert(port_str+" "+errmsg2);
                cntrl.value = cntrl.defaultValue;
    		return false;
    	}
    	else
    	{
    		return true;
    	}
    }

function cmpport(cntrl1, cntrl2,errmsg)
{
    	var low, high;
    
    	low = toNumber(cntrl1.value, 0, cntrl1.value.length);
    	high = toNumber(cntrl2.value, 0, cntrl2.value.length);
	if (low > high)
	{
         //       window.alert("Low port value cannot be greater than high port value");
                window.alert(errmsg);
                cntrl1.value = cntrl1.defaultValue;
                cntrl2.value = cntrl2.defaultValue;
    		return false;
	}
    	else
    	{
    		return true;
    	}

}

function toNumber(str, start, end)
{
	var tempVal = 0;
    	
	for (i=start; i < end; i++) 
    	{
    		c = str.charAt(i);
    		if (c < '0' || c > '9')
    			return -1;
    
    		tempVal = tempVal * 10 + (c - '0');
    	}
    
    	return tempVal;
}

function alertWinPort(port)
{
	window.alert(port+ "  is not a valid port.");
}

function  checkOtherChar(str,errmsg) {
       for(var loop_index=0; loop_index<str.length; loop_index++)  
       {  
         if(str.charAt(loop_index) == '<'   
           ||str.charAt(loop_index) == '>'  
           ||str.charAt(loop_index) == '('  
           ||str.charAt(loop_index) == ')'  
           ||str.charAt(loop_index) == '#'  
           ||str.charAt(loop_index) == '"'  
           ||str.charAt(loop_index) == '\'')  
          {  
            alert(errmsg);
            return false;  
   	   }  
         }//end of for(loop_index)  
      return true;
   }

function  checkLegalChar(str,errmsg) {
    var c;
    for(var loop_index=0; loop_index<str.length; loop_index++)  
    {  
	c=str.charCodeAt(loop_index);
        if((c<48 && c!=45)||
	   (c>57 && c<65) ||
	   (c>90 && c<97 && c!=95) ||
	   (c>122))
	{  
            alert(errmsg);
            return false;  
   	}  
     }//end of for(loop_index)  
     return true;
}



  function checkDigitalChar(cntrl,errmsg1,errmsg2)
  {
    var str;
    str = cntrl.value;
    if(str.length==0)
    {
       //alert("Input is blank, please re-input.");
       alert(errmsg1);
       return false;
    }
    for(var loop_index=0; loop_index<str.length; loop_index++)
    {
      if(str.charAt(loop_index) == '0' 
         ||str.charAt(loop_index) == '1'
         ||str.charAt(loop_index) == '2'
         ||str.charAt(loop_index) == '3'
         ||str.charAt(loop_index) == '4'
         ||str.charAt(loop_index) == '5'
         ||str.charAt(loop_index) == '6'
         ||str.charAt(loop_index) == '7'
         ||str.charAt(loop_index) == '8'
         ||str.charAt(loop_index) == '9')
          continue;
      else
         {
           //alert("Valid characters are 0-9. Please re-input.");
           alert(errmsg2);
           return false;
  	 }
    }
    return true;
  }
   
function check_pwd(field,errmsg1,errmsg3)
{

  if (field.value == "") {
      window.alert(errmsg1);
      field.focus();
      return false; 
	}
  if (field.value.length < 6) {
      window.alert(errmsg3);
	 }

  return true;
}

function  checkSpace(str,errmsg) {
    if (str.indexOf(" ")>=0) {
            alert(errmsg);
            return false;  
    }
    return true;
}

function checkMail(obj)
{
    if (obj == null)
	return "NULL";
    if (obj.value == "")
	return "EMPTY";
    //var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]))/;
    if (filter.test(obj.value)) 
	return "VALID";
    else 
	return "INVALID";
}

function getScrollX()
{
    if (document.all)
	return document.body.scrollLeft;
    else
	return pageXOffset;
}

function getScrollY()
{
    if (document.all)
	return document.body.scrollTop;
    else
	return pageYOffset;
}

function check_banphrase(str) {

	var idx = 0;
	var inquote = 0;
	var lang = 1;
	var ret = true;

	while (idx < str.length) {

		// alpha, digits, spaces, tags, and + chars allowed.
		if (str.charAt(idx) == '+' || str.charAt(idx) == ' ' || 
		    str.charAt(idx) == '\t' || isalnum(str.charAt(idx))) {
			idx++;
			continue;
		}
		// double quotes allowed too.

		if (str.charAt(idx) == '"') {
			inquote = !inquote;
		// if & then make sure it's an unicode character.
		} else {
			ret = false; // CFG_ER_BANWORD_INVALID;
			break;
		}

		idx ++;
	}

	if ((inquote == 1) && (ret == true)) {
		ret = false;
	}

	return ret;
}

function isdigit(ch) {
	chCode = ch.charCodeAt(0);
	if (((chCode>=48)&&(chCode<=57))) {
		return true;
	} else {
		return false;
	}
}

function isalnum(ch) {
	chCode = ch.charCodeAt(0);
	if (((chCode>=97)&&(chCode<=122)) || ((chCode>=65)&&(chCode<=90)) || 
((chCode>=48)&&(chCode<=57)) || chCode>127) {
		return true;
	} else {
		return false;
	}
}

function checkAll(field, checkValue) {
	for (i = 0; i < field.length; i++) {
		field[i].checked = checkValue;
	}
}

var ns6=document.getElementById&&!document.all
var ie4=document.all&&navigator.userAgent.indexOf("Opera")==-1

function change_icon(object)
{

    //image = ie4?object.firstChild.firstChild:object.firstChild.nextSibling.firstChild.nextSibling; 
    image = object;
    var strArr = image.src.split("/");
    var imgsrc = strArr[strArr.length-1];
    if (imgsrc == "twistie_collapsed.gif")
        image.src = "/theme/images/twistie_expanded.gif";
    else
        image.src = "/theme/images/twistie_collapsed.gif";

    return;
}

function tree_control(obj)
{
    change_icon(obj);
    //obj = ie4?obj.nextSibling:obj.nextSibling.nextSibling;
    obj = ie4?obj.parentNode.parentNode.nextSibling:obj.parentNode.parentNode.nextSibling.nextSibling;
    if (obj){
    while (obj && ((obj.className=="odd") || (obj.className=="category")))
    {
        obj.style.display= (obj.style.display=="")?"none" :"";
        obj = obj.nextSibling;
    }
    }
}

function toggleSection(obj) {
	image = obj.firstChild.firstChild;

	obj = ie4 ? obj.nextSibling : obj.nextSibling.nextSibling;

	if (obj) {
		if (obj.style.display == "") {
			obj.style.display =  "none";
			image.src = "/theme/images/twistie_collapsed.gif";
		} else {
			obj.style.display = "";
			image.src = "/theme/images/twistie_expanded.gif";
		}
	}
}

function verifyMetric(m, errmsg)
{
    var	val = 0;

    var mstr = m.value;
    if (mstr== "")
    {
        window.alert(errmsg);
    	return false;
    }
    val = toNumber(mstr, 0, mstr.length);

    if (val <= 0 || val > 16)
    {
        window.alert(errmsg);
    	return false;
    }
    else return true;
}

function addSrcToDestGroup(srcList,destList, sep_idx)
{
 var len=destList.length;   
 var src_click;
 var dest_sep_idx = 0;
 var i;

 if (srcList.selectedIndex == 0) return;
 if (srcList.options[srcList.selectedIndex].id == "sep_src") return;
 if (srcList.options[srcList.selectedIndex].className == "grey") return;

 src_click = srcList.options[srcList.selectedIndex];
 destList.options[len] = new Option();


 if (src_click.value > sep_idx)
 {
     //user on servers, append to the list 
     destList.options[len].text = src_click.text;
 }
 else
 {
     //local user, be added in front of separtor
     for (i=0; i < len; i++)
     {
         //find out the index of '---users on servers---' in destination list
         if (destList.options[i].value == sep_idx)
         {
             dest_sep_idx = i;
             break;
         }
     }
     if (dest_sep_idx <= 0) return;
     for (var count=len; count >0 ; count--)
     {
         if ((count-1) > dest_sep_idx)
         {
              destList.options[count].text = destList.options[count-1].text;
         }
         else if ((count-1) == dest_sep_idx)
         {
              destList.options[count].text = destList.options[count-1].text;
              destList.options[count].value = destList.options[count-1].value;
              destList.options[count].id = destList.options[count-1].id;
              count--;
              destList.options[count].text = src_click.text;
              destList.options[count].value = null;
              destList.options[count].id = null;
              break;
         }
     }
 }
 src_click.className = "grey";
}
