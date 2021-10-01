let tracker ='m';

function change (){
    var sound = document.getElementById ('mic');
    var statusLabel = document.getElementById ('status');
    if(tracker == 'm'){
        sound.src ="pic/a.png";
        statusLabel.innerHTML = "...Listening...";
        tracker = 'a';
    }else{
        sound.src="pic/m.png";
        statusLabel.innerHTML = "Press to start";
        tracker = 'm';
    }
}