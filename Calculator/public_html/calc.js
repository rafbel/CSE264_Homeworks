/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Stack variables
var topStack = "Error"; //Error means they dont have values yet
var lowStack = "Error";
var replaceDisplay = 0; //if next input should replace display number (1), if not(0)
var hasInput = 0; //if user used calculator since push or operation (1), if not (0)
var hasDot = 0; //checks if dot has already been placed


//changes screen depending on the button pressed (number only)
function addNumber(button_id)
{
    var button,inputElement;
    
    button = document.getElementById(button_id);
    
    inputElement = document.getElementById("numberText");
    
    if (hasInput === 0)
        hasInput = 1;
    
    if ( inputElement.value === "0" || replaceDisplay === 1)
    {
        replaceDisplay = 0;
        inputElement.value = button.value;
    }
    else
        inputElement.value += button.value;
}

function addDot()
{
    if (hasDot === 0)
    {
        var inputElement = document.getElementById("numberText");
        if (replaceDisplay === 1)
        {
            replaceDisplay = 0;
            inputElement.value = "0.";
        }
        else
        {
            inputElement = document.getElementById("numberText");

            inputElement.value += ".";
            hasDot = 1;
        }
    }
}

function pushStack()
{
    var inputElement = document.getElementById("numberText");
    
    topStack = lowStack;
    lowStack = inputElement.value;
    
    inputElement.value = "0";
    hasInput = 0;
    hasDot = 0;
}

function addStack()
{
    var result;
    var inputElement = document.getElementById("numberText");
    
    result = parseFloat(inputElement.value);
    if (hasInput === 1 && result < 0)
    {
            result *= -1;
            inputElement.value = result.toString();
    }
    else
    {
        if (topStack === "Error" || lowStack === "Error")
        {
            inputElement.value = "Error";
            topStack = "Error";
            lowStack = "Error";
            hasDot = 0;

        }

        else 
        {
            result = parseFloat(lowStack) + parseFloat(topStack);
            topStack = lowStack;
            lowStack = result.toString();

            inputElement.value = result.toString();
            hasDot = 0;

        }
        replaceDisplay = 1;
        hasInput = 0;
    }
    
}

function subStack()
{
    var result;
    var inputElement = document.getElementById("numberText");
    
    
    result = parseFloat(inputElement.value);
    if (hasInput === 1 && result > 0)
    {
       
            result *= -1;
            inputElement.value = result.toString();
    }
    else
    {
        if (topStack === "Error" || lowStack === "Error")
        {
            inputElement.value = "Error";
            topStack = "Error";
            lowStack = "Error";
            hasDot = 0;

        }

        else 
        {

            result = parseFloat(topStack) - parseFloat(lowStack);
            topStack = lowStack;
            lowStack = result.toString();

            inputElement.value = result.toString();
            hasDot = 0;

        }
        replaceDisplay = 1;
        hasInput = 0;
    }
}

function multStack()
{
    var result;
    var inputElement = document.getElementById("numberText");
    if (topStack === "Error" || lowStack === "Error")
    {
        inputElement.value = "Error";
        topStack = "Error";
        lowStack = "Error";
        
        
    }
        
    else 
    {
        result = parseFloat(topStack) * parseFloat(lowStack);
        topStack = lowStack;
        lowStack = result.toString();

        inputElement.value = result.toString();
        
    }
    replaceDisplay = 1;
    hasDot = 0;
    hasInput = 0;
}

function divStack()
{
    var result;
    var inputElement = document.getElementById("numberText");
    
    if (topStack === "Error" || lowStack === "Error" || lowStack === "0")
    {
        inputElement.value = "Error";
        topStack = "Error";
        lowStack = "Error";
        
    }
        
    else 
    {
        result = parseFloat(topStack)/parseFloat(lowStack);
        topStack = lowStack;
        lowStack = result.toString();

        inputElement.value = result.toString();
        
    }
    replaceDisplay = 1;
    hasDot = 0;
    hasInput = 0;
}

function clearCalculator()
{
    var inputElement = document.getElementById("numberText");
    
    lowStack = "Error";
    topStack = "Error";
    
    inputElement.value = "0";
    hasDot = 0;
}