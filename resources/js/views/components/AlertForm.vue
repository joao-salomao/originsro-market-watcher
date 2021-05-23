<template>
  <b-modal
    ref="modal"
    size="md"
    centered
    hideFooter
    hideHeader
    :noCloseOnEsc="isSubmitting"
    :noCloseOnBackdrop="isSubmitting"
  >
    <b-form @submit.prevent="onSubmit">
      <div class="d-flex justify-content-center p-2">
        <h5 class="mr-2">{{ form.name }}</h5>
        <img width="30" height="30" :src="form.icon" />
      </div>
      <b-form-group label="Max price">
        <b-form-input required v-model="form.max_price" type="number">
        </b-form-input>
      </b-form-group>
      <div class="d-flex justify-content-end">
        <b-button class="mr-2" :disabled="isSubmitting" @click="onClickCancel"
          >Cancel</b-button
        >
        <b-button type="submit" variant="primary" :disabled="isSubmitting">
          <b-spinner small v-if="isSubmitting" />
          <span v-else>Submit</span>
        </b-button>
      </div>
    </b-form>
  </b-modal>
</template>
<script>
export default {
  props: {
    data: Object,
    show: Boolean,
    isSubmitting: Boolean,
  },
  data() {
    return {
      form: {
        name: null,
        icon: null,
        item_id: null,
        max_price: null,
      },
    };
  },
  watch: {
    show(value) {
      if (value) {
        this.$refs.modal.show();
      } else {
        this.$refs.modal.hide();
      }
    },
    data(value) {
      this.form = value;
    },
  },
  methods: {
    onClickCancel() {
      this.$emit("cancel");
    },
    onSubmit() {
      this.$emit("submit", this.form);
    },
  },
};
</script>
