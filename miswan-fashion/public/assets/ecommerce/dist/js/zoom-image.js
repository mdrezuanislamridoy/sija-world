;(function($) {
    $.fn.zoomImage = function(paras) {
        var defaultParas = {
            layerW: 200,
            layerH: 200,
            layerOpacity: 0.2,
            layerBgc: '#000',
            showPanelW: 550,
            showPanelH: 550,
            marginL: 5,
            marginT: 0
        };
        
        paras = $.extend({}, defaultParas, paras);
        
        $(this).each(function() {
            var self = $(this).css({
                position: 'relative'
            });
            
            // Get container dimensions
            var imageW = self.width();
            var imageH = self.height();
            
            self.find('img').css({
                width: '100%',
                height: '100%'
            });
            
            var wTimes = paras.showPanelW / paras.layerW;
            var hTimes = paras.showPanelH / paras.layerH;
            
            var img = $('<img>').attr('src', self.attr("href")).css({
                position: 'absolute',
                left: '0',
                top: '0',
                width: imageW * wTimes,
                height: imageH * hTimes
            }).attr('id', 'big-img');
            
            var layer = $('<div>').css({
                display: 'none',
                position: 'absolute',
                left: '0',
                top: '0',
                backgroundColor: paras.layerBgc,
                width: paras.layerW,
                height: paras.layerH,
                opacity: paras.layerOpacity,
                border: '1px solid #ccc',
                cursor: 'crosshair'
            });
            
            var showPanel = $('<div>').css({
                display: 'none',
                position: 'absolute',
                overflow: 'hidden',
                left: imageW + paras.marginL,
                top: paras.marginT,
                width: paras.showPanelW,
                height: paras.showPanelH
            }).append(img);
            
            self.append(layer).append(showPanel);
            
            self.on('mousemove', function(e) {
                var selfOffset = self.offset();
                var x = e.pageX - selfOffset.left;
                var y = e.pageY - selfOffset.top;
                
                // Calculate layer position
                var layerX, layerY;
                
                // X-axis bounds
                if(x <= paras.layerW / 2) {
                    layerX = 0;
                } else if(x >= imageW - paras.layerW / 2) {
                    layerX = imageW - paras.layerW;
                } else {
                    layerX = x - paras.layerW / 2;
                }
                
                // Y-axis bounds
                if(y <= paras.layerH / 2) {
                    layerY = 0;
                } else if(y >= imageH - paras.layerH / 2) {
                    layerY = imageH - paras.layerH;
                } else {
                    layerY = y - paras.layerH / 2;
                }
                
                // Update layer position
                layer.css({
                    left: layerX,
                    top: layerY
                });
                
                // Update zoomed image position
                img.css({
                    left: -layerX * wTimes,
                    top: -layerY * hTimes
                });
            }).on('mouseenter', function() {
                var selfOffset = self.offset();
                imageW = self.width();
                imageH = self.height();
                
                // Update zoom panel position
                showPanel.css({
                    left: imageW + paras.marginL
                });
                
                // Update zoomed image size
                img.css({
                    width: imageW * wTimes,
                    height: imageH * hTimes
                });
                
                layer.show();
                showPanel.show();
            }).on('mouseleave', function() {
                layer.hide();
                showPanel.hide();
            });
            
            // Update dimensions on window resize
            $(window).on('resize', function() {
                imageW = self.width();
                imageH = self.height();
                
                showPanel.css({
                    left: imageW + paras.marginL
                });
                
                img.css({
                    width: imageW * wTimes,
                    height: imageH * hTimes
                });
            });
        });
        
        return this;
    };
})(jQuery);