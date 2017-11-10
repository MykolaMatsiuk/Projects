{extends file="layout.tpl"}

{block name=body}
  <h2>Login</h2>
  {if isset($smarty.get.msg)}
    <div>MSG: {$smarty.get.msg}</div>
  {/if}
  <form action="index.php?action=login" method="post">
    <input type="text" name="login" placeholder="Enter your login"><br>
    <input type="password" name="pass" placeholder="Enter your password"><br>
    <input type="submit" value="Login">
  </form>
  <form action="index.php?action=register" method="post">
    <input type="submit" value="Register">
  </form>
{/block}
