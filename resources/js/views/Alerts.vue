<template>
  <div>
    <b-table hover :busy="isBusy" :items="alerts" :fields="fields">
      <template #cell(icon)="{ item }">
        <img width="30" height="30" :src="item.item.icon" />
      </template>
      <template #cell(name)="{ item }">
        <span>{{ item.item.name }} </span>
      </template>
      <template #cell(matches)="{ item }">
        <span>{{ item.matches.length }} </span>
      </template>
      <template #cell(actions)="props">
        <div>
          <b-button
            v-if="props.item.matches.length"
            size="sm"
            variant="primary"
            @click="props.toggleDetails"
          >
            Show Matches
          </b-button>
          <b-button size="sm" @click="onClickEdit(item)"> Edit </b-button>
          <b-button
            size="sm"
            variant="danger"
            @click="onClickDelete(props.item)"
          >
            <b-spinner small v-if="props.item.isDeleting" />
            <span v-else> Delete </span>
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
          key: "max_price",
          label: "Max Price",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "matches",
          label: "Found",
          thClass: "text-center",
          tdClass: "text-center",
        },
        {
          key: "actions",
          label: "Actions",
          thClass: "text-center",
          tdClass: "text-center",
        },
      ],
      isBusy: false,
      alerts: [],
    };
  },
  mounted() {
    this.getAlerts();
  },
  methods: {
    onClickDelete(item) {
      item.isDeleting = true;
      api.delete(`api/alert/${item.id}`).finally(() => {
        item.isDeleting = false;
        this.alerts = this.alerts.filter((i) => i != item);
      });
    },
    getAlerts() {
      this.isBusy = true;
      api
        .get("api/alert")
        .then((resp) => {
          this.alerts = resp.data.map((i) => {
            return {
              ...i,
              isDeleting: false,
              _showDetails: i.matches.length > 0,
            };
          });
        })
        .finally(() => {
          this.isBusy = false;
        });
    },
  },
};
</script>
