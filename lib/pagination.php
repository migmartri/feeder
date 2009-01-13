<?
/*
 * Implementación para mostrar un límite de resultados por página
 */

class Pagination {
  //Sql
  var $sql;
  //Número de elementos por página
  var $per_page;
  //Número total de páginas
  var $total_pages;
  //Página actual
  var $current_page;

  /* Constructor
   * @total_elements Numero total de resultados a mostrar.
   * @per_page En cada página mostraremos este numero de resultados.
   * @current_page Página actual del total de páginas de resultados.
   * @sql Cadena de consulta sql. FIXME
   */
  function Pagination($total_elements, $per_page, $current_page, $sql){
    $this->per_page = $per_page;
    $this->sql = $sql;
    $this->total_pages = ceil($total_elements/$per_page);
    $this->current_page = $current_page;
  }

  /* Número de elementos de la página x
   */
  function getElements(){
    $conn = new Sgbd();
    $offset = ($this->per_page * $this->current_page) - $this->per_page;
    $page_sql = " LIMIT $offset, ".$this->per_page;
    $this->sql.= $page_sql;
    return $conn->findBySql($this->sql);
  }
  
  /* Construye una cadena de números de página que son enlaces. 
   */
  function paginationLinks(){
    $res = "<div class='pagination'>";
		$res .= "  Páginas: ";
    foreach(range(1, $this->total_pages) as $page_num){
      //Solo mostramos números si hay más de una página
      if($this->total_pages > 1)
      {
        if($this->current_page == $page_num){
          $res.= "  <b>$page_num</b> ";
        }else{
          $params = self::calculateParams($page_num);
          $res.= "  <a href=\"$params\">$page_num</a>  ";
        }
      }
    }
		$res.= "</div>";
		$res.= "<div class='clear'></div>";
		if($this->total_pages > 1) {
			return $res;
		} else {
			return "";
		}
  }

  /* Esta función calcula los parametros a enviar, 
   * conservando los que tenía y recalculando el page.
   */
  function calculateParams($page_num){
    $res = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . '?';
    foreach($_GET as $key => $value){
      if($key != "page"){
        $res.= "$key=$value&amp;";
      }
    }
    return $res .= "page=".$page_num;
  }
}
?>
