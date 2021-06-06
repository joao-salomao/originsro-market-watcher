<style lang="css">
.form-card {
  min-width: 500px;
  padding: 1.25em;
}

.toggle-password {
  border-radius: 0 30px 30px 0;
}
</style>
<template>
  <div class="d-flex justify-content-center">
    <b-card no-body class="form-card">
      <b-form @submit.prevent="auth">
        <b-form-group label="Email">
          <b-form-input type="email" v-model="form.email" required />
        </b-form-group>
        <b-form-group label="Password">
          <b-input-group>
            <b-form-input
              required
              v-model="form.password"
              :type="showPassword ? 'text' : 'password'"
            />
            <b-input-group-append>
              <b-button class="toggle-password" @click="toggleShowPassword">
                <b-icon v-if="showPassword" icon="eye" />
                <b-icon v-else icon="eye-slash" />
              </b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
        <b-button
          pill
          type="submit"
          variant="primary"
          class="float-right"
          :disabled="isLoading"
        >
          <b-spinner small v-if="isLoading" />
          <span v-else>Login</span>
        </b-button>
      </b-form>
    </b-card>
  </div>
</template>
<script>
import api from "../services/api";
import store from "../services/store";
export default {
  data() {
    return {
      isLoading: false,
      showPassword: false,
      form: {
        email: "teste@teste.com",
        password: "1234",
      },
    };
  },
  methods: {
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    },
    auth() {
      this.isLoading = true;
      api
        .post("/oauth/token", {
          client_id: "2",
          grant_type: "password",
          username: this.form.email,
          password: this.form.password,
          client_secret: "7BLSkwTZL3ydEQlQZDjfTvuHPyrOjFeHJNZkt0ZP",
        })
        .then(({ data }) => {
          const { token_type, access_token } = data;
          const token = `${token_type} ${access_token}`;

          store.user.isAuthenticated = true;
          localStorage.setItem("token", token);
          api.defaults.headers["Authorization"] = token;

          store.getUser();
          this.$router.push("/items");
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
