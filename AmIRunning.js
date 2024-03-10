var working;

function Change(x)
{
    working = x;
}
function Effect()
{
    if (working ) 
    {
        document.getElementById("anamorphButton").value = "Running";
    } 
    else
    {
        document.getElementById("anamorphButton").value = "Create Anamorphic Video";
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
	//Anamorphiser(); dont know why this line was here but wasn't doing anything anyway
	Effect();
}
