@extends('home')

@section('content')
<style>
	.btn-file {
		line-height: 2.15;
		position: absolute;
		overflow: hidden;
		right: 0;
		top: 0;
		border-radius: 0px;
	}
	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		opacity: 0;
		cursor: inherit;
		display: block;
	}

	th{
		position: relative !important;
		border-bottom: 0;
		text-align: left !important;
	}
	table{
		margin: 10px;
	}

	th span{
		width: 150px;
	}
	.sale{
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	tr:first-child:hover{
		background-color: initial;
		color: inherit;
		cursor: context-menu;
	}

	thead th{
		text-align: center !important;
	}
</style>
	<div class="sale"></div>
	
	<script>
		$(document).on('change', '.btn-file :file', function() {
			var file = $(this).prop('files')[0];
			if(checkFileType(file)){
				var form = $('<form action="/uploadFile/{{ $venta->id }}" enctype="multipart/form-data" method="POST" id="query"></form>').appendTo(".sale");
				var csrfVar = $('meta[name="csrf-token"]').attr('content');
				form.append("<input name='_token' value='" + csrfVar + "' type='hidden'>");
				var file = $(this).prop('files')[0];
				var tipo = $(this).attr("tipo");
				CreateElement(form,"input",undefined,{"type":"hidden","name":"tipo","value":tipo});
				var newFile = $(this).clone().appendTo(form);
				form.submit();
				$('input').hide();
			}
			
		})

		var Datos = {!! json_encode($venta->toArray(), JSON_HEX_TAG) !!};
		var Ventas=[];
		Ventas.push(Datos);
		var archivos = {!! json_encode($archivos->toArray(), JSON_HEX_TAG) !!};
		CreateTable(".sale",Ventas,undefined);
		var tab=CreateElement(".sale","Table",undefined,undefined);	
		SimpleTable(tab, "Factura", {id:"Table_Fac"},archivos);
		SimpleTable(tab,"Albaran",{id:"Table_Alb"},archivos);
		SimpleTable(tab,"Presupuesto",{id:"Table_Pre"},archivos);
		SimpleTable(tab,"Pedido Pro.",{id:"Table_Pro"},archivos);
		SimpleTable(tab,"Pedido Cli.",{id:"Table_Cli"},archivos);
		
	</script>
@stop