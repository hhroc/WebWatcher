<div id="header_tabs" class="grid_12 ui-tabs">
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix">
%if not tmpl_context.identity:
	<li class="ui-corner-top ${('', 'active')[page=='index']}"><a href="#tabs-1">Home</a></li>
	<li class="ui-corner-top ${('', 'active')[page=='services']}"><a href="#tabs-2">Services</a></li>
%else:
	<li class="ui-corner-top ${('', 'active')[page=='index']}"><a href="#tabs-1">Home</a></li>
	<li class="ui-corner-top ${('', 'active')[page=='instances']}"><a href="#tabs-1">Instances</a></li>
	<li class="ui-corner-top ${('', 'active')[page=='reports']}"><a href="#tabs-2">Reports</a></li>
%endif
	<li class="right ui-corner-top ${('', 'active')[page=='help']}"><a href="#tabs-4">Help</a></li>
</ul>
</div>
