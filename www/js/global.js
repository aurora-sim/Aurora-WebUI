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
			if (form.elements[i].attributes["require"].value == "true")
			{
				if (form.elements[i].value == "")
				{
					formproblem(form.elements[i], " is required");
					return false;
				}
			}
		}
	}
	return true;
}

function formproblem(el, message)
{
	if (el.attributes["label"])
	{
		document.getElementById(el.attributes["label"].value).className = "error";
	}
	if (document.getElementById("error_message"))
	{
		document.getElementById("error_message").innerText = el.name + message;
	}
	else
	{
		alert(el.name + message);
	}
}
