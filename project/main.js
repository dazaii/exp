let tracker ='m';

function change (){
    var sound = document.getElementById ('mic');
    var bglayer = document.getElementById ('bglayer');
    var container = document.getElementById ('container');
    var statusLabel = document.getElementById ('status');
    var bars = document.getElementById ('bars');
    if(tracker == 'm'){
        sound.src ="pic/a.png";
        statusLabel.innerHTML = "...Listening...";
        tracker = 'a';
    }else{
        sound.src="pic/m.png";
        statusLabel.innerHTML = "Press to start";
        tracker = 'm';
    }
    bars.classList.toggle('contflex');
    sound.classList.toggle('micdisappear');
    bglayer.classList.toggle('scaleup');
    container.classList.toggle('scaledown');
}