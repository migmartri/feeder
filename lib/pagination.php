<?
class Pagination{
  //Sql
  var $sql;
  //Número de elementos por página
  var $per_page;
  //Número total de páginas
  var $total_pages;
  //Página actual
  var $current_page;

  function Pagination($total_elements, $per_page, $current_page, $sql){
    $this->per_page = $per_page;
    $this->sql = $sql;
    $this->total_pages = ceil($total_elements/$per_page);
    $this->current_page = $current_page;
  }

  //Elementos de la página x
  function getElements(){
    $conn = new Sgbd();
    $offset = ($this->per_page * $this->current_page) - $this->per_page;
    $page_sql = " LIMIT $offset, ".$this->per_page;
    $this->sql.= $page_sql;
    return $conn->findBySql($this->sql);
  }

  function paginationLinks(){
    $res = "<div id='pagination'>";
    foreach(range(1, $this->total_pages) as $page_num){
      //Solo mostramos números si hay más de una página
      if($this->total_pages > 1)
      {
        if($this->current_page == $page_num){
          $res.= "$page_num ";
        }else{
          $params = self::calculateParams($page_num);
          $res.= "<a href=$params'>$page_num</a>  ";
        }
      }
    }
    return $res.= "</div>";
  }

  //Esta función calcula los parametros a enviar, conservando los que tenía y recalculando el page  
  function calculateParams($page_num){
    $res = '?';
    foreach($_GET as $key => $value){
      if($key != "page"){
        $res.= "$key=$value&";
      }
    }
    return $res .= "page=".$page_num;
  }
}
?>
