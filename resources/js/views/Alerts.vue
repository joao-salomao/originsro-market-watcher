<template>
  <div>
    <b-table striped hover :items="alerts" :fields="fields">
      <template #cell(icon)="{ item }">
        <img width="30" height="30" :src="item.item.icon" />
      </template>
      <template #cell(name)="{ item }">
        <span>{{ item.item.name }} </span>
      </template>
      <template #cell(action)="props">
        <div>
          <b-button
            v-if="props.item.matches"
            size="sm"
            variant="primary"
            @click="props.toggleDetails"
          >
            Show Matches
          </b-button>
          <b-button size="sm" @click="onClickEdit(item)"> Edit </b-button>
          <b-button size="sm" variant="danger" @click="onClickEdit(props.item)">
            Delete
          </b-button>
        </div>
      </template>
      <template #row-details="{ item }">
        <b-card>
          <b-row class="font-weight-bold">
            <b-col> Shop name </b-col>
            <b-col> Owner name </b-col>
            <b-col> Map </b-col>
            <b-col> Location </b-col>
          </b-row>
          <b-row :key="match.id" v-for="match in item.matches">
            <b-col>
              {{ match.shop_name }}
            </b-col>
            <b-col>
              {{ match.owner_name }}
            </b-col>
            <b-col>
              {{ match.map }}
            </b-col>
            <b-col>
              {{ `X: ${match.location_x} | Y: ${match.location_y}` }}
            </b-col>
          </b-row>
        </b-card>
      </template>
    </b-table>
  </div>
</template>
<script>
import api from "axios";
export default {
  data() {
    return {
      alerts: [],
      fields: ["item_id", "icon", "name", "max_price", "action"],
    };
  },
  mounted() {
    this.getWatchList();
  },
  methods: {
    getWatchList() {
      api.get("api/alert").then((resp) => {
        this.alerts = resp.data.map((i) => ({ ...i, _showDetails: true }));
      });
    },
  },
};
</script>
