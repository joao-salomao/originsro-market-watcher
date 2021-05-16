<template>
  <div>
    <h1>Items</h1>
    <div>
      <div class="b-card d-flex" :key="item.id" v-for="item in items">
        <span>{{ item.item_id }}</span>
        <img :src="item.icon" />
        <span>
          {{ item.name }}
        </span>
      </div>
      <button @click="onClickPaginationAction(firstPageUrl)">First</button>
      <button @click="onClickPaginationAction(firstPageUrl)">Previous</button>
      <button @click="onClickPaginationAction(nextPageUrl)">Next</button>
    </div>
  </div>
</template>
<script>
import api from "axios";
import { ref, onMounted } from "@vue/composition-api";
export default {
  setup() {
    const items = ref();
    const nextPageUrl = ref();
    const firstPageUrl = ref();
    const previousPageUrl = ref();

    const getItems = (url = "api/item") => {
      api.get(url).then((resp) => {
        const { data, first_page_url, next_page_url } = resp.data;

        items.value = data;
        firstPageUrl.value = first_page_url;
        nextPageUrl.value = next_page_url;
      });
    };

    const onClickPaginationAction = (url) => getItems(url);

    onMounted(getItems);

    return {
      items,
      nextPageUrl,
      firstPageUrl,
      previousPageUrl,
      onClickPaginationAction,
    };
  },
};
</script>
