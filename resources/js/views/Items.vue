<template>
  <div>
    <b-table striped hover :busy="isBusy" :items="items" :fields="fields">
      <template #cell(icon)="{ item }">
        <img width="30" height="30" :src="item.icon" />
      </template>
      <template #cell(action)="{ item }">
        <b-button
          size="sm"
          variant="primary"
          @click="onClickCreateItemAlert(item)"
          >Create Alert</b-button
        >
      </template>
    </b-table>
    <AlertForm
      :show="form.show"
      :data="form.data"
      :isSubmitting="form.isSubmitting"
      @submit="onSubmitAlert"
      @cancel="onCancelAlertCreation"
    />
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
import AlertForm from "./components/AlertForm";
export default {
  components: {
    AlertForm,
  },
  data() {
    return {
      form: {
        data: {},
        show: false,
        isSubmitting: false,
      },
      items: [],
      isBusy: false,
      nextPageUrl: null,
      firstPageUrl: null,
      previousPageUrl: null,
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
          label: "Actions",
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
    onSubmitAlert(data) {
      this.form.isSubmitting = true;
      const { max_price, id } = data;
      api.post("api/alert", { max_price, item_id: id }).finally(() => {
        this.form.isSubmitting = false;
        this.form.show = false;
      });
    },
    onCancelAlertCreation() {
      this.form.show = false;
    },
    onClickCreateItemAlert(item) {
      this.setFormData(item);
      this.form.show = true;
    },
    setFormData(item) {
      this.form.data = {
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
