<div class="stylesheet-cms-preview">
	<h3>Style Sheet &ndash; Raw</h3>
	<div class="stylesheet-cms-preview-stylecontainer">
		<% loop $StyleObjects %>
			<h4>/* $ClassName.UpperCase() &ndash; $Name.UpperCase() */</h4>
			<p>$RenderStyleSheet</p>
		<% end_loop %>

		<% if $StyleSheetCustomCSS %>
			<h4>/* CUSTOM */</h4>
			<p>$StyleSheetCustomCSS</p>
		<% end_if %>
	</div>

	<h3>Style Sheet &ndash; Minified</h3>
	<div class="stylesheet-cms-preview-stylecontainer">
		$RenderStyleSheet
	</div>
</div>