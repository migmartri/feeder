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
          $("post_content_"+post_id).innerHTML = request.responseText;      
        }
      });
}

//Añadimos un post a nuestros favoritos
function setFavourite(post_id){
  new Ajax.Request('/controllers/createFavourite.php', 
      { method: 'post',
        parameters: {post_id : post_id},
        onSuccess: function(request){
          var html = "Ya es tu favorito";
          html += "(<a href='#' onclick='destroyFavourite(" + post_id + "); return false;' title='Quitar de favoritos'>Quitar</a>)";
          $("favourite_"+post_id).innerHTML = html;
        },
        onFailure: function(){
          $("favourite_"+post_id).innerHTML = "Error al crear el favorito";     
        }
      });
}
//
//Añadimos un post a nuestros favoritos
function destroyFavourite(post_id){
  new Ajax.Request('/controllers/destroyFavourite.php', 
      { method: 'post',
        parameters: {post_id : post_id},
        onSuccess: function(request){
          $("favourite_"+post_id).innerHTML = "<a href='#' onclick='setFavourite(" + post_id + "); return false;' title='Añadir a favoritos este post'> + Favoritos </a>";     
        },
        onFailure: function(){
          $("favourite_"+post_id).innerHTML = "Error al eliminar el favorito";     
        }
      });
}
