<?php
/**
 * Permitir la conexion contra la base de datos.
 */
class dbnba
{
  //Atributos.
  private $host="localhost";
  private $user="root";
  private $pass="";
  private $db_name="nba";

  private $conexion;


  private $error=false;

  function __construct()
  {
      $this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
      if ($this->conexion->connect_errno) {
        $this->error=true;
      }
  }

  //Funcion para saber si hay error
  function hayError(){
    return $this->error;
  }

  //Insertamos los datos.
  public function Insertarequipo($nombre, $ciudad, $conferencia, $division)
  {
    $equipo="INSERT INTO equipos(Nombre, Ciudad, Conferencia, Division) VALUES ('".$nombre."', '".$ciudad ."', '" .$conferencia ."', '" .$division ."')";
    if (!$this->conexion->query($equipo)) {
      echo "Falló la creacion de la tabla: (" . $this->conexion->errno .")" . $this->conexion->error;
      return false;
    }
  }

  //Devolvemos el ultimo equipo insertado.
  public function DevolverEquipoNombre($nombre)
  {
    $tablaequipo=[];
    $equipo="SELECT * FROM equipos WHERE Nombre='" .$nombre ."'";
    if($this->error==false){
      $resultado = $this->conexion->query($equipo);
      while($fila=$resultado->fetch_assoc()){
    $tablaequipo[]=$fila;
  }
  return $tablaequipo;
    }else{
      return null;
    }
  }

  //Actualizamos el equipo.
  public function ActualizarEquipo($nombre, $ciudad, $conferencia, $division)
  {
    if ($this->error==false) {
      $actualizar="UPDATE equipos SET Nombre='" .$nombre ."', Ciudad='" .$ciudad ."', Conferencia='" .$conferencia ."', Division='" .$division ."' WHERE Nombre='" .$nombre ."'";
      if (!$this->conexion->query($actualizar)) {
        echo "Falló la actualizacion de la tabla: (" . $this->conexion->errno . ") " . $this->conexion->error;
        return false;
      }
      return true;
    }else {
      return false;
    }
  }

  //Borramos el equipo
  public function BorrarEquipo($nombre)
  {
    if($this->error==false)
    {
      $borrar="DELETE FROM equipos WHERE Nombre='".$nombre ."'";
      if (!$this->conexion->query($borrar)) {
        echo "Falló el borrado del usuario: (" . $this->conexion->errno . ") " . $this->conexion->error;
        return false;
      }
      return true;
    }else{
      return false;
    }
  }

  //Devolvemos la lista de equipos.
  public function ListaEquipos()
  {
    $tablalista=[];
    $equipos="SELECT * FROM equipos";
    if($this->error==false){
      $resultado = $this->conexion->query($equipos);
      while ($fila=$resultado->fetch_assoc()) {
        $tablalista[]=$fila;
      }
      return $tablalista;
    }else{
      return null;
    }
  }
}


 ?>
