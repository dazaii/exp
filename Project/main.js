let tracker ='m';

function change (){
    var sound = document.getElementById ('mic');
    var statusLabel = document.getElementById ('status');
    if(tracker == 'm'){
        sound.src ="pic/a.png";
        alert('Allow to listen?');
        statusLabel.innerHTML = "...Listening...";
        tracker = 'a';
    }else{
        sound.src="pic/m.png";
        alert('Stop listening?');
        statusLabel.innerHTML = "Press to start";
        tracker = 'm';
    }
}