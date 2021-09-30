let tracker ='m';

function change (){
    var sound = document.getElementById ('mic');
    if(tracker == 'm'){
        sound.src ="pic/a.png";
        alert('Allow to listen?');
        tracker = 'a';
    }else{
        sound.src="pic/m.png";
        alert('Stop listening?');
        tracker = 'm';
    }
    
}