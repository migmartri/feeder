//Petición ajax que se encarga de traer el contenido completo de una entrada de un feed.
//ésta sustituirá la descripción existente.
function getPostContent(post_id){
  new Ajax.Request('/controllers/postContent.php', 
      { method: 'post',
        parameters: {id : post_id},
        onLoading:function(){
          $("post_more_"+post_id).innerHTML = '<img src="/images/spinner.gif" alt="spinner"></div>';
        }, 
        onSuccess: function(request){
          $("post_content_"+post_id).innerHTML = request.responseText;         /* $(spinner).hide(); */
        }
      });
}
//Añadimos un post a nuestros favoritos
function setFavourite(post_id){
  new Ajax.Request('/controllers/createFavourite.php', 
      { method: 'post',
        parameters: {post_id : post_id},
        onLoading:function(){
          /* $("post_more_"+post_id).innerHTML = '<img src="/images/spinner.gif" alt="spinner"></div>'; */
        }, 
        onSuccess: function(request){
          $("post_content_"+post_id).innerHTML = request.responseText;         /* $(spinner).hide(); */
        }
      });
}
