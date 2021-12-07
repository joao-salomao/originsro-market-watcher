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
      <b-form @submit.prevent="onClickLogin">
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
        <div class="float-right">
          <b-button pill type="submit" variant="primary" :disabled="isLoading">
            <b-spinner small v-if="isLoading" />
            <span v-else>Login</span>
          </b-button>
        </div>
      </b-form>
    </b-card>
  </div>
</template>
<script>
import http from "../services/http";
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
    onClickRegister() {
      this.$router.push("/register");
    },
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    },
    async onClickLogin() {
      try {
        this.isLoading = true;

        const resp = await http.login(this.form.email, this.form.password);
        const { token_type, access_token } = resp.data;
        const token = `${token_type} ${access_token}`;

        this.addTokenToLocalStorage(token);
        http.setAuthorizationHeader();
        store.setIsAuthenticated(true);
        store.getAuthUser();

        this.goToItemListPage();
      } catch (e) {
        console.error(e);
      } finally {
        this.isLoading = false;
      }
    },
    addTokenToLocalStorage(token) {
      localStorage.setItem("token", token);
    },
    goToItemListPage() {
      this.$router.push("/items");
    },
  },
};
</script>
