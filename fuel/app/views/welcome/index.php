<style type="text/css">

    #gastos_proveedor_container{
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        -webkit-box-shadow: 0 1px 3px #666;
        width: 580px;
        height: 370px;
        margin :1em;
        background:url(assets/img/bg.png) right bottom no-repeat
    }

    #gastos_categoria_container{
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        -webkit-box-shadow: 0 1px 3px #666;
        width: 580px;
        height: 370px;

        margin :1em;
        background:url(assets/img/bg.png) right bottom no-repeat
    }

</style>
<div id="gastos_proveedor_container"></div>
<div id="gastos_categoria_container"></div>

<script>

    var gastos_proveedor = new Object();
    // hero graph
    gastos_proveedor.container = "gastos_proveedor_container";
    gastos_proveedor.pieLegendPos = "east";
    gastos_proveedor.legendTop = 70;
    gastos_proveedor.legendLeft = 340;
    gastos_proveedor.pieRadius = 130;
    gastos_proveedor.pieXpos = 150;
    gastos_proveedor.pieYpos = 180;
    gastos_proveedor.pieData = <?php echo $datos?>;
    gastos_proveedor.pieLegend = <?php echo $label?>;
    gastos_proveedor.legend = "Gastos por Proveedor";


    var gastos_categoria = new Object();
    // hero graph
    gastos_categoria.container = "gastos_categoria_container";
    gastos_categoria.pieLegendPos = "east";
    gastos_categoria.legendTop = 70;
    gastos_categoria.legendLeft = 340;
    gastos_categoria.pieRadius = 130;
    gastos_categoria.pieXpos = 150;
    gastos_categoria.pieYpos = 180;
    gastos_categoria.pieData = <?php echo $datos_categoria?>;
    gastos_categoria.pieLegend = <?php echo $label_categoria?>;
    gastos_categoria.legend = "Gastos por Categoría";

    $(document).ready(function(){

        if(gastos_proveedor.hasOwnProperty('container')) {
            setGraph(gastos_proveedor);
        }

        if(gastos_categoria.hasOwnProperty('container')) {
            setGraph(gastos_categoria);
        }
    });

</script>