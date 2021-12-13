<!-- Seccion 1 : Estructura HTML sección de articulos -->
<template>
  <div>
    <h1 class="text-center">Articulos Registrados</h1>

    <!-- Button trigger modal -->
    <button
      @click="
        update = false;
        openModal();
      "
      type="button"
      class="btn btn-primary"
    >
      Nuevo Articulo
    </button>
    <!-- Modal -->
    <div class="modal" :class="{ show: modal }">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                {{ titleModal }}
              </h5>
              <button
                @click="closeModal()"
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div>
                <label for="titulo del producto">Titulo:</label>
                <input
                  v-model="article.title"
                  type="text"
                  class="form-control"
                  id="title"
                  placeholder="Titulo del producto"
                  name=""
                />
              </div>
              <div>
                <label for="Serial">Serial:</label>
                <input
                  v-model="article.serial"
                  type="text"
                  class="form-control"
                  id="serial"
                  placeholder="Serial del producto"
                  name=""
                />
              </div>
              <div>
                <label for="descripcion">Descripción:</label>
                <input
                  v-model="article.description"
                  type="text"
                  class="form-control"
                  id="description"
                  placeholder="Descripcion del producto"
                  name=""
                />
              </div>
              <div>
                <label for="Image">Imagen:</label>
                
                <input                  
                  type="file"
                  @change="obtenerImagen"
                  class="form-control-file"
                  accept="image/*"
                />
              </div>
              <figure>
                <img
                  with="200"
                  height="200"
                  :src="imagen"
                  alt="img del producto"
                />
              </figure>
              <div>
                <label for="descripcion">id usuario:</label>
                <input 
                  v-model="article.user_id"
                  type="text"
                  class="form-control"
                  id="user_id"
                  placeholder="Descripcion del producto"
                  name=""
                  disabled
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                @click="closeModal()"
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Cerrar
              </button>
              <button @click="save()" type="button" class="btn btn-success">
                Guardar Cambios
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Fin del Modal -->

    <div class="container mt-2">
      <div class="row">
        <div class="col-sm-4" v-for="articlee in articles" :key="articlee.id">
          <div class="card" style="width: 18rem">
            <img
              :src="'storage/' + articlee.img_article"
              width="200px"
              class="card-img-top"
              alt=""
            />
            <div class="card-body">
              <h5 class="card-title">
                #id :{{ articlee.id }} {{ articlee.title }}
              </h5>
              <p class="card-text">{{ articlee.description }}</p>
              <p class="card-text">Ref: {{ articlee.serial }}</p>
              <p class="card-text">vendedor: {{ articlee.user.name }}</p>
              <p class="card-text">ruta: {{ articlee.img_article }}</p>

              <button
                @click="
                  update = true;
                  openModal(articlee);
                "
                class="btn btn-primary"
                title="Ver producto"
              >
                <i class="fas fa-eye"></i>
              </button>

              <template v-if="articlee.user.id == user_logeado.id">
                <button
                  @click="
                    update = true;
                    openModal(articlee);
                  "
                  class="btn btn-warning"
                  title="Editar producto"
                >
                  <i class="fas fa-edit"></i>
                </button>
                <button
                  @click="eliminar(articlee.id)"
                  class="btn btn-danger"
                  title="Eliminar producto"
                >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </template>
            </div>
          </div>
          <br />
        </div>
      </div>
    </div>
  </div>
</template>
<!-- Fin seccion 1 -->

<!-- Seccion 2: PARTE LOGICA -->
<script>
export default {
  data() {
    return {
      imagenMini: "",
      article: {
        serial: "",
        title: "",
        description: "",
        img_article: null,
        user_id: "",
      },
      id: 0,
      update: true,
      modal: 0,
      titleModal: " ",
      articles: [],
      user_logeado: {},
    };
  },
  methods: {
    obtenerImagen(e) {
      let file = e.target.files[0];
      this.article.img_article = file;
      this.cargarImagen(file);
    },
    cargarImagen(file) {
      let reader = new FileReader();
      reader.onload = (e) => {
        this.imagenMini = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    async list() {
      const res = await axios.get("articles");
      this.articles = res.data.articulos;
      this.user_logeado = res.data.user_logeado;
    },
    async eliminar(id) {
      const res = await axios.delete("/articles/" + id);
      this.list();
    },
    async save() {
      if (this.update) {
        //const res = await axios.put("/articles/" + this.id, this.article);
          let formData = new FormData();
          formData.append("serial", this.article.serial);
          formData.append("title", this.article.title);
          formData.append("description", this.article.description);
          formData.append("img_article", this.article.img_article);
          formData.append("user_id", this.article.user_id);

          axios.post("/articles-edit/"+ this.id, formData).then((response) => {
            console.log(response.data);
          }); 
        //axios.put("/articles/" + this.id, formData);
      } else {
        let formData = new FormData();
        formData.append("serial", this.article.serial);
        formData.append("title", this.article.title);
        formData.append("description", this.article.description);
        formData.append("img_article", this.article.img_article);
        formData.append("user_id", this.article.user_id);

        axios.post("/articles", formData).then((response) => {
          console.log(response.data);
        });
      }
      this.closeModal();
      this.list();
    },
    openModal(data = {}) {
      this.modal = 1;
      if (this.update) {
        this.id = data.id;
        this.titleModal = "Modificar articulo";
        this.article.serial = data.serial;
        this.article.title = data.title;
        this.article.description = data.description;
        this.article.img_article = data.img_article;
        this.article.user_id = data.user_id;
      } else {
        this.titleModal = "Crear articulo";
        this.id = 0;
        this.article.serial = "";
        this.article.title = "";
        this.article.description = "";
        this.article.img_article = "";
        this.article.user_id = "";
      }
    },
    closeModal() {
      this.modal = 0;
    },
  },
  created() {
    this.list();
  },
  computed: {
    imagen() {
      return this.imagenMini;
    },
  },
};
</script>
<!-- **** FIN SECCION 2 **** -->

<!-- Seccion 3: ESILOS DEL COMPONENTE -->
<style>
.show {
  display: list-item;
  opacity: 1;
  background: rgba(44, 38, 75, 0.849);
}
</style>
<!-- ******** FIN SECCION 3 ********* -->