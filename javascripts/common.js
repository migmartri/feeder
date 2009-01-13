//Petición ajax que se encarga de 
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
