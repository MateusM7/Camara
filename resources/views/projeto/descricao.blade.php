@extends('layout.principal')

@section('conteudo')

<div class="row">
    <div class="col-sm-4 col-md-3">
        <div class="thumbnail">
           <img src="\img\{{$v->avatar}}"class="img-thumbnail" style="width:230px; height:230px; float:left; borde-radius:50%; margin-right:25px;">
              <div class="caption">
                  <h3>Excelentíssimo</h3>
                  <p>...</p>
             </div>
       </div>
  </div>
  <div class="col-xs-7">
  	<h2>{{$v->nome}}</h2>
  	<table class="table table-striped table-hover"> 
      <thead>
  		  <tr>
  			<th>Filiação</th>
  			<th>Data de nascimento</th>
  			<th>Email</th>
  			<th>Telefone</th>
  			<th>Mandatos</th>
  		 	<th>Projetos</th>
  		 </tr>
  	 </thead>	
  		 <tr>
  		   <td>{{$v->filiacao}}</td>
  		   <td>{{$v->data}}</td>
  		   <td>{{$v->email}}</td>
  		   <td>{{$v->fone}}</td>
  		   <td>{{$v->mandatos}}</td>	
  		 <td>
  				@if(!empty($projs))
  				@foreach($projs as $p)
  				<div class="pull-right btn btn-sm btn-primary">
  					<a class="pull-right btn btn-sm btn-primary" href="/inicio/vereador/{{$v->id}}/projeto/{{$p->id}}">{{$p->nome}}</a>
  				</div>
  				<br>
  				@endforeach
  				@else
  				<div class="alert-danger">
  					Esse vereador ainda não tem projetos
  				</div>
  				@endif

  		 </td>
  	</table>
  </div>
</div>
	<a href="{!! route('group.crono', $v->id) !!}" class="btn" >crono</a>  <!--Link para o cronometro de cada vereador-->

	<!--<a href="{!! route('group.index') !!}">Home</a> Link para o inicio da pagina -->

@stop