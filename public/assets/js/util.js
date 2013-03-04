function setGraph(settings){
    /*
     *https://github.com/kennyshen/g.raphael/blob/master/docs/pie.md
     *http://jburrows.wordpress.com/2011/02/21/documentation-for-graphael-g-line-js/
     *https://github.com/kennyshen/g.raphael/blob/master/docs/reference.js
     *http://www.exratione.com/2011/10/a-few-tips-for-graphael-line-charts/
     */
    var r = Raphael(settings.container),
        pie = r.piechart(settings.pieXpos, settings.pieYpos, settings.pieRadius,
            settings.pieData, {
                legend: settings.pieLegend,
                stroke: 'none'
            });
    r.text(110,20, settings.legend).attr({
        font: "20px sans-serif",
        fill: "#000"

    });
    for( var i = 0, l = pie.labels.length; i < l; i++ ) {
        // change the axis and tick-marks
        //spie.labels[i].attr("stroke", "#000000");
        pie.labels[i].attr("font", "12px sans-serif");
        pie.labels[i].attr("x", settings.legendLeft+20);
        pie.labels[i].attr("cx", settings.legendLeft);
        pie.labels[i].attr("y", settings.legendTop+i*20);
        pie.labels[i].attr("cy", settings.legendTop+i*20);
        pie.labels[i][1].attr( "fill", "#000000" );
    }
    pie.each(function(){
        this.sector.scale(0, 0, this.cx, this.cy);
        this.sector.animate({
            transform: 's1 1 ' + this.cx + ' ' + this.cy
        }, 1000, "bounce");
    });
    pie.hover(function () {
        pie.each(function() {
            if(this.sector.hasOwnProperty('t')) {
                this.sector.t.remove();
            }
        });
        var that = this.sector;
        this.sector.stop();
        this.sector.animate({
            transform: 's1.1 1.1 ' + this.cx + ' ' + this.cy
        }, 500, "bounce");
        pie.each(function() {
            if(this.sector.id === that.id) {
                this.sector.animate({
                    "opacity":1
                }, 1000);
                this.sector.scale(1.1, 1.1, this.cx, this.cy);
                this.sector.t = r.text(this.x, this.y, '$' + this.sector.value.value).attr({
                    "font-size": 18,
                    "fill":"#000"
                });
                if (this.label) {
                    this.label[0].stop();
                    this.label[0].attr({
                        r: 7.5
                    });
                    this.label[1].attr({
                        "font-weight": 800
                    });
                }
            } else {
                this.sector.animate({
                    "opacity":0.80
                }, 1000);
            }
        });
    }, function () {
        pie.animate({
            "opacity":1
        }, 1000);
        this.sector.animate({
            transform: 's1 1 ' + this.cx + ' ' + this.cy
        }, 1500, "bounce");
        if (this.label) {
            this.label[0].animate({
                r: 5
            }, 500, "bounce");
            this.label[1].attr({
                "font-weight": 400
            });
        }
    });
}
