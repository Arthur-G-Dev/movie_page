window.pressed = function(){
    var file = document.getElementById('file');
    if(file.value === "")
    {
        fileLabel.innerHTML = "Choose file";
    }
    else
    {
        var theSplit = file.value.split('\\');
        console.log(theSplit);
        fileLabel.innerHTML = theSplit[theSplit.length-1];
    }
};