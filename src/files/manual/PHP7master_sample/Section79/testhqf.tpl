<script type="text/javascript" src="js/quickform.js" async></script>
<form {$form.attributes}>
    {$form.hidden}
{if isset($form.name.error) }
    <div style="color: red">{$form.name.error}</div>
{/if}
{$form.name.label}:{$form.name.html}
{$form.submit.html}
</form>
{if isset($form.javascript)}
    {$form.javascript}
{/if}
