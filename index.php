<?php 

    require 'vendor/autoload.php';
    require 'conection.php';
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $c = new \Slim\Container();
    $c['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
        	$error = array('error' => $exception->getMessage());
          return $c['response']->withStatus(500)
                                 ->withHeader('Content-Type', 'application/json')
                                 ->write(json_encode($error));
        };
    };

    $app = new \Slim\App($c);

    require 'utils.php';

    $app->get('/',function(Request $request, Response $response, $args){
        $alumnos                = Alumnos::get();
        $solicitud              = Solicitudderesidencias::get();
        $Cartaaceptacion        = Cartaaceptacion::get();
        $cartapresentacion      = Cartapresentacion::get();
        $expedienteFinal        = Expedientefinal::get();
        $Reportesderesidencias  = Reportesderesidencias::get();
        $Carreras               = Carreras::get();
        $Mensajes               = Mensajes::get();

        return sendOkResponse(('[{"alumnos":'.$alumnos.',"solicitudes":'.$solicitud.',"cartaaceptacion":'.$Cartaaceptacion.',"cartapresentacion":'.$cartapresentacion.',"expedienteFinal":'.$expedienteFinal.',"Reportesderesidencias":'.$Reportesderesidencias.',"Carreras":'.$Carreras.',"mensajes":'.$Mensajes.'}]'),$response);
    });

    $app->post('/getCatalogs',function(Request $request,Response $res,$args){
        $carreras = Carreras::where('bActivo','=','1')->get();
        $giros    = Giros::where("bActivo","=","1")->get();
        $opciones = Opciones::where("bActivo","=","1")->get();
        $periodos = Periodos::where("bActivo","=","1")->get();
        $sectores = Sectores::where("bActivo","=","1")->get();
        return sendOkResponse('{
                            "carreras":'.$carreras->toJson().',
                            "giros":'.$giros->toJson().',
                            "opciones":'.$opciones->toJson().',
                            "periodos":'.$periodos->toJson().',
                            "sectores":'.$sectores->toJson().'
                            }',$res);
    });

    $app->post('/getMessages',function(Request $req,Response $res,$args){
        $Mensajes = Mensajes::where('bActive','=','1')->get();
        return sendOkResponse($Mensajes->toJson(),$res);
    });
    $app->post('/login',function(Request $req,Response $res,$args){
        $data = $req->getParsedBody();

        $usuario = Usuarios::where('vUsuario','=',$data["vUsuario"])
                  ->where("vContrasena",'=',$data["vContrasena"])->first();

        if(empty($usuario)){
            sendOkResponse('{"tabla1":[{"response":"500","result":"El usuario no existe en la base de datos"}],"tabla2":"Usuario no encontrado"}',$res);
        }else{
            sendOkResponse('{"tabla1":[{"response":"200"}],"tabla2":'.$usuario->alumno()->first()->toJson().'}',$res);
        }
    });
    $app->post('/registrarAlumno',function(Request $req,Response $res,$args){
        $data = $req->getParsedBody();
        $usuario = new Usuarios();



        $usuario = Usuarios::where(
                    'vUsuario','=',$data["vUsuario"])
                    ->where('vContrasena','=',$data["vContrasena"])
                    ->first();
        if(!empty($usuario)){
            sendOkResponse('{"tabla1":[{"response":"500","result":"El usuario ya existe en la base de datos","existe":"1"}]}',$res);
        }else{
            $usuario = new Usuarios();
            $usuario->idTipoUsuario = 1;
            $usuario->vUsuario      = utf8_encode($data["vUsuario"]);
            $usuario->vContrasena   = utf8_encode($data["vContrasena"]);
            $usuario->bActivo       = 1;
            $respuesta = "[]";
            $usuario->save();
            if(count($usuario)>0){
                $alumnos = new Alumnos();

                $alumnos = Alumnos::where('idUsuario','=',$usuario->idUsuario)->first();

                if(empty($alumnos)){
                    $alumnos = new Alumnos();
                }


                $alumnos->idCarrera             = $data["idCarrera"];
                $alumnos->idUsuario             = $usuario->idUsuario;
                $alumnos->vNumeroControl        = utf8_encode($data["vNumeroControl"]);
                $alumnos->vNombre               = utf8_encode($data["vNombre"]);
                $alumnos->vApellidoPaterno      = utf8_encode($data["vApellidoPaterno"]);
                $alumnos->vApellidoMaterno      = utf8_encode($data["vApellidoMaterno"]);
                $alumnos->vNumeroControl        = $data["vNumeroControl"];
                $alumnos->dFechaNacimiento      = $data["dFechaNacimiento"];
                $alumnos->bSexo                 = $data["bSexo"];
                $alumnos->vSemestre             = $data["vSemestre"];
                $alumnos->vCorreoInstitucional  = $data["vCorreoInstitucional"];
                if($alumnos->save()){
                    sendOkResponse('{"tabla1":[{"response":"200"}],"tabla2":'.Alumnos::where('idAlumno','=',$alumnos->idAlumno)->get()->toJson().'}',$res);
                }else{
                    sendOkResponse('{"tabla1":[{"response":"500","result":"No se pudo guardar el usuario en el servidor"}]}',$res);
                }
            }else{
                 sendOkResponse('{"tabla1":[{"response":"500",result:"No se pudo guardar el usuario en el servidor"}]}',$res);
            }
        }
        
    });
    /*
    $this->post('/new',function(Request $request, Response $response, $args){
            $data = $request->getParsedBody();
            $Musico = new Musico();


            //Nombre imagen
            $nombreImagen = $data['nombre'].$data['apellido_paterno'].uniqid();    
            $decoded = base64_decode($data['foto_perfil']);
            file_put_contents('imgPerfil/'.$nombreImagen.'.jpg', $decoded);
    */
   /* $app->get('/pruebaPython/{camara}/{tipo}',function(Request $request, Response $response, $args){
        $alerta = new Alertas();
        $alerta->camara = $args['camara'];
        $alerta->tipo = $args['tipo'];
        $alerta->fecha = date("F j, Y, g:i a");
        $alerta->save();
        echo "alerta guardada";
    });

    $app->get('/obtenerDatos',function(Request $request, Response $response, $args){
        $alerta = Alertas::get();
        return sendOkResponse($alerta->toJson(),$response);
    });


    $app->group('/musico',function(){
 
        $this->get('/all',function(Request $request, Response $response, $args){
            $musico = Musico::orderByRaw('RAND()')->get();
            return sendOkResponse($musico->toJson(),$response);
        });

        $this->get('/byCity/{idCiudad}', function(Request $request, Response $response, $args){
            $musico = Musico::where('c_ciudad_id','=',$args['idCiudad'])->orderByRaw('RAND()')->get();
            return sendOkResponse($musico->toJson(),$response);
        });

      
        $this->get('/{id}',function(Request $request, Response $response, $args){
            $musico = Musico::where('id','=', $args['id'])->with('instrumentos','excepciones','trajes','horarios')->get();
            return sendOkResponse($musico->toJson(), $response);
        });

 
        $this->post('/new',function(Request $request, Response $response, $args){
            $data = $request->getParsedBody();
            $Musico = new Musico();


            //Nombre imagen
            $nombreImagen = $data['nombre'].$data['apellido_paterno'].uniqid();    
            $decoded = base64_decode($data['foto_perfil']);
            file_put_contents('imgPerfil/'.$nombreImagen.'.jpg', $decoded);

            $Musico->nombre = $data['nombre'];
            $Musico->apellido_paterno = $data['apellido_paterno'];
            $Musico->apellido_materno = $data['apellido_materno'];
            $Musico->telefono1 = $data['telefono1'];
            $Musico->telefono2 = $data['telefono2'];
            $Musico->disponibilidad = $data['disponibilidad'];
            #Crear carpeta en servidor para subir la imagen de perfil
            $Musico->foto_perfil = 'imgPerfil/'.$nombreImagen.'.jpg';
            $Musico->usuario = $data['usuario'];
            $Musico->password = $data['password'];
            $Musico->fecha_registro = $data['fecha_registro'];
            $Musico->destacado = $data['destacado'];
            $Musico->fecha_destacado = $data['fecha_destacado'];
            $Musico->c_pais_id = "1";//$data['c_pais_id']; TODOS SON DE MEXICO
            $Musico->c_estado_id = $data['c_estado_id'];
            $Musico->c_ciudad_id = $data['c_ciudad_id'];
            $Musico->save();

            $Ultimo = Musico::all();

     
            return sendOkResponse($Ultimo->last()->toJson(),$response);
        });
    });

    $app->group('/ubicacion',function(){

        $this->get('/paises',function(Request $request, Response $response, $args){
            $paises = Pais::get();
            return sendOkResponse($paises->toJson(),$response);
        });

        
        $this->get('/estados/{pais}',function(Request $request, Response $response, $args){
            $estados = Estado::where('c_pais_id','=', $args['pais'])->get();
            return sendOkResponse($estados->toJson(),$response);
        });
        $this->get('/ciudades/{estado}',function(Request $request, Response $response, $args){
            $ciudades = Ciudad::where('c_estado_id','=',$args['estado'])->get();
            return sendOkResponse($ciudades->toJson(),$response);
        });
    });*/
    
    $app->run();

?>