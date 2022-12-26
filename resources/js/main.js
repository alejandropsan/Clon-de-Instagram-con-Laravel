var url = 'http://proyecto-laravel.com.devel';
window.addEventListener("load", function(){
  
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    
    //boton de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
        console.log("Like");
        $(this).addClass('btn-dislike').removeClass('btn-like');
        $(this).attr('src', url+'/img/heart-red.png');
        
        $.ajax({
           url: url+'/like/'+$(this).data('id'),
           type: 'GET',
           success: function(response){
               if(response.like){
                   console.log("Has dado like a la publicación");
               }else{
                   console.log("Error al darle a like");
               }
           }
        });
        
        dislike();
        });
    }
    like();
   
   
   //boton de dislike
   function dislike(){
       $('.btn-dislike').unbind('click').click(function(){
       console.log("disLike");
      $(this).addClass('btn-like').removeClass('btn-dislike');
      $(this).attr('src', url+'/img/heart-gray.png');
      
      $.ajax({
           url: url+'/dislike/'+$(this).data('id'),
           type: 'GET',
           success: function(response){
               if(response.like){
                   console.log("Has dado dislike a la publicación");
               }else{
                   console.log("Error al darle a dislike");
               }
           }
        });
      
      like();
      });
   }
   dislike();
   
   //BUSCADOR
   $('#buscador').submit(function(){
      $(this).attr('action', url + '/perfiles/' + $('#buscador #search').val());
    });
   
   
   
   
});

