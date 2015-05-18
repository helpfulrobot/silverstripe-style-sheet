<% loop $StyleObjects %>
	$RenderStyleSheet
<% end_loop %>

<% if $StyleSheetCustomCSS %>
	$StyleSheetCustomCSS
<% end_if %>