var demo = demo || {};
(function ($, fluid) {
        
    demo.formBasedImageReorderer = function () {
        var reorderer = fluid.reorderImages(".flc-imageReorderer", {
            selectors: {
                movables: ".flc-imageReorderer-item"
            },
            disableWrap: true
        });  
    };
})(jQuery, fluid);