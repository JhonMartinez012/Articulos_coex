const $img_article = document.querySelector("#img_article"),
      $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

$img_article.addEventListener("change", ()=>{
    const archivo=$img_article.files;

    if (!archivo || !archivo.length) {
        $imagenPrevisualizacion.src="";
        return;
    }

    const primerArchivo= archivo[0];
    const objectURL=URL.createObjectURL(primerArchivo);
    $imagenPrevisualizacion.src=objectURL;

});