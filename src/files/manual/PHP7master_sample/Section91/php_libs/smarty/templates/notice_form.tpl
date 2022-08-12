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
              <td style="vertical-align:top; text-align:right;">{$form.subject.label}：</td>
              <td style="text-align:left;">
                {if isset($form.subject.error) }
                  <div style="color:red; font-size: smaller;">{$form.subject.error}</div>
                {/if}
                {$form.subject.html}</td>
            </tr>
            <tr>
              <td style="vertical-align:top; text-align:right;">{$form.body.label}：</td>
              <td style="text-align:left;">
                {if isset($form.body.error) }
                  <div style="color:red; font-size: smaller;">{$form.body.error}</div><br>
                {/if}
                {$form.body.html}</td>
            </tr>
            <tr>
            <td>&nbsp; </td>
            <td>
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
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
