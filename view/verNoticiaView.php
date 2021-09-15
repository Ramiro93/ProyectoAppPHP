<div class="d-flex flex-column">
    <h1 class="display-4"><?php echo $noticia["titulo"] ?></h1>
    <small>
        <i><?php echo $noticia["nombre"] . ", " . $noticia["apellido"] . " - " . $noticia["fecha_publicacion"] . " - " . $noticia["descripcion"] ?></i>
    </small>
    <img class="mt-3 image-md" src="<?php echo $noticia["name_file"] ?>" />
    <div class="mt-3"><?php echo $noticia["contenido"] ?></div>
    <div>
        <i id="icon_like" class="fa fa-lg fa-thumbs-up pointer text-secondary" onclick="darLike(<?php echo $noticia["id_noticia"]?>)"></i>
        <small id="cant_likes"><?php echo $noticia["cantidad_likes"] ?></small>
    </div>
    <h4 class="font-content mt-3">Comentarios</h4>
    <?php
        foreach($comentarios as $comentario){
            echo '<small>' .$comentario["nombre"] . " " .$comentario["apellido"] .', dice:</small>';
            echo '<div class="card mt-1 mb-1 p-2">';
            echo '<small>' .$comentario["descripcion"]  .'</small>';
            echo '</div>';
        }
    ?>

    <form method="post" action="index.php?page=verNoticia">
        <textarea class="form-control" name="comentario" placeholder="Escribe aquí para comentar"></textarea>
        <input type="hidden" name="id_noticia" value="<?php echo $noticia['id_noticia']?>">
        <button class="btn btn-primary mt-1 mb-3 pull-right" type="submit">Comentar</button>
    </form>
</div>

<a href="index.php?page=noticias&id_publicacion=1" class="text-light btn btn-secondary mt-2">Volver</a>

<script>
    let doLike = false;

    function darLike(id_noticia) {
        let cantidad_likes = parseInt($("#cant_likes").text());

        if(!doLike) {
            cantidad_likes++;
            doLike=true;
            $("#icon_like").addClass("text-primary");
            $("#icon_like").removeClass("text-secondary");
        } else {
            cantidad_likes--;
            doLike=false;
            $("#icon_like").addClass("text-secondary");
            $("#icon_like").removeClass("text-primary");
        }

        console.log(cantidad_likes);
        const xmlhttp=new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                $("#cant_likes").text(cantidad_likes);
            }
        }
        xmlhttp.open("GET","ajax/likeAjax.php?id_noticia="+id_noticia+"&cantidad_likes="+cantidad_likes,true);
        xmlhttp.send();
    }
</script>