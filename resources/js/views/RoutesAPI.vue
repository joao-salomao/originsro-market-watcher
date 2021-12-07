<template>
  <div>
      <h1>Basic API Documentation</h1>
    <pre v-html="routes" />
  </div>
</template>
<script>
import http from "../services/http";
export default {
  data() {
    return {
      routes: null,
    };
  },
  mounted() {
    this.getRoutes()
  },
  methods: {
    getRoutes() {
      http.getApiRoutes().then((resp) => {
        this.routes = resp.data;
      });
    },
  },
};
</script>
