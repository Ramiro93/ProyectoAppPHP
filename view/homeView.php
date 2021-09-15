<?php
    function estaSuscripto($id_publicacion, $suscripciones) {
        $suscripto = false;
        if(isset($_SESSION["usuario"])) {
            foreach ($suscripciones as $suscripcion) {
                if ($suscripcion["id_publicacion"] == $id_publicacion) {
                    $suscripto = true;
                    break;
                }
            }
        }
        return $suscripto;
    }
?>

<h1 class="display-3 font-logo text-center mb-4">Notipip!</h1>

<div class="row mt-2">
    <div class="col-sm-6">
        <h4 class="display-4 font-content">Diarios</h4>
        <div class="d-flex justify-content-start flex-wrap">
            <?php
            foreach($diarios as $publicacion) {
                echo '<div class="card mt-2 mr-3" style="width: 45%;">
                          <div class="card-body text-center">
                               <h4 class="card-title display-5 font-content text-primary"> '. $publicacion["nombre"] .' </h4>';

                            if(isset($_SESSION["usuario"])) {
                                if($_SESSION["usuario"]["rol"] == "admin") {
                                    echo '<a href="index.php?page=noticias&id_publicacion=' . $publicacion["id_publicacion"] . '
                                     " class="btn btn-sm btn-primary">Ver</a>';
                                } else if(estaSuscripto($publicacion["id_publicacion"], $suscripciones) || $publicacion["precio"] < 1) {
                                    echo '<a href="index.php?page=noticias&id_publicacion=' . $publicacion["id_publicacion"] . '
                                     " class="btn btn-sm btn-primary">Ver</a>';
                                } else {
                                    echo '<button type="button" id="btn-modal" class="btn btn-sm btn-primary mb-1" 
                                        data-id="'. $publicacion["id_publicacion"] .'" 
                                        data-precio="'. $publicacion["precio"] .'" 
                                        data-nombre="'. $publicacion["nombre"] .'"
                                        data-toggle="modal" href="#ventanaSuscripcion">
                                      Suscribirme
                                      </button>';
                                }
                            } else if($publicacion["precio"] < 1) {
                                echo '<a href="index.php?page=noticias&id_publicacion=' . $publicacion["id_publicacion"] . '
                                     " class="btn btn-sm btn-primary">Ver</a>';
                            } else {
                                echo '<a href="index.php?page=login" class="btn btn-sm btn-primary">Suscribirme</a>';
                            }
                    echo '</div>
                </div>';
            }
            ?>
        </div>
    </div>

    <div class="col-sm-6">
        <h4 class="display-4 font-content">Revistas</h4>
        <div class="d-flex justify-content-start flex-wrap">
            <?php
            foreach($revistas as $publicacion) {
                echo '<div class="card mt-2 mr-3" style="width: 45%;">
                          <div class="card-body text-center">
                               <h4 class="card-title display-5 font-content text-primary"> '. $publicacion["nombre"] .' </h4>';

                            if(isset($_SESSION["usuario"])) {
                                if($_SESSION["usuario"]["rol"] == "admin") {
                                    echo '<a href="index.php?page=noticias&id_publicacion=' . $publicacion["id_publicacion"] . '
                                     " class="btn btn-sm btn-primary">Ver</a>';
                                } else if(estaSuscripto($publicacion["id_publicacion"], $suscripciones) || $publicacion["precio"] < 1) {
                                    echo '<a href="index.php?page=noticias&id_publicacion=' . $publicacion["id_publicacion"] . '
                                     " class="btn btn-sm btn-primary">Ver</a>';
                                } else {
                                    echo '<button type="button" id="btn-modal" class="btn btn-sm btn-primary mb-1" 
                                        data-id="'. $publicacion["id_publicacion"] .'" 
                                        data-precio="'. $publicacion["precio"] .'" 
                                        data-nombre="'. $publicacion["nombre"] .'"
                                        data-toggle="modal" href="#ventanaSuscripcion">
                                      Suscribirme
                                      </button>';
                                }
                            } else if($publicacion["precio"] < 1) {
                                echo '<a href="index.php?page=noticias&id_publicacion=' . $publicacion["id_publicacion"] . '
                                     " class="btn btn-sm btn-primary">Ver</a>';
                            } else {
                                echo '<a href="index.php?page=login" class="btn btn-sm btn-primary">Suscribirme</a>';
                            }
                    echo '</div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="ventanaSuscripcion" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Suscripcion</h5>
                <button class="close" data-dismiss="modal" aria-label="cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert text-muted">
                    <h6 id="modal-text">La suscripcion a</h6>
                </div>
            </div>
            <div class="modal-footer">
                <form action="index.php?page=generarSuscripcion" method="POST">
                    <input type="hidden" id="id_publicacion" name="id_publicacion">
                    <input type="hidden" id="titulo" name="titulo">
                    <input type="hidden" id="precio" name="precio">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Suscribirme</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#btn-modal", function (e) {
        e.preventDefault();
        const _self = $(this);
        const id = _self.data('id');
        const precio = _self.data('precio');
        const nombre = _self.data('nombre');
        console.log("el precio es: " + precio);
        $("#id_publicacion").val(id);
        $("#precio").val(precio);
        $("#titulo").val(nombre);
        $("#modal-text").text("La suscripción a " + nombre + " tiene un costo de $" + precio);
        $(_self.attr('href')).modal('show');
    });
</script>
