+function ($) { "use strict";

    var CtrlV = function () {
        this.$form = $('#post-form')
        this.$markdownEditor = $('[data-field-name=content] [data-control=markdowneditor]:first', this.$form)
        if (this.$markdownEditor.length > 0) {
            this.codeEditor = this.$markdownEditor.markdownEditor('getEditorObject');
            var self=this;
            this.$markdownEditor.on('pasteImage', function (ev, data) {
                self.upload(data.dataURL)
            })
        }
        this.init()
    }

    CtrlV.prototype.init=function(){

    }

    CtrlV.prototype.upload=function(data){

        var self=this, token = $('meta[name="csrf-token"]').attr('content')
        if (token) {
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':token}})
        }

        $.ajax({
            type: 'POST',
            url: '/backend/jc91715/extendmarkdown/md/handle',
            data: {'base64':data},
        }).success(function(data){
            self.insert('\n![1]('+data.url+')\n')
        });

    }

    CtrlV.prototype.insert=function(template){
        var editor = this.codeEditor,
            pos = this.codeEditor.getCursorPosition()
        if (pos.column == 0) {
            editor.selection.clearSelection()
        }
        else {
            editor.navigateTo(editor.getSelectionRange().start.row, Number.MAX_VALUE)
        }
        editor.insert(template)
        editor.focus()
    }


    $(document).ready(function(){
        var Ctrl = new CtrlV()

        if ($.oc === undefined)
            $.oc = {}

        $.oc.ctrl = Ctrl
    })

}(window.jQuery);
