<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        ${self.meta()}

		<title>${self.title()}</title>

		<script src="//ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
		<script src="${tg.url('/javascript/pre-load.js')}"></script>

        <meta name="viewport" content="width=device-width,initial-scale=1" />

		<link rel="stylesheet" href="${tg.url('/css/reset.css')}" />
        <link rel="stylesheet" href="${tg.url('/css/style.css')}" />
		<link rel="stylesheet" href="${tg.url('/css/960_grid.css')}" />
    </head>
    <body>
		<div id="container" class="container_12">
			<header>
				<div class="grid_8" id="header_logo">
				</div>
				<div class="grid_4" id="user_control_wrapper">
					<%include file="local:templates.user_control"/> 
				</div>
			</header>
			<div class="clear"> </div>
			<%include file="local:templates.header_tabs"/>
			<div class="clear"> </div>
				${self.body()}
			<div class="clear"> </div>
			<div class="prefix_3 grid_6">
				<p>Footer</p>
			</div>
		</div>

    </body>
</html>

<%def name="meta()">
  <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
</%def>

<%def name="title()"></%def>

