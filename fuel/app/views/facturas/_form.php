<?php echo Form::open(array('class'=>'well','style'=>'width:300px;')); ?>
	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Ruc', 'ruc'); ?>

			<div class="input">
				<?php echo Form::input('ruc', Input::post('ruc', isset($factura) ? $factura->ruc : ''), array('class' => 'span4', 'autocomplete'=>'off')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Nombre', 'nombre'); ?>

			<div class="input">
				<?php echo Form::input('nombre', Input::post('nombre', isset($factura) ? $factura->nombre : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Fecha', 'fecha'); ?>

			<div class="input">
				<?php echo Form::input('fecha', Input::post('fecha', isset($factura) ? $factura->fecha : date('Y-m-d')), array('class' => 'span4','data-date'=>date('Y-m-d'), 'data-date-format'=>'yyyy-mm-dd')); ?>

			</div>
		</div>

        <div class="clearfix">
            <?php echo Form::label('Tipo', 'tipo'); ?>

            <div class="input form-inline">
                <?php echo Form::select('tipo', Input::post('fecha', isset($factura) ? $factura->tipo : '1'), $tipos_deducibles); ?>
                <a href="#myModal" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus-sign"></i></a>
            </div>
        </div>

        <div class="clearfix">
            <?php echo Form::label('N&uacute;mero de Factura', 'numero_factura'); ?>

            <div class="input">
                <?php echo Form::input('numero_factura', Input::post('numero_factura', isset($factura) ? $factura->valor : ''), array('class' => 'span4', 'autocomplete'=>'off')); ?>

            </div>
        </div>

		<div class="clearfix">
			<?php echo Form::label('Valor', 'valor'); ?>

			<div class="input">
				<?php echo Form::input('valor', Input::post('valor', isset($factura) ? $factura->valor : ''), array('class' => 'span4', 'autocomplete'=>'off')); ?>

			</div>
		</div>

        <div class="clearfix">
            <?php echo Form::label('Comentario', 'comentario'); ?>

            <div class="input">
                <?php echo Form::textarea('comentario', isset($factura) ? $factura->comentario : '', array('rows' => 3, 'class' => 'span4'));?>

            </div>
        </div>
        <div class="btn-group">
			<?php echo Form::submit('submit', 'Grabar Factura', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>



<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Nuevo Tipo de Gasto</h3>
    </div>
    <?php echo Form::open(array('action' => '/api/create_categoria.json', 'method' => 'post','id'=>'create_categoria')); ?>
    <div class="modal-body">
        <fieldset>
            <div class="clearfix" id="contenedorform">
                <?php echo Form::label('Nombre', 'nombre'); ?>

                <div class="input">
                    <?php echo Form::input('nombre', Input::post('nombre', isset($categoria) ? $categoria->nombre : ''), array('class' => 'span4')); ?>

                </div>
            </div>
        </fieldset>
        <div  id="loading" style="display: none;">
            <?php echo Html::img('assets/img/loading.png');?>
        </div>

        <div class="clearfix"
            <?php echo Html::img('assets/img/loading.png');?>
        </div>
        <div class="alert alert-error" id="mensaje" style="display: none;">
            <p id="mensaje_error"></p>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Salir</button>
        <button class="btn btn-primary">Crear nuevo Tipo</button>
    </div>
    <?php echo Form::close(); ?>


<script type="text/javascript">
    $(document).ready(function() {

        $('#myModal').on('hidden', function () {
            $("#mensaje").hide();
            $('#mensaje_error').html('');
            $('#create_categoria').find( 'input[id="form_nombre"]' ).val('');
        });
        $("#create_categoria").submit(function(event) {
            event.preventDefault();
            $(document).ajaxStart(function() {
                $("#loading").show();
            }).ajaxStop(function() {
                 $("#loading").hide();
            });

            var nombre_categoria = $('#create_categoria').find( 'input[id="form_nombre"]' ).val(),
            url = $('#create_categoria').attr( 'action' );

            var posting = $.post( url, { nombre: nombre_categoria } );

            posting.done(function( data ) {

                var getting = $.get('<?php echo \Fuel\Core\Uri::create('api/categorias.json')?>');
                getting.done(function (items){
                    var options = "";
                    $.each(items, function(item_id, item_name)
                    {
                        if (item_name.toUpperCase() == nombre_categoria.toUpperCase())
                        {
                            options += "<option selected value=\"" + item_id + "\">" + item_name + "</option>";
                        }
                        else
                        {
                            options += "<option value=\"" + item_id + "\">" + item_name + "</option>";
                        }

                    });
                    $("#form_tipo").html(options);
                    $('#myModal').modal('hide')
                });
                getting.error(function (data, textStatus, errorThrown){
                    console.error(
                        "The following error occured: "+ JSON.stringify(data)
                    );
                })

            });

            posting.error(function (data, textStatus, errorThrown){
                $('#mensaje_error').html(data.responseText);
                $('#mensaje').show();

                console.error(
                    "The following error occured: "+ JSON.stringify(data.responseText)

                );
            });
        });

        $('#form_ruc').typeahead({
            minLength: 3,
            source: function(ruc, process) {
                $.post('<?php echo \Fuel\Core\Uri::create('api/rucs.json')?>', { ruc: ruc, limit: 10 }, function(data) {
                    listado = [];
                    mapa = {};

                    $.each(data, function (i, item) {
                        mapa[item.ruc] = item;
                        listado.push(item.ruc);
                    });

                    process(listado);
                });
            },
            updater: function (item) {
                $("#form_nombre").val(mapa[item].nombre);
                return item;
            }
        });

        $('#form_fecha').datepicker({endDate: '<?php echo date('Y-m-d');?>',autoclose:true,todayHighlight:true});
    });

</script>