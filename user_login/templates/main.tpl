{extends file="layout.tpl"}

{block name=body}
  <h2>{$hi}, {$session_user}!</h2>
  {if (!empty($avatar))}
    <img src="storage/{$session_user}/{$avatar}">
  {else}
    <img src="storage/ava_bin.jpg" alt="ava_bin">
  {/if}
{/block}
