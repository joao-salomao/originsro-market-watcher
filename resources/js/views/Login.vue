<template>
  <div>
    <h1>LOGIN</h1>
    <button @click="auth">Login</button>
  </div>
</template>
<script>
import api from "../services/api";
import store from "../services/store";
export default {
  methods: {
    auth() {
      api
        .post("/oauth/token", {
          client_id: "2",
          grant_type: "password",
          password: "1234",
          username: "teste@teste.com",
          client_secret: "7BLSkwTZL3ydEQlQZDjfTvuHPyrOjFeHJNZkt0ZP",
        })
        .then(({ data }) => {
          const { token_type, access_token } = data;
          const token = `${token_type} ${access_token}`;
          localStorage.setItem("token", token);
          api.defaults.headers.common["Authorization"] = token;
          store.user.isAuthenticated = true;
        });
    },
  },
};
</script>
