/*
 * Copyright 2013 Artur Leinweber Date: 2013-01-01
 */
function playMatchFoundSound() {
        var mySound = new buzz.sound([ "files/sound/matchReadySound.ogg", "files/sound/matchReadySound.mp3", "files/sound/matchReadySound.wav", "files/sound/matchReadySound.aac" ]);
        mySound.play();
        mySound.setVolume(100);
}