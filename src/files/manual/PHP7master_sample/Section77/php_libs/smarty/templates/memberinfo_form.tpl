<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
<script type="text/javascript" src="js/quickform.js" async></script>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>
    <table>
      <tr>
      <td style="vertical-align: top;">
	[ <a href="{$SCRIPT_NAME}">トップページへ</a> ]
{if ($is_system) }
	<br><br>
      	[ <a href="{$SCRIPT_NAME}?type=list&action=form{$add_pageID}">会員一覧</a> ]
{/if}
	<br><br>
	{$disp_login_state}
      </td>
      <td>
	{$message}
        <form {$form.attributes}>
          {$form.hidden}
          <table>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.username.label}：</td>
              <td style="text-align:left;">
                {if isset($form.username.error)}
                  <div style="color:red; font-size: smaller;">{$form.username.error}</div>
                {/if}
                {$form.username.html}</td>
            </tr>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.password.label}：</td>
              <td style="text-align:left;">
                {if isset($form.password.error)}
                  <div style="color:red; font-size: smaller;">{$form.password.error}</div>
                {/if}
                {$form.password.html}</td>
            </tr>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.last_name.label}：</td>
              <td style="text-align:left;">
                {if isset($form.last_name.error)}
                  <div style="color:red; font-size: smaller;">{$form.last_name.error}</div>
                {/if}
                {$form.last_name.html}</td>
            </tr>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.first_name.label}：</td>
              <td style="text-align:left;">
                {if isset($form.first_name.error)}
                  <div style="color:red; font-size: smaller;">{$form.first_name.error}</div>
                {/if}
                {$form.first_name.html}</td>
            </tr>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.birthday.label}：</td>
              <td style="text-align:left;">
                {if isset($form.birthday.error)}
                  <div style="color:red; font-size: smaller;">{$form.birthday.error}</div><br>
                {/if}
                {$form.birthday.Y.html}{$form.birthday.m.html}{$form.birthday.d.html}</td>
            </tr>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.ken.label}：</td>
              <td style="text-align:left;">
                {if isset($form.ken.error)}
                <div style="color:red; font-size: smaller;">{$form.ken.error}</div><br>
                {/if}
                {$form.ken.html}</td>
            </tr>
            <tr>
            <td>&nbsp; </td>
            <td>
            {if ( $form.submit2.attribs.value != "" ) }
              {$form.submit2.html}　
            {else}
              {$form.reset.html}　
            {/if}
            {$form.submit.html}
            <input type="hidden" name="type"   value="{$type}">
            <input type="hidden" name="action" value="{$action}">
            </td>
            </tr>
          </table>
          <br>
        </form>
        </td>
      </tr>
    </table>
</div>
{if $form.javascript}
    {$form.javascript}
{/if}
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>