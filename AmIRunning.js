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