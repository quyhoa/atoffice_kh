/*
** prototypeライブラリの順番

new XMLHttpRequest()
new ActiveXObject('Msxml2.XMLHTTP')
new ActiveXObject('Microsoft.XMLHTTP')
*/

function GetXHR()
{
	var xhr;
	try
	{
		xhr = new XMLHttpRequest();
	}
	catch (e)
	{
		try
		{
			xhr = new ActiveXObject('Msxml2.XMLHTTP');
		}
		catch (e2)
		{
			try
			{
				xhr = new ActiveXObject('Microsoft.XMLHTTP');
			}
			catch (e3)
			{
				xhr = null;
			}
		}
	}
	return (xhr);
}

function LoadHTML(htmlElemId, url, owari)
{
	var elem1 = document.getElementById(htmlElemId);

	var xhr = GetXHR();

    if (xhr == null)
	{
		elem1.innerText = "Impossible to get XML object.";
    	elem1.style.color = "#FF0000";
	}
	else
	{
	    StartLoadingBar();

		xhr.onreadystatechange = function()
		{
    		var elem2 = document.getElementById(htmlElemId);

    		if (xhr.readyState == 4)
		    {
		        if (xhr.status == 200)
		        {
                    elem2.innerHTML = xhr.responseText;
                    if (owari)
                        owari();
		        }
		        else
		        {
		            elem2.innerText = "Error code " + xhr.status;
		            elem2.style.color = "#FF0000";
		        }
                StopLoadingBar();
		    }
		};
	}

	xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(null);
}

function StartLoadingBar()
{
    var loadingBar = document.getElementById('LoadingBar');
    loadingBar.innerHTML = "<img border=\"0\" src=\"./ranking/images/loading.gif\"/>";
    loadingBar.style.visibility = "visible";
}

function StopLoadingBar()
{
    var loadingBar = document.getElementById('LoadingBar');
    
    // the following trick is to restart GIF animation from zero
    loadingBar.innerHTML = "<img border=\"0\" src=\"\"/>";
    // the following trick is to keep image control size and avoid page movement due to image resize
    loadingBar.innerHTML = "<img border=\"0\" src=\"./ranking/images/loading.gif\"/>";
    loadingBar.style.visibility = "hidden";
}
