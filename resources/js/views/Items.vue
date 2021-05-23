<template>
  <div>
    <div>
      <b-form-select
        class="per-page"
        :options="perPageOptions"
        v-model="pagination.perPage"
      />
      <b-table
        hover
        striped
        bordered
        show-empty
        responsive
        :items="items"
        :fields="fields"
        :busy="isLoading"
      >
        <template #cell(icon)="{ item }">
          <img width="30" height="30" :src="item.icon" />
        </template>
        <template #cell(action)="{ item }">
          <b-button
            pill
            size="sm"
            variant="primary"
            @click="onClickCreateItemAlert(item)"
            >Create Alert</b-button
          >
        </template>
      </b-table>
      <b-pagination
        pills
        align="center"
        :disabled="isLoading"
        :total-rows="pagination.rows"
        :per-page="pagination.perPage"
        v-model="pagination.currentPage"
      />
    </div>
    <AlertForm
      :show="form.show"
      :data="form.data"
      :isSubmitting="form.isSubmitting"
      @submit="onSubmitAlert"
      @cancel="onCancelAlertCreation"
    />
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
      isLoading: false,
      pagination: {
        rows: null,
        perPage: 10,
        currentPage: 1,
      },
      perPageOptions: [10, 15, 30, 50, 100, 200],
      fields: [
        {
          key: "item_id",
          label: "Item ID",
          thClass: "text-center",
          tdClass: "text-center",
          sortable: true,
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
          sortable: true,
        },
        {
          key: "npc_price",
          label: "NPC Price",
          thClass: "text-center",
          tdClass: "text-center",
          sortable: true,
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
  watch: {
    "pagination.perPage": function (newValue, oldValue) {
      if (newValue != oldValue) {
        this.getItems();
      }
    },
    "pagination.currentPage": function (newValue, oldValue) {
      if (newValue != oldValue) {
        this.getItems();
      }
    },
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
    getItems() {
      this.isLoading = true;
      api
        .get("api/item", {
          params: {
            page: this.pagination.currentPage,
            per_page: this.pagination.perPage,
          },
        })
        .then((resp) => {
          const { data, current_page, total, per_page } = resp.data;
          this.items = data;
          this.pagination = {
            rows: total,
            perPage: per_page,
            currentPage: current_page,
          };
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
<style scoped>
.per-page {
  float: right;
  max-width: 70px;
  border-radius: 30px;
  margin-bottom: 0.5rem;
}
</style>
