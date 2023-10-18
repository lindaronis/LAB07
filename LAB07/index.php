<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$sentencia = $bd->query("select * from persona");
$persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-7">
            <?php include 'mensajes/mensajes.php' ?>
            <div class="card">
                <div class="card-header">
                    Lista de pedidos
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Pedido</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">F.Pedido</th>
                                <th scope="col">Celular</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($persona as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->nombres; ?></td>
                                    <td><?php echo $dato->apellido_paterno; ?></td>
                                    <td><?php echo $dato->apellido_materno; ?></td>
                                    <td><?php echo $dato->fecha_nacimiento; ?></td>
                                    <td><?php echo $dato->celular; ?></td>
                                    <td><a class="text-success" href="editar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td><a class="text-primary" href="agregarPromocion.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                    <td><a onclick="return confirm('Estas seguro de eliminar?');" class="text-danger" href="eliminar.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-trash"></i></a></td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos:
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label">Cliente: </label>
                        <input type="text" class="form-control" name="txtNombres" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pedido: </label>
                        <select class="form-select" name="txtApPaterno" autofocus required>
                            <option value="Cafe">Cafe</option>
                            <option value="Cafe con leche">Cafe con leche</option>
                            <option value="Capucchino">Capucchino</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"> Cantidad: </label>
                        <input type="number"" class=" form-control" name="txtApMaterno" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de pedido: </label>
                        <input type="date" class="form-control" name="txtFechaNacimiento" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular: </label>
                        <input type="number" class="form-control" name="txtCelular" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>