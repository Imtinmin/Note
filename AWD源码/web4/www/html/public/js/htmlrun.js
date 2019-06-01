// JavaScript Document
var is_ie=document.all;
//运行代码
function runcode(obj) {
var winname=window.open('',"_blank",'');
winname.document.open('text/html','replace');
winname.opener=null;
winname.document.write(obj.value);
winname.document.close();
}
//复制代码
function copycode(obj) {
if(is_ie && obj.style.display!='none') {
var rng=document.body.createTextRange();
rng.moveToElementText(obj);
rng.scrollIntoView();
rng.select();
//or target=obj.createTextRange();
rng.execCommand("Copy");
rng.collapse(false);
}
}
//另存代码
function savecode(obj) {
var winname=window.open('','_blank','top=10000');
winname.document.open('text/html','replace');
winname.document.write(obj.value);
winname.document.execCommand('saveas','','code.htm');
winname.close();
}
//剪切代码
function cutcode(obj) {
if(document.all) { textRange=obj.createTextRange();
textRange.execCommand("cut");
} else {
alert("只支持IE");
}
}
//粘贴代码
function pastecode(obj) {
if(document.all) {
textRange=obj.createTextRange();
textRange.execCommand("paste");
} else {
alert("只支持IE!");
}
}