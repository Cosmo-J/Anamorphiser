var working;

function Change(x)
{
    working = x;
}
function Effect()
{
    if (working ) 
    {
        document.getElementById("anamorphButton").nodeValue.replace("Running");
    } 
    else
    {
        document.getElementById("anamorphButton").nodeValue.replace("Create Anamorphic Video");
    }
}

function Anamorphise() 
{
    var jqXHR = $.ajax({
        type: "POST",
        url: "/workspace/Splicer.py",
        async: false,
        data: { param: input }
    });
}

function someFunc() 
{
	console.log("HI");
	Anamorphiser();
	Effect();
}
