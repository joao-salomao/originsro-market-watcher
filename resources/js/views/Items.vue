<template>
  <div>
    <b-table striped hover :busy="isBusy" :items="items" :fields="fields">
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
    <div class="d-flex justify-content-center">
      <b-button-group>
        <b-button @click="onClickPaginationAction(firstPageUrl)"
          >First</b-button
        >
        <b-button @click="onClickPaginationAction(firstPageUrl)"
          >Previous</b-button
        >
        <b-button @click="onClickPaginationAction(nextPageUrl)">Next</b-button>
      </b-button-group>
    </div>
  </div>
</template>
<script>
import api from "axios";
export default {
  data() {
    return {
      form: {},
      items: [],
      isBusy: false,
      nextPageUrl: null,
      firstPageUrl: null,
      previousPageUrl: null,
      fields: ["item_id", "icon", "name", "npc_price", "action"],
      fields: [
        {
          key: "item_id",
          label: "Item ID",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "icon",
          label: "Icon",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "name",
          label: "Name",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "npc_price",
          label: "NPC Price",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "action",
          label: "Acit",
          thClass: "text-center",
          tdClass: "text-center",
        },
      ],
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
      this.isBusy = true;
      api
        .get(url)
        .then((resp) => {
          const { data, first_page_url, next_page_url } = resp.data;
          this.items = data;
          this.firstPageUrl = first_page_url;
          this.nextPageUrl = next_page_url;
        })
        .finally(() => {
          this.isBusy = false;
        });
    },
  },
};
</script>
