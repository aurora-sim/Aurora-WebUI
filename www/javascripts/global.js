// form validating
// example of use: <form onsubmit="if (!validate(this)) return false;">
// in the form elements place the attribute "require" to "true" example: require="true"
// remember, client side form validating is not a full solution. Form validation still needs to be done on the server side as well.
// you can also add the attribute "label" and will change that to the error class when a error happens.
function validate(form)
{
	for (i=0; i<form.elements.length; i++) 
	{ 
		if (form.elements[i].attributes["require"])
		{
			if (form.elements[i].attributes["nospecial"])
			{
				if (form.elements[i].attributes["nospecial"].value == "true")
				{                      
					if(form.elements[i].value.match("/[A-Z_a-z_0-9_@]/g").length != form.elements[i].value.length)
					return false;                  
				}
			}
			if (form.elements[i].attributes["require"].value == "true")
			{
				if (form.elements[i].type == "checkbox")
				{
					if (!form.elements[i].checked)
					{
						formproblem(form.elements[i], " is required");
						return false;
					}
				}
				else if (form.elements[i].type == "select-one")
				{
					if (form.elements[i].selectedIndex == 0)
						formproblem(form.elements[i], " is required");
				}
				else if (form.elements[i].value == "")
				{
					formproblem(form.elements[i], " is required");
					return false;
				}
			}
		}
		if (form.elements[i].attributes["minlength"])
		{
			if (new String(form.elements[i].value).length < parseInt(form.elements[i].attributes["minlength"].value))
			{
				formproblem(form.elements[i], " reuires at least " + form.elements[i].attributes["minlength"].value + " charaters.");
				return false;
			}
		}
		if (form.elements[i].attributes["compare"])
		{
			if (form.elements[i].value != document.getElementsByName(form.elements[i].attributes["compare"].value)[0].value)
			{
				formproblem(form.elements[i], " does not match.");
				return false;
			}
		}
		if (form.elements[i].attributes["label"]) removeClass(document.getElementById(form.elements[i].attributes["label"].value), "error");
	}
	return true;
}

function formproblem(el, message)
{
	if (el.attributes["label"])
	{
		document.getElementById(el.attributes["label"].value).className = "error";
		if (document.getElementById("error_message"))
		{
			document.getElementById("error_message").innerText = document.getElementById(el.attributes["label"].value).innerText + message;
			document.getElementById("error_message").scrollIntoView(true);
		}
		else
			alert(document.getElementById(el.attributes["label"].value).innerText + message);
	}
	else
	{
		if (document.getElementById("error_message"))
		{
			document.getElementById("error_message").innerText = el.name + message;
			document.getElementById("error_message").scrollIntoView(true);
		}
		else
			alert(el.name + message);
	}
}

function hasClass(ele,cls) {
	return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
}
function addClass(ele,cls) {
	if (!this.hasClass(ele,cls)) ele.className += " "+cls;
}
function removeClass(ele,cls) {
	if (hasClass(ele,cls)) {
		var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
		ele.className=ele.className.replace(reg,' ');
	}
}

var addEvent = function(elem, type, eventHandle) 
{
	if (elem == null || elem == undefined) return;
	if ( elem.addEventListener ) {
		elem.addEventListener( type, eventHandle, false );
	} else if ( elem.attachEvent ) {
		elem.attachEvent( "on" + type, eventHandle );
	}
};
