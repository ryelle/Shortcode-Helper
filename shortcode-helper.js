// Create a new plugin class
tinymce.create('tinymce.plugins.RrnShortcode', {
    init : function(ed, url) {
        // Register an example button
        ed.addButton('rrn_shortcode', {
            title : "Create shortcode",
            onclick : function() {
            	tb_show( 'Shortcode Helper', '#TB_inline?inlineId=rrn-shortcode-helper' );
            }
        });
    }
});

// Register plugin with a short name
tinymce.PluginManager.add('rrn_shortcode', tinymce.plugins.RrnShortcode);

(function($) { 
	$(document).ready(function(){
		$(".rrn-shortcode-helper").submit( function(e){
			e.preventDefault();
			var shortcode = $("#shortcode-field").val();
			//console.log(tinyMCE.activeEditor.selection.getContent(), shortcode);
			if ('' == tinyMCE.activeEditor.selection.getContent()){
				tinyMCE.activeEditor.execCommand('mceInsertContent', false, '['+shortcode+']' );
			} else {
				var re = /[a-zA-Z0-9_-]+/,
					matches = re.exec(shortcode),
					tag = matches[0];
				tinyMCE.activeEditor.execCommand('mceReplaceContent', false, ' ['+shortcode+']{$selection}[/'+tag+'] ' );
			}
			$("#shortcode-field").val('');
			tb_remove();
		});
		$(".rrn-shortcode-helper .shortcode-list li").click(function(){
			$("#shortcode-field").val($(this).text());
		});
	});
})(jQuery)