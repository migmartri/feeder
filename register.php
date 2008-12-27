<? 
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
?>
<div id="div_form">
  <form action="controllers/createUser.php" method="post" onsubmit="return validatesRegister();" id="form">
    <div id="div_datos_personales">
      <fieldset>
        <legend>Datos personales</legend>

        <div id="div_login">
          <label id="label_login" for="login">Login:</label>
          <input id="login" name="login" type="text" value="<?=formValue('login')?>"/>
        </div>

        <div id="div_password">  
          <label id="label_password" for="password">Password:</label>
          <input id="password" name="password" type="password"/>
        </div>

        <div id="div_repassword">  
          <label id="label_repassword" for="repassword">Re-Password:</label>
          <input id="repassword" name="repassword" type="password"/>
        </div>

        <div id="div_email">  
          <label id="label_email" for="email">Email:</label>
          <input id="email" name="email" type="text" value="<?=formValue('email')?>"/>
        </div>
      </fieldset>
    </div>
    <div id="div_submit">
      <button id="submit">¡Regístrate!</button>
    </div>
  </form>
</div>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
