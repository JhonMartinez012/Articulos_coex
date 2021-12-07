<!-- Seccion 1 : Estructura HTML sección de articulos -->
<template>
  <div>
    <h1 class="text-center">Articulos Registrados</h1>
    <table class="table table-striped table-hover">
      <thead class="table-dark">
        <tr>
          <th scope="col"># Id</th>
          <th scope="col">Imagen</th>
          <th scope="col">Titulo</th>
          <th scope="col">Serial</th>
          <th scope="col">Descripción</th>
          <th scope="col">Creador</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="articlee in articles" :key="articlee.id">
          <th scope="row">{{ articlee.id }}</th>
          <td>{{ articlee.img_article }}</td>
          <td>{{ articlee.title }}</td>
          <td>{{ articlee.serial }}</td>
          <td>{{ articlee.description }}</td>
          <td>{{ articlee.user_id }}</td>
          <td>
            <button
              @click="
                update = true;
                openModal(articlee);
              "
              class="btn btn-warning"
            >
              Editar
            </button>
          </td>
          <td>
            <button @click="eliminar(articlee.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<!-- Fin seccion 1 -->

<!-- Seccion 2: PARTE LOGICA -->
<script>
export default {
  data() {
    return {
      articles: [],
    };
  },
  methods: {
    async list() {
      const res = await axios.get("articles");
      this.articles = res.data;
    },
  },
  created() {
    this.list();
  },
};
</script>
<!-- **** FIN SECCION 2 **** -->

<!-- Seccion 3: ESILOS DEL COMPONENTE -->
<style>
</style>
<!-- ******** FIN SECCION 3 ********* -->