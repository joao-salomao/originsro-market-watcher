<template>
  <div class="p-4">
    <h1>Items</h1>
    <b-table striped hover :items="items" :fields="fields">
      <template #cell(icon)="{ item }">
        <img width="30" height="30" :src="item.icon" />
      </template>
      <template #cell(action)="{ item }">
        <b-button @click="onClickWatchItem(item)">Watch item</b-button>
      </template>
    </b-table>
    <b-modal
      ref="modal"
      size="md"
      centered
      hideFooter
      hideHeader
      :noCloseOnEsc="form.isSubmitting"
      :noCloseOnBackdrop="form.isSubmitting"
    >
      <b-form @submit.prevent="onSubmitWatch">
        <div class="d-flex justify-content-center p-2">
          <h5 class="mr-2">{{ form.name }}</h5>
          <img width="30" height="30" :src="form.icon" />
        </div>
        <b-form-group label="Max price">
          <b-form-input required v-model="form.max_price" type="number">
          </b-form-input>
        </b-form-group>
        <div class="d-flex justify-content-end">
          <b-button
            class="mr-2"
            :disabled="form.isSubmitting"
            @click="onClickCancelWatch"
            >Cancel</b-button
          >
          <b-button
            type="submit"
            variant="primary"
            :disabled="form.isSubmitting"
          >
            <b-spinner small v-if="form.isSubmitting" />
            <span v-else>Submit</span>
          </b-button>
        </div>
      </b-form>
    </b-modal>

    <button @click="onClickPaginationAction(firstPageUrl)">First</button>
    <button @click="onClickPaginationAction(firstPageUrl)">Previous</button>
    <button @click="onClickPaginationAction(nextPageUrl)">Next</button>
  </div>
</template>
<script>
import api from "axios";
export default {
  data() {
    return {
      form: {},
      items: [],
      nextPageUrl: null,
      firstPageUrl: null,
      previousPageUrl: null,
      fields: ["item_id", "icon", "name", "npc_price", "action"],
    };
  },
  mounted() {
    this.getItems();
  },
  methods: {
    onSubmitWatch() {
      this.form.isSubmitting = true;
      const { max_price, id } = this.form;
      api.post("api/alert", { max_price, item_id: id }).finally(() => {
        this.form.isSubmitting = false;
        this.$refs["modal"].hide();
      });
    },
    onClickCancelWatch() {
      this.$refs["modal"].hide();
    },
    onClickWatchItem(item) {
      this.setFormData(item);
      this.$refs["modal"].show();
    },
    setFormData(item) {
      this.form = {
        ...item,
        max_price: null,
        isSubmitting: false,
      };
    },
    onClickPaginationAction(url) {
      this.getItems(url);
    },
    getItems(url = "api/item") {
      api.get(url).then((resp) => {
        const { data, first_page_url, next_page_url } = resp.data;
        this.items = data;
        this.firstPageUrl = first_page_url;
        this.nextPageUrl = next_page_url;
      });
    },
  },
};
</script>
