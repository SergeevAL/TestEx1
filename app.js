
var key = {};
key [37] = 'Cтрелка влево';
key [38] = 'Cтрелка вверх';
key [39] = 'Cтрелка вправо';
key [40] = 'Cтрелка вниз';

$(document).keydown(function(eventObject){

  if ((eventObject.which >= 37) & (eventObject.which <= 40) )
    {
      alert('Клавиша клавиатуры приведена в нажатое состояние. Код вводимого символа - ' + key[eventObject.which]);
    }
});