//Petición ajax que se encarga de 
function getPostContent(post_id){
  new Ajax.Request('/controllers/postContent/', 
      { method: 'get',
        parameters: {id : post_id},
        onSuccess: function(request){
          res = request.responseText;
          window.alert(res);
        }
      });
}
