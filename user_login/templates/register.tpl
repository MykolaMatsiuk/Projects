{extends file='layout.tpl'}

{block name=body}
  <h2>Registration form</h2>
  {if isset($smarty.get.msg)}
    <div>MSG: {$smarty.get.msg}</div>
  {/if}
  <form action="index.php?action=register" enctype="multipart/form-data" method="post">
    <input type="text" name="login" placeholder="Enter your login"><br>
    <input type="password" name="pass" placeholder="Enter the password"><br>
    <input type="file" name="logo"><br>
    <input type="submit" value="Register">
  </form>
{/block}
