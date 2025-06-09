<?php
namespace Model;

class Firma extends ActiveRecord {
    protected static $tabla = 'firmas';
    protected static $columnasDB = [
        'id', 'nombre', 'apellido1', 'envioComu', 'imgRDS', 'imgPWeb', 'imgStr', 'iWHATS', 'ip', 'hora', 'usuario_id', 'token','token_padre', 'confirmacion_padre',
        'token_madre', 'confirmacion_madre','estado'
    ];

    // Propiedades del modelo de firma
    public $id;
    public $nombre;
    public $apellido1;
    public $envioComu;
    public $imgRDS;
    public $imgPWeb;
    public $imgStr;
    public $iWHATS;
    public $ip;
    public $hora;
    public $usuario_id;
    public $token; // Nuevo campo para el token de confirmación
    public $token_padre;
    public $confirmacion_padre;
    public $token_madre;
    public $confirmacion_madre;
    public $estado; // Nuevo campo para el estado de la firma

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->apellido1 = $args['apellido1'] ?? null;
        $this->envioComu = $args['envioComu'] ?? '';
        $this->imgRDS = $args['imgRDS'] ?? '';
        $this->imgPWeb = $args['imgPWeb'] ?? '';
        $this->imgStr = $args['imgStr'] ?? '';
        $this->iWHATS = $args['iWHATS'] ?? '';
        $this->ip = $args['ip'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? null;$this->token = $args['token'] ?? ''; // Asignación del token
        $this->confirmacion_padre = $args['confirmacion_padre'] ?? ''; // Asignación del estado
        $this->confirmacion_madre = $args['confirmacion_madre'] ?? ''; // Asignación del estado
        $this->estado = $args['estado'] ?? ''; // Asignación del estado
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }

    public function crearTokensPadres() {
        $this->token_padre = uniqid();
        $this->token_madre = uniqid();
    }
    
    // Validación de datos
    public function validar() {
        if (!$this->envioComu || !$this->imgRDS || !$this->imgPWeb || !$this->imgStr || !$this->iWHATS) {
            self::$alertas['error'][] = 'Todos los campos de autorización son obligatorios.';
        }

        // if(!$this->token_padre || !$this->token_madre) {
        //     self::$alertas['error'][] = 'Error al generar tokens para los padres.';
        // }

         // Asegúrate de que los tokens de los padres se hayan generado
         if (empty($this->token_padre) || empty($this->token_madre)) {
            self::$alertas['error'][] = 'Error al generar tokens para los padres.';
        }
        return self::$alertas;
    }


}
