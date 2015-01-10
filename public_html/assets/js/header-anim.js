(function($) {  
        var x = 0;
        var y = 0;
        var number = 1 + Math.floor(Math.random() * 2);
        setInterval(function(){
            y--;
            
            if(number==1){
            	x--;
            }
            else{
            	x++;
            }
            $('#animate-area').css('background-position',  x + 'px' + ' ' + y + 'px' );
        }, 90);

})(jQuery); 