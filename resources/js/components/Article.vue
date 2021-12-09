<!-- Seccion 1 : Estructura HTML sección de articulos -->
<template>

  <div>
    <h1 class="text-center">Articulos Registrados</h1>

     <!-- Button trigger modal -->
    <button @click=" update = false; openModal();" type="button" class="btn btn-primary">
      Nuevo Articulo
    </button>

    <div class="container mt-2">
      <div class="row">
        <div class="col-sm-4" v-for="articlee in articles" :key="articlee.id">
          <div class="card" style="width: 18rem;">
            <img src="https://elcomercio.pe/resizer/4LiA3UcZpkTbq0pGF8j9dPiahkw=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/6Y2EDIISGFGVFANEVDCR5LCG34.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">#id :{{ articlee.id }}  {{ articlee.title }}</h5>
              <p class="card-text">{{ articlee.description }}</p>
              <p class="card-text">Ref: {{ articlee.serial }}</p>
              <p class="card-text">vendedor: {{ articlee.user_id }}</p>
              
              <button @click=" update = true; openModal(articlee);" class="btn btn-primary" title="Ver producto">
                <i class="fas fa-eye"></i> 
              </button>
              
              <template v-if="articlee.user_id==1">
                <button @click=" update = true; openModal(articlee);" class="btn btn-warning" title="Editar producto">
                  <i class="fas fa-edit"></i> 
                </button>
                <button @click="eliminar(articlee.id)" class="btn btn-danger" title="Eliminar producto">
                  <i class="fas fa-trash-alt"></i> 
                </button>
              </template>
            </div>
          </div><br />
        </div>
      </div>
    </div>
    

    <!-- 
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
    </table> -->
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
    return{
      users:[],
    };
    
  },
  methods: {
    async list() {
      const res = await axios.get("articles");
      this.articles = res.data;
    }, 
    async eliminar(id) {
      const res = await axios.delete("/articles/" + id);
      this.list();
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