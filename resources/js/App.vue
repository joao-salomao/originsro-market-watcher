<template>
  <div>
    <h1 class="text-center">Ragnarok Market Watch</h1>
    <b-nav v-if="showNavBar" class="nav-bar" tabs align="center">
      <b-nav-item to="/" exact exact-active-class="active">Items</b-nav-item>
      <b-nav-item to="/alerts" exact exact-active-class="active"
        >Alerts</b-nav-item
      >
    </b-nav>
    <div class="p-4">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
import store from "./services/store";
export default {
  computed: {
    showNavBar() {
      return store.user.isAuthenticated;
    },
  },
};
</script>
<style lang="scss">
@import "./sass/app.scss";
.nav-bar {
  font-size: 20px;
}

body {
  background-color: white;
}
</style>
