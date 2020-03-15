function showLineNumbers() {
 /************************************ 
 * Written by Andreas Papadopoulos   *
 * http://akomaenablog.blogspot.com  *
 * akoma1blog@yahoo.com              *
 ************************************/
  var isIE = navigator.appName.indexOf('Microsoft') != -1;

  var preElems = document.getElementsByTagName('pre');
  if (preElems.length == 0) return;
  for (var i = 0; i < preElems.length; i++) {
    var pre = preElems[i];
    var oldContent = pre.innerHTML;
    oldContent = oldContent.replace(/ /g,"&nbsp;");
    var strs = oldContent.split("<br>");
    if (isIE) {
       strs = oldContent.split("<BR>");
    }

    oldContent = oldContent.substring(4); //remove the 1st <br>
    var newContent = "<table><tr>";
    newContent += "<td bgcolor='#d4d0c8'>";
    for(var j=1; j < strs.length - 1; j++) {
        newContent += j+".<br>";
    }
    newContent += "</td><td> </td><td>";
    newContent += oldContent;
    newContent += "</td></tr></table>";

    pre.innerHTML = newContent;
  }
}