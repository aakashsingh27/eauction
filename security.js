 jQuery(document).ready(function()
{
jQuery(function() 
{
jQuery(this).bind("contextmenu", function(event)
{
event.preventDefault();
/*swal.fire({
title: 'RIGHT CLICK DISABLED',
text: '',
icon: 'error',
backdrop: 'black',
allowOutsideClick: false,
allowEscapeKey: false,});*/
(async () => {

const { value: pswrd } = await Swal.fire({
title: 'ENTER INSPECTION PASSWORD ',
input: 'password',

inputPlaceholder: 'ENTER PASSWORD',
showCancelButton: true,
inputValidator: (value) => {
return new Promise((resolve) => {
if (value === 'Aakash') 
{
resolve()
} 
else
{
resolve('WRONG PASSWORD')
}
}
)
}
}
)
if (pswrd) {
Swal.fire(`CORRECT PASSWORD`)

//return true;
    
}
}
)()
return false;
}
);
}
);
}
);
 document.onkeydown = function(e)
{
//CTRL + U DISABLED CODE START    
if(e.ctrlKey && (e.keyCode === 85)) 
{

return false;
}
//CTRL + U DISABLED CODE END
//CTRL+SHIFT+I (CTRL+SHIFT+J) (CTRL+SHIFT+C)   || (event.ctrlKey && event.shiftKey)  && event.keyCode == 74 DIABLED START 
else if((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.ctrlKey && event.shiftKey && event.keyCode == 67))
{

return false;
}

else if(event.ctrlKey && (e.keyCode === 80))
{

return false;
}


////CTRL+SHIFT+I (CTRL+SHIFT+J) (CTRL+SHIFT+C) DIABLED END

//DISABLED F12 FOR INSPECTION START
else if (event.keyCode == 123)
{

return false;
}

else if (event.keyCode == 93)
{
    
return false;
}

else if (event.keyCode == 13)
{
    
return false;
}

/*else if (event.keyCode == 76)
{
    
return false;
}
*/


//DISABLED F12 FOR INSPECTION END
else
{
return true;
}
};
$(document).keypress("u",function(e) 
{
if(e.ctrlKey)
{
return false;
}
}
);