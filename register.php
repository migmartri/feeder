<? include_once("templates/header.php") ?>

<div id="div_form">
  <form action="checkRegister.php" method="post">
    <div id="div_datos_personales">
      <fieldset>
        <legend>Datos personales</legend>

        <div id="div_login">
          <label id="label_login" for="login">Login:</label>
          <input id="login" name="login" type="text"/>
        </div>

        <div id="div_password">  
          <label id="label_password" for="password">Password:</label>
          <input id="password" name="password" type="password"/>
        </div>

        <div id="div_repassword">  
          <label id="label_repassword" for="repassword">Re-Password:</label>
          <input id="repassword" name="repassword" type="password" onChange="checkPassword()"/>
        </div>

        <div id="div_email">  
          <label id="label_email" for="email">Email:</label>
          <input id="email" name="email" type="text" onChange="checkEmail(this.form.email.value)"/>
        </div>
      </fieldset>
    </div>
    <div id="div_submit">
      <button id="submit">¡Regístrate!</button>
    </div>
  </form>
</div>

<? include_once("templates/footer.php");?>
