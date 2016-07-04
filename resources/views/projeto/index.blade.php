@extends('layout.principal')

@section('conteudo')

	<ul class="nav nav-tabs">
		<li  class="btn-group btn-group-lg" role="presentation" class="active"><a href="#" ><img src="/icones/secao.png" style="width 27px; height:27px;"><strong>Seções</strong></a></li>
		<li  class="btn-group btn-group-lg" role="presentation" class="active"><a href="#" ><img src="/icones/projetos.png" style="width 30px; height:30px"><strong>Projetos</strong></a></li>
		<li  class="btn-group btn-group-lg" role="presentation" class="active"><a href="#" ><img src="/icones/check.png" style="width 30px; height:30px"><strong>Check</strong></a></li>
		<li  class="btn-group btn-group-lg" role="presentation" class="active"><a href="{!! route('group.cronometro') !!}" ><img src="/icones/crono.png" style="width 30px; height:30px"><strong>Cronometro</strong></a></li>
		<li   class="btn-group btn-group-lg" role="presentation" class="active"><a href="#" ><img src="/icones/filtro.png" style="width 30px; height:30px"><strong>Filtros</strong></a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
            <li class="btn-group btn-group-lg" class="btn btn-default"><a href="{!! route('group.inicio') !!}"><span class="glyphicon glyphicon-arrow-left" ></span><strong>Início</strong></a></li>   
	</ul>

</br><div class="row">
<div class="container-fluid">
	<div class="col-lg-6">
		<div class="input-group">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button">Pesquisar</button>
			</span>
			<input type="text" class="form-control" placeholder="Search for...">
		</div><!-- /input-group -->
	</div><!-- /.col-lg-6 -->
</div>
</div>

</br>

<div class="row">	
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Vereador</th>
				<th>Filiação</th>
				<th>Email</th>
				<th>Fone</th>
				<th>Mandato</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach ($vereadores as $v)
			<tr>
				<td>{{$v->id}}</td>
				<td>{{$v->nome}}</td>
				<td>{{$v->filiacao}}</td>
				<td>{{$v->email}}</td>
				<td>{{$v->fone}}</td>
				<td>{{$v->mandatos}}</td>
				
				<!--Link para as descriçoes de cada vereador-->
				<td>
					<a href="{!! route('group.show', $v->id) !!}">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</a>
				</td> 
				<td>
					<a href="{!! route('group.edit', $v->id) !!}">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
				</td> <!-- Link para editar um um vereador -->
				<td>
					<a href="{!! route('group.destroy', $v->id) !!}">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td> <!-- Link para remover um vereador-->


			</tr>

			@endforeach
		</tbody>
	</table>

	<a class="btn btn-primary" href="{!! route('group.create') !!}">
		<span class="glyphicon glyphicon-plus"></span> 
		vereador
	</a></br>  <!--Link para adicionar novo vereador-->

</div>	

@stop