<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Http\Requests;
use Image;
use App\Vereador;
use App\Projeto;
use App\Ver_Proj;
use DB;



class CamaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

      public function inicio()
    {
        $vereadores = Vereador::all(); //Seleciona todods os vereadores
        //return view('projeto.index', ['vereadores' => $vereadores]);
        return view('index')->with('vereadores', $vereadores);

    }
    public function cronometro()
    {
        $vereadores = Vereador::all(); //Seleciona todods os vereadores
        return view('projeto.cronometro')->with('vereadores', $vereadores);

    }

    public function index()
    {
        $vereadores = Vereador::all(); //Seleciona todods os vereadores
        //return view('projeto.index', ['vereadores' => $vereadores]);
        return view('projeto.index')->with('vereadores', $vereadores);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
       
        return view('projeto.formCriar')->with('p',"default.jpg");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $novoVereador = new Vereador($dados);
        $novoVereador->save();

        $avatar = $request->input('avatar');
        $idd =$novoVereador->id;
         $novoVereador = Vereador::find($idd);
           if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename=time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/' . $filename));
            $novoVereador->avatar = $filename;
            $novoVereador->save();
        }    
        
      

           
        return redirect()->action('CamaraController@index');

    }
    

    //Metodo para ocronometro de cada vereador
    public function crono($id) {
        $dados = Vereador::find($id);
        return view('projeto.crono', ['p' => $dados]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //nome dos  projetos
        $projs = DB::select('select distinct p.id, p.nome from vereador v, projetos p, ver_proj vp where
            p.id = vp.id_proj and ? = vp.id_ver and vp.id_ver = v.id', [$id]);

        $vereadores = Vereador::find($id);
       
        return  view('projeto.descricao' , ['v' => $vereadores, 'projs' => $projs]);  

        
    }

    public function uploand(Request $request,$id)
    {
         $projs = DB::select('select distinct p.id, p.nome from vereador v, projetos p, ver_proj vp where
            p.id = vp.id_proj and ? = vp.id_ver and vp.id_ver = v.id', [$id]);
         $avatar = $request->input('avatar');
         $vereador = Vereador::find($id);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename=time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/' . $filename));
            $vereador ->avatar = $filename;
            $vereador->save();
        }    

            return  view('projeto.descricao' , ['v' => $vereador, 'projs' => $projs]);  

}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vereador = Vereador::find($id);
        return view('projeto.formEditar' , ['v' => $vereador]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $nome = $request->input('nome');
        $data = $request->input('data');
        $filiacao = $request->input('filiacao');
        $mandatos = $request->input('mandatos');

        $vereador = Vereador::find($id);
        $vereador->nome = $nome; 
        $vereador->data= $data; 
        $vereador->filiacao = $filiacao; 
        $vereador->mandatos = $mandatos; 


        $vereador->save();

        return redirect()->action('CamaraController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //Primeiro é deletado a quele vereador na tabela ver_proj, pois o id do vereador é chave estrangeira do ver_proj
         $deleted = DB::delete('delete from ver_proj where ? = id_ver', [$id]);  

         //Depois o vereador pode ser exvluido
         Vereador::destroy($id);

         return redirect()
                ->action('CamaraController@index');

        //Pode ser feito da seguinte maneira
        //$dado = Vereador::find($id);
        //$dado->delete();
    }
}
