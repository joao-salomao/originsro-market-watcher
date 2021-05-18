<template>
  <div class="p-4">
    <h1>Items</h1>
    <b-table striped hover :items="items"></b-table>
    <!-- <b-card
      :key="item.id"
      v-for="item in items"
      class="d-flex justify-content-between"
    >
      <div class="d-flex justify-content-between text-center"></div>
    </b-card> -->
    <button @click="onClickPaginationAction(firstPageUrl)">First</button>
    <button @click="onClickPaginationAction(firstPageUrl)">Previous</button>
    <button @click="onClickPaginationAction(nextPageUrl)">Next</button>
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
