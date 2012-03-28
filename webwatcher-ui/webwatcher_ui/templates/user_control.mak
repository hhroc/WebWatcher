<div id="int_div">
% if not tmpl_context.identity:
<form action="/login_handler?__logins=0&amp;came_from=%2F" enctype="multipart/form-data" method="post">
<table class="right">
    <tr id="login:container">
        <th>Login</th>
        <td >
            <input name="login" type="text" id="login" class="text ui-widget-content"/>
        </td>
    </tr>
    <tr id="password:container">
        <th>Password</th>
        <td >
            <input class="text ui-widget-content" type="password" name="password" id="password"/>
        </td>
    </tr>
    <tr id="loginremember:container">
        <th>Remember</th>
        <td >
            <input name="loginremember" type="checkbox" class="ui-widget-content" id="loginremember"/>
        </td>
    </tr>
	<tr id="buttons">
		<td colspan="2"><input id="login:submit" type="submit" value="Login"/></td>
</table>
</form>
<script type="text/javascript">
	$("#login\\:submit").button();
</script>
% else:
	<p class="left">Welcome back, ${tmpl_context.identity['user'].display_name}</p>
% endif
</div>
