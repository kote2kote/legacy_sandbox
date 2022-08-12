<!DOCTYPE html>
<html lang="ja">
<head>
<title>{$title}</title>
</head>
<body>
<div style="text-align:center;">
<hr>
<strong>{$title}</strong>
<hr>
    <table>
      <tr>
      <td style="vertical-align:top;">
      	[ <a href="{$SCRIPT_NAME}?type=logout">ログアウト</a> ]
	<br>
	<br>
	{$disp_login_state}

      </td>
        <td style="vertical-align:top;">
        <div style="text-align: left; margin-left:15px;">
        {if ($body)}
        <div style="border: dashed 1px;padding: 10px;">
            <div style="font-size:small; font-weight: bold;">お知らせ</div>
            <div style="font-size:small; font-weight: bold;">
                {$reg_date|date_format:"%Y年%m月%d日"} {$subject|escape:"html"}
            </div>
            <div style="font-size:small;">{$body|escape:"html"} </div>
        </div>
        {/if}
          <br>
          <br>
          {$last_name|escape:"html"} {$first_name|escape:"html"} さん、こんにちは！
          <br>
          <br>
	        <a href="{$SCRIPT_NAME}?type=modify&action=form">会員登録情報の修正</a>
          <br>
          <br>
	        <a href="{$SCRIPT_NAME}?type=delete&action=confirm">退会する</a>
          <br>

        </div>
        </td>
      </tr>
    </table>
</div>
{if ($debug_str)}<pre>{$debug_str}</pre>{/if}
</body>
</html>
