<style type="text/css">

    #container{
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        -webkit-box-shadow: 0 1px 3px #666;
        width: 580px;
        height: 370px;

        margin :1em;
        background:url(public/assets/img/bg.png) right bottom no-repeat
    }

    #container2{
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        -webkit-box-shadow: 0 1px 3px #666;
        width: 580px;
        height: 370px;

        margin :1em;
        background:url(public/assets/img/bg.png) right bottom no-repeat
    }

</style>
<div id="container"></div>
<div id="container2"></div>

    <script>
        window.onload = function () {

            /* Title settings */
            title = "October Browser Statistics";
            titleXpos = 390;
            titleYpos = 85;

            /* Pie Data */
            pieRadius = 130;
            pieXpos = 150;
            pieYpos = 180;
            pieData = <?php echo $datos?>;
            pieLegend = <?php echo $label?>;

            pieLegendPos = "east";
            var r = Raphael("container");

            r.text(titleXpos, titleYpos, title).attr({"font-size": 20});

            var pie = r.piechart(pieXpos, pieYpos, pieRadius, pieData, {legend: pieLegend, legendpos: pieLegendPos});
            pie.hover(function () {
                this.sector.stop();
                this.sector.scale(1.1, 1.1, this.cx, this.cy);

                if (this.label) {
                    this.label[0].stop();
                    this.label[0].attr({ r: 7.5 });
                    this.label[1].attr({ "font-weight": 800, "font-size": 18 });
                }
            }, function () {

                this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

                if (this.label) {
                    this.label[0].stop
                    this.label[0].animate({ r: 5 }, 500, "bounce");
                    this.label[1].attr({ "font-weight": 400 });
                    this.label[1].attr({ "font-size": 12 });
                }
            });


            /* Title settings */
            title = "September Browser Statistics";
            titleXpos = 390;
            titleYpos = 85;

            /* Pie Data */
            pieRadius = 130;
            pieXpos = 150;
            pieYpos = 180;
            pieData = <?php echo $datos_categoria?>;
            pieLegend = <?php echo $label_categoria?>;

            pieLegendPos = "east";
            var r = Raphael("container2");

            r.text(titleXpos, titleYpos, title).attr({"font-size": 20});

            var pie = r.piechart(pieXpos, pieYpos, pieRadius, pieData, {legend: pieLegend, legendpos: pieLegendPos});
            pie.hover(function () {
                this.sector.stop();
                this.sector.scale(1.1, 1.1, this.cx, this.cy);

                if (this.label) {
                    this.label[0].stop();
                    this.label[0].attr({ r: 7.5 });
                    this.label[1].attr({ "font-weight": 800, "font-size": 18 });
                }
            }, function () {

                this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");

                if (this.label) {
                    this.label[0].stop
                    this.label[0].animate({ r: 5 }, 500, "bounce");
                    this.label[1].attr({ "font-weight": 400 });
                    this.label[1].attr({ "font-size": 12 });
                }
            });

        };
    </script>