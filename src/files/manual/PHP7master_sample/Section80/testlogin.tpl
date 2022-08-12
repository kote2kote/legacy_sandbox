{$title}
<form {$form.attributes}>
{$form.username.label}:<br>
{$form.username.html}<br>
{$form.password.label}:<br>
{$form.password.html}
<input type="hidden" name="type" value="{$type}">
{$form.submit.html}
</form>