var objSearch;
var objIndex;
var objList;
var descArray;
var indexArray;

function search(searchStr, searchObj, indexObj, listObj, arrayDesc, arrayIndex)
{
     var txt = searchStr;
    
     htmlStr = "";
     str = "";
     sw = 0;

     objSearch = searchObj;
     objIndex = indexObj;
     objList = listObj;
     descArray = arrayDesc;
     indexArray = arrayIndex;

     htmlStr = htmlStr + "<select id=\"searchList\" SIZE=10 onclick=\"selector()\">";

     for (i=0;i<=arrayDesc.length - 1;i++)
     {
          str = arrayDesc[i];

          var pos = str.toLowerCase().indexOf(txt.toLowerCase());
          
          if(pos > -1)
          {
               sw = 1;
               htmlStr = htmlStr + "<OPTION VALUE=" +  arrayIndex[i] + ">" + arrayDesc[i] + "</OPTION>";
          }  
     } 

     htmlStr = htmlStr + "</select>";

     listObj.innerHTML = htmlStr;
}

function selector()
{
//      alert(document.getElementById('searchList').value);
     objIndex.value = document.getElementById('searchList').value;

     for (i=0;i<=descArray.length - 1;i++)
     {
          if(indexArray[i] ==  document.getElementById('searchList').value)
          { 
               objSearch.value = descArray[i];
          }  
     } 

     objList.innerHTML = "";
}

