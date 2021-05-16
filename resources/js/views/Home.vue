<template>
  <div>
    <h1>Items</h1>
    <div>
      <div class="d-flex" :key="item.id" v-for="item in items">
        <img :src="item.icon" />
        <span>{{ item.item_id }}</span>
        <span>
          {{ item.name }}
        </span>
      </div>
    </div>
  </div>
</template>
<script>
import api from "axios";
import { ref, onMounted } from "@vue/composition-api";
export default {
  setup() {
    const items = ref();

    const getItems = () => {
      api.get("api/item").then(({ data }) => {
        items.value = data;
      });
    };

    onMounted(getItems);

    return {
      items,
    };
  },
};
</script>
