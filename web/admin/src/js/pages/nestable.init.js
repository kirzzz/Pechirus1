!function (n) {
    "use strict";

    function t() {
    }

    t.prototype.updateOutput = function (t) {
        console.log(n("#nestable_list_3").nestable("serialize"));
        if(n("#nestable_list_3").nestable("serialize"))
            n("#nestable-output").val(window.JSON.stringify(n("#nestable_list_3").nestable("serialize")));
        /*var e = t.length ? t : n(t.target), a = e.data("output");
        console.log(e);
        console.log(a);
        if(a !== undefined)
            window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : '';*/
    }, t.prototype.init = function () {
        n("#nestable_list_1").nestable({group: 1}).on("change", this.updateOutput),
        n("#nestable_list_2").nestable({group: 1}).on("change", this.updateOutput),
        this.updateOutput(n("#nestable_list_1").data("output", n("#nestable_list_1_output"))),
        this.updateOutput(n("#nestable_list_2").data("output", n("#nestable_list_2_output"))),
        n("#nestable_list_menu").on("click", function (t) {
            var e = n(t.target).data("action");
            "expand-all" === e && n(".dd").nestable("expandAll"),
            "collapse-all" === e && n(".dd").nestable("collapseAll")
        }),
        n("#nestable_list_3").nestable().on("change", this.updateOutput),
        this.updateOutput(n("#nestable_list_3").data("output", n("#nestable-output")))
    }, n.Nestable = new t, n.Nestable.Constructor = t
}(window.jQuery), function () {
    "use strict";
    window.jQuery.Nestable.init()
}();