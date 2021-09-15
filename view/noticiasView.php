<div class="row mb-2">
    <div class="col-md-2 text-right">
        <label>Secci&oacute;n: </label>
    </div>
    <div class="col-md-6">
        <select class="form-control" onchange="verNoticias(this.value)" >
        <?php

        foreach ($secciones as $seccion) {
            echo '<option value = '. $seccion["id_seccion"] .'>' . $seccion["descripcion"] . '</option>';

        }
        ?>
        </select>
    </div>
</div>
<div id="resultado"class="d-flex justify-content-around flex-wrap">

</div>

<a href="index.php" class="btn btn-secondary mt-2">Volver</a>
<script>
    //para que traiga un default
    (function() {
	   	verNoticias(<?php echo $secciones[0]["id_seccion"]?>);
	})();

    function verNoticias(id_seccion) {
        const xmlhttp=new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                const noticias = JSON.parse(this.response);
                let resultado = "";
                document.getElementById("resultado").innerHTML = "";

                if(noticias.length > 0) {
                    noticias.forEach( function(noticia) {
                        resultado += "<div class=\"card mt-4 mb-4 \" style='width: 45%'>";
                        resultado += "<div class=\"card-body\">";
                        console.log(noticia["id_usuario"]);
                        if(noticia["id_usuario"] == <?php echo $_SESSION["usuario"]["id_usuario"]?> && '<?php echo $_SESSION["usuario"]["rol"]?>' == 'contenidista'){
                            resultado += "<a href='index.php?page=editarNoticia&id_noticia=" + noticia["id_noticia"] + "&id_publicacion=" +<?php echo $_GET["id_publicacion"]?> + "' title='Editar'><div class='fa fa-edit pull-right'></div></a>";
                        }
                        resultado += "<div><h6 class='card-subtitle mb-2 text-muted'>" + noticia['fecha_publicacion'] + "</h6>";
                        resultado += "<small class=\"card-text mb-2\"><strong>Ubicacion: </strong>"  + noticia['ubicacion'];
                        resultado += "<strong class='ml-3'>Periodista: </strong>"  + noticia['nombre'] + ", " + noticia['apellido'] + "</small></div>";
                        resultado += "<a href='index.php?page=verNoticia&id_noticia=" + noticia["id_noticia"] + "'><h4 class=\"display-4 font-content\">" + noticia['titulo'] + "</h4></a>";
                        resultado += "<img class='image-md' src='" + noticia["name_file"] + "'>";
                        resultado += "</div>";
                        resultado += "</div>";
                    });
                } else {
                    resultado += "<small class='text-danger'>La sección seleccionada no dispone de noticias</small>";
                }

                document.getElementById("resultado").innerHTML = resultado;
            }
        }
        xmlhttp.open("GET","ajax/noticiasAjax.php?id_seccion="+id_seccion);
        xmlhttp.send();
    }
</script>
