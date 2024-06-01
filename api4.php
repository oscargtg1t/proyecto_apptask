<?php
    require "config_bd.php";
    
    $datos = json_decode(file_get_contents("php://input"));
    $request = $datos->request;
    
    // READ: Leer los registros de la base de datos
    if($request == 1){
      $sql = "SELECT * FROM horarios";
      $query = $mysqli->query($sql);
        
      $datos = array();
      while($resultado = $query->fetch_assoc()) {
        $datos[] = $resultado;
      }
        
      echo json_encode($datos);
      exit;
    }

    // CREATE: Insertar registro en la base de datos
    if($request == 2) {

      $nombre_horario = $datos->nombre_horario;
      $descripcion = $datos->descripcion;
      $fecha_inicio = $datos->fecha_inicio;
      $fecha_fin = $datos->fecha_fin;
      $id_turno = $datos->id_turno;

      $sql_select = "SELECT nombre_horario FROM horarios WHERE nombre_horario='$nombre_horario'";
      $query_select = $mysqli->query($sql_select);

      if(($query_select->num_rows) == 0) {
        // Inserta los datos correspondientes
        $sql_insert = "INSERT INTO horarios(nombre_horario, descripcion, fecha_inicio, fecha_fin, id_turno) VALUES('$nombre_horario', '$descripcion', '$fecha_inicio', '$fecha_fin', '$id_turno')";
        if($mysqli->query($sql_insert) === TRUE) {
          echo "Se registro exitosamente.";
        } else {
          echo "Ocurrio un problema.";
        }
      } else {
        echo "Esos datos ya existen.";
      }
      exit;
    }

    // UPDATE: Actualizar el registro de la base de datos
    if($request == 3) {

      $id_horario = $datos->id_horario;
      $nombre_horario = $datos->nombre_horario;
      $descripcion = $datos->descripcion;
      $fecha_inicio = $datos->fecha_inicio;
      $fecha_fin = $datos->fecha_fin;
      $id_turno = $datos->id_turno;

      $sql_edit = "UPDATE horarios SET nombre_horario='$nombre_horario', descripcion='$descripcion', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', id_turno='$id_turno'
      WHERE id_horario='$id_horario'";
      $query_update = $mysqli->query($sql_edit);

      echo "Se actualizo el registro.";
      exit;
    }

    // DELETE: Borrar registro de la base de datos
    if($request == 4) {
      
      $id_horario = $datos->id_horario;

      $sql_delete = "DELETE FROM horarios WHERE id_horario='$id_horario'";
      $query_delete = $mysqli->query($sql_delete);

      echo "Registro eliminado.";
      exit;
    }

    if($request == 5){
      $sql = "SELECT * FROM actividades";
      $query = $mysqli->query($sql);
        
      $datos = array();
      while($resultado = $query->fetch_assoc()) {
        $datos[] = $resultado;
      }
        
      echo json_encode($datos);
      exit;
    }

    if($request == 6) {
      
      $id_actividad = $datos->id_actividad;

      $sql_delete = "DELETE FROM actividades WHERE id_actividad='$id_actividad'";
      $query_delete = $mysqli->query($sql_delete);

      echo "Registro eliminado.";
      exit;
    }

     // CREATE: Insertar registro en la base de datos
     if($request == 7) {

      $nombre_actividad = $datos->nombre_actividad;
      $descripcion = $datos->descripcion;
      $id_horario = $datos->id_horario;
      $id_usuario = $datos->id_usuario;

      $sql_select = "SELECT nombre_actividad FROM actividades WHERE nombre_actividad='$nombre_actividad'";
      $query_select = $mysqli->query($sql_select);

      if(($query_select->num_rows) == 0) {
        // Inserta los datos correspondientes
        $sql_insert = "INSERT INTO actividades(nombre_actividad, descripcion, id_horario, id_usuario) VALUES('$nombre_actividad', '$descripcion', '$id_horario', '$id_usuario')";
        if($mysqli->query($sql_insert) === TRUE) {
          echo "Se registro exitosamente.";
        } else {
          echo "Ocurrio un problema.";
        }
      } else {
        echo "Esos datos ya existen.";
      }
      exit;
    }

    // UPDATE: Actualizar el registro de la base de datos
    if($request == 8) {

      $id_actividad = $datos->id_actividad;
      $nombre_actividad = $datos->nombre_actividad;
      $descripcion = $datos->descripcion;
      $id_horario = $datos->id_horario;
      $id_usuario = $datos->id_usuario;

      $sql_edit = "UPDATE actividades SET nombre_actividad='$nombre_actividad', descripcion='$descripcion', id_horario='$id_horario', id_usuario='$id_usuario'
      WHERE id_actividad='$id_actividad'";
      $query_update = $mysqli->query($sql_edit);

      echo "Se actualizo el registro.";
      exit;
    }

?>