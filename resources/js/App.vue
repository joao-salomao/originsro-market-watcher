<template>
  <div>
    <b-navbar v-if="showNavBar" type="dark" variant="dark">
      <b-navbar-brand>Ragnarok Market Watch</b-navbar-brand>
      <b-navbar-nav>
        <b-nav-item to="/items" exact exact-active-class="active"
          >Items</b-nav-item
        >
        <b-nav-item to="/alerts" exact exact-active-class="active"
          >Alerts</b-nav-item
        >
        <b-nav-item to="/profile" align="right" exact exact-active-class="active"
          >Perfil</b-nav-item
        >
      </b-navbar-nav>
    </b-navbar>
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
body {
  background-color: white;
}
</style>
