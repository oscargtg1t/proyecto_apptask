<?php
    require "config_bd.php";
    
    $datos = json_decode(file_get_contents("php://input"));
    $request = $datos->request;
    
    // READ: Leer los registros de la base de datos
    if($request == 1){
      $sql = "SELECT * FROM usuarios";
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

      $nombre_usuario = $datos->nombre_usuario;
      $correo_usuario = $datos->correo_usuario;
      $pass_usuario = $datos->pass_usuario;
      $id_rol = $datos->id_rol;
      $id_estado = $datos->id_estado;

      $sql_select = "SELECT correo_usuario FROM usuarios WHERE correo_usuario='$correo_usuario'";
      $query_select = $mysqli->query($sql_select);

      if(($query_select->num_rows) == 0) {
        // Inserta los datos correspondientes
        $sql_insert = "INSERT INTO usuarios(nombre_usuario, correo_usuario, pass_usuario, id_rol, id_estado) VALUES('$nombre_usuario', '$correo_usuario', '$pass_usuario', '$id_rol', '$id_estado')";
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

      $id_usuario = $datos->id_usuario;
      $nombre_usuario = $datos->nombre_usuario;
      $correo_usuario = $datos->correo_usuario;
      $pass_usuario = $datos->pass_usuario;
      $id_rol = $datos->id_rol;
      $id_estado = $datos->id_estado;

      $sql_edit = "UPDATE usuarios SET nombre_usuario='$nombre_usuario', correo_usuario='$correo_usuario', pass_usuario='$pass_usuario', id_rol='$id_rol', id_estado='$id_estado'
      WHERE id_usuario='$id_usuario'";
      $query_update = $mysqli->query($sql_edit);

      echo "Se actualizo el registro.";
      exit;
    }

    // DELETE: Borrar registro de la base de datos
    if($request == 4) {
      
      $id_usuario = $datos->id_usuario;

      $sql_delete = "DELETE FROM usuarios WHERE id_usuario='$id_usuario'";
      $query_delete = $mysqli->query($sql_delete);

      echo "Registro eliminado.";
      exit;
    }

?>