<template>
  <div>
    <div>
      <div>
        <div class="filters">
          <div class="mr-2">
            <span>Item ID:</span>
            <b-form-input
              v-model="filters.itemId"
              type="number"
              debounce="1000"
              size="sm"
            />
          </div>
          <div class="mr-2">
            <span>Name:</span>
            <b-form-input
              v-model="filters.name"
              type="text"
              debounce="1000"
              size="sm"
            />
          </div>
          <div class="mr-2">
            <span>Type:</span>
            <b-form-select
              v-model="filters.type"
              size="sm"
              :options="categories"
            />
          </div>
          <b-form-select
            size="sm"
            class="per-page"
            :options="perPageOptions"
            v-model="pagination.perPage"
          />
        </div>
      </div>
      <b-table
        hover
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
import http from "../services/http";
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
      filters: {
        name: null,
        itemId: null,
        type: null,
      },
      perPageOptions: [10, 15, 30, 50, 100, 200],
      categories: [
        {
          value: "IT_HEALING",
          text: "Healing",
        },
        {
          value: "IT_DELAYCONSUME",
          text: "Delay Consume",
        },

        {
          value: "IT_USABLE",
          text: "Usable",
        },

        {
          value: "IT_ETC",
          text: "Etc",
        },
        {
          value: "IT_WEAPON",
          text: "Weapon",
        },
        {
          value: "IT_AMMO",
          text: "Ammo",
        },
        {
          value: "IT_ARMOR",
          text: "Armor",
        },

        {
          value: "IT_CARD",
          text: "Card",
        },
        {
          value: "IT_PETEGG",
          text: "Pet Egg",
        },
        {
          value: "IT_PETARMOR",
          text: "Pet Armor",
        },
        {
          value: "IT_CASH",
          text: "Cash Shop Reward",
        },
      ],
      fields: [
        {
          key: "item_id",
          label: "Item ID",
          thClass: "text-center",
          tdClass: "text-center",
          sortable: true,
        },
        {
          key: "name",
          label: "Name",
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
    requestParams(newValue, oldValue) {
      const isDifferent = Object.keys(newValue).some((key) => {
        return newValue[key] != oldValue[key];
      });

      if (isDifferent) {
        this.getItems();
      }
    },
  },
  computed: {
    requestParams() {
      return {
        name: this.filters.name,
        type: this.filters.type,
        item_id: this.filters.itemId,
        page: this.pagination.currentPage,
        per_page: this.pagination.perPage,
      };
    },
  },
  mounted() {
    this.getItems();
  },
  methods: {
    onSubmitAlert(data) {
      this.form.isSubmitting = true;
      const { max_price, id } = data;
      http.createAlert({ max_price, item_id: id }).finally(() => {
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
      http
        .getItems(this.requestParams)
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
.filters {
  display: flex;
  margin-bottom: 0.5rem;
  justify-content: flex-end;
}

.per-page {
  align-self: flex-end;
  float: right;
  max-width: 70px;
  border-radius: 30px;
}
</style>
