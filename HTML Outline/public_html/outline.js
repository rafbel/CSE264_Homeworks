/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//var list = $("<ul>");
$(document).ready(function()
{
    var appendText = $("<ul>");
    var item = $("<li>HTML</li>");
    //var newItem = $("<ul><li>Biscoito</li></ul>");
    //item.append(newItem);
    appendText.append(item);
    //list.append($("</ul>"));
    
   
    var elem = $('html');
    
    var elem1 = elem.children().get(0); //this is the head
    console.log(elem1);
    var elem2 = elem.children().get(1); //this is the body
    
    childTraverse(elem1,appendText);
    childTraverse(elem2,appendText);
    
    appendText.append($("</ul>"));
    $('body').append(appendText);
        
});

function childTraverse(elem,appendText)
{
    
    //console.log(elem);
    var item = $("<ul>");
    
    var toInsert = elem.tagName;
    
    if (elem.type !== undefined && elem.type !== "")
    {
        
        toInsert +=  " type (" + elem.type + ")";
    }
    if (elem.src !== undefined && elem.type !== "")
    {
        toInsert += " src (" + elem.src + ")";
    }
    //console.log('<li>' + toInsert + '</li>');
    item.append('<li>' + toInsert + '</li>');
  
    var item2 = $("<ul>");
    for (var counter = 0; counter < elem.children.length; counter++)
    {
        var childElem = elem.children[counter];
        childTraverse(childElem,item);
        
    }
    
    if (elem.children.length === 0)
    {
        item2.append("text (" + elem.innerText + ")");
    }
    
   // item2.text(toInsert);
    //appendText.append(item2); 
    //appendText.append(item2);
    appendText.append(item);
    appendText.append(item2);
    appendText.append($("<ul>"));
    appendText.append($("</ul></ul>"));
    

    
    //console.log(appendText);
}