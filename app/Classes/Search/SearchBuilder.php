<?php

namespace App\Classes\Search;



use App\Models\Movie;
use Illuminate\Http\Request;

class SearchBuilder
{
    protected $modelName;
    protected $request;

    // El constructor recibira el nombre del modelo y el Request
    public function __construct($modelName,Request $request){
        $this->modelName = $modelName;
        $this->request = $request;
    }

    // Filter es el unico metodo que se llamda desde el controlador
    public function filter()
    {
        $query = $this->applyFilters();
        return $query;
    }

    // aplica filtros
    private function applyFilters(){

        // recupera el modelo
        $model = $this->getModel();

        //crea el query
        $query = $model->newQuery();

        //Recupera los filtros
        $filters = $this->getFilters();

        //Va a recorer cada uno de los filtros
        foreach ($filters as $key => $filter){

            $filterClass = __NAMESPACE__ .'\\Filters\\' .$this->modelName.'\\'. $filter;

            if (class_exists($filterClass)){
                $query = $filterClass::apply($query,$this->request);
            }
        }
        return $query;
    }

    //Crear el Modelo
    private function getModel(){
         try{
             //busca en app/models el nombre del modelo
           return app("App\Models\\".$this->modelName);

         }catch (\Exception $e){
             abort(500);

         }
    }

    //obtenero los filtros
    private function getFilters(){

        //recuperar los filtros name en caso que no exista nos regresa un error500
        $filtersName = [];

        $path = __DIR__ . '/Filters/'. $this->modelName;


        if (file_exists($path)){

            //si existe se recupera todos los directorios
            $allFilters = scandir($path);

            //quita el de punto y dos puntos
            $filters = array_diff($allFilters,array('.','..'));

            //se aplica un prevclase el cual eliminara la extencion'php' sustituirla por una cadena vacia y recuperar el nombre del filtro y almacenarlo en el array filterName
            foreach ($filters as $key => $filter){

                $filtersName[] = preg_replace('/\\.[^.\\s]{3,4}$/', '',$filter);
            }

        }

        return $filtersName;

    }


}
