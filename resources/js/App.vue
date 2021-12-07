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
        <b-nav-item to="/routes" exact exact-active-class="active"
          >API Routes</b-nav-item
        >
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown text="User" right>
          <b-dropdown-item @click="$router.push('/profile')"
            >Profile</b-dropdown-item
          >
          <b-dropdown-item @click="signOut">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
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
  methods: {
    signOut() {
      store.clearUser();
      this.$router.push("/login");
    },
  },
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
